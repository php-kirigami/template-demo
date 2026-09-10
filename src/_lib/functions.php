<?php
/**
 * prepros.includes entry — loaded once (include_once) before any page renders.
 *
 * Shows the three extension points a site normally uses. Written with the
 * procedural alias functions from libraries/aliases.inc.php (each one is a thin
 * wrapper over the matching static class method):
 *
 *   1. register_tag()        → PREPROS::registerTag()   custom HTML tag
 *   2. md_register_plugin()  → MD::registerPlugin()     Markdown shortcode
 *   3. register_hook()       → PREPROS::registerHook()  render-pipeline hook
 */


/* -----------------------------------------------------------------------------
 * 1. Custom tag — <swatches asset="cover.jpg" count="6">
 *    Pulls representative colours out of an image with img_palette() (median-cut
 *    in Lab, cached) and prints them as labelled chips. The path resolves
 *    against image.source, like every other image surface.
 * -------------------------------------------------------------------------- */
register_tag('swatches', function (string $tag, array $attrs, string $body): string {
    $asset = trim((string)($attrs['asset'] ?? ''));
    if ($asset === '') {
        return '<!-- swatches: missing asset attribute -->';
    }

    $count = max(2, min(12, (int)($attrs['count'] ?? 5)));
    $chips = '';

    foreach (img_palette($asset, $count) as $hex) {
        $chips .= sprintf(
            '<li style="--chip:%1$s"><span aria-hidden="true"></span><code>%1$s</code></li>',
            str_htmlesc($hex)
        );
    }

    return '<ul class="swatches" role="list">' . $chips . '</ul>';
});


/* -----------------------------------------------------------------------------
 * 2a. The shipped shortcodes.
 *     php-prepros ships `md.plugins.php` (callout / youtube / codepen / checklist)
 *     but nothing auto-loads it, so wire up the ones this site uses. Each is a
 *     plain md_register_plugin() call — copy/trim from the package as needed.
 * -------------------------------------------------------------------------- */
md_register_plugin('callout', function (array $args, string $body): string {
    $types = ['info', 'success', 'warning', 'danger'];
    $type  = in_array($args[0] ?? '', $types, true) ? $args[0] : 'info';
    $title = !empty($args[1]) ? str_htmlesc($args[1]) : '';

    if ($body !== '') {
        $content = nl2br(str_htmlesc($body));
    } else {
        $content = str_htmlesc(implode(' ', array_slice($args, $title ? 2 : 1)));
    }

    $titleHtml = $title ? "<strong>{$title}</strong><br>" : '';
    return "<div class=\"callout callout-{$type}\">{$titleHtml}{$content}</div>";
});

md_register_plugin('checklist', function (array $args, string $body): string {
    $title = !empty($args[0])
        ? '<p class="checklist-title"><strong>' . str_htmlesc($args[0]) . '</strong></p>'
        : '';
    $items = array_filter(array_map('trim', explode("\n", $body)));
    if (!$items) {
        return '';
    }

    $lis = '';
    foreach ($items as $item) {
        $lis .= '<li><label><input type="checkbox"> ' . str_htmlesc($item) . '</label></li>';
    }
    return "<div class=\"checklist\">{$title}<ul>{$lis}</ul></div>";
});


/* -----------------------------------------------------------------------------
 * 2b. Markdown shortcode — {% badge <tone> <text…> %}
 *    Inline form: {% badge accent Zero deps %}. Works inside <markdown> blocks,
 *    .md data files and any md_to_html() call.
 * -------------------------------------------------------------------------- */
md_register_plugin('badge', function (array $args, string $body): string {
    $tones = ['accent', 'muted', 'ok'];
    $tone  = in_array($args[0] ?? '', $tones, true) ? array_shift($args) : 'muted';
    $text  = trim($body !== '' ? $body : implode(' ', $args));

    if ($text === '') {
        return '';
    }

    return sprintf('<span class="badge badge--%s">%s</span>', $tone, str_htmlesc($text));
});


/* -----------------------------------------------------------------------------
 * 3. Render hooks
 *    page_info   — normalise metadata right after the PHPDOC block is parsed
 *    post_render — swap a build-time token on the finished HTML
 * -------------------------------------------------------------------------- */
// Built-in page_info hooks run first (data-file loading, then LD::capture), so
// by the time this one runs `$data` is already the resolved page object.
register_hook('page_info', function (object $page): object {
    if (empty($page->description) && !empty(PREPROS::$config->data->description)) {
        $page->description = PREPROS::$config->data->description;
    }

    return $page;
});

register_hook('post_render', function (string $html): string {
    return str_replace('{{build-date}}', date('F j, Y'), $html);
});


/* -----------------------------------------------------------------------------
 * Helper — render a breadcrumb <nav> from a trail.
 *
 * fs_get_breadcrumb() resolves its caller from the call stack, so it has to be
 * called *in the page* (not here, not in the layout) and its result passed in.
 * Each sub-page does:  demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot)
 * -------------------------------------------------------------------------- */
function demo_breadcrumb(array $trail, ?string $current, string $relroot): string
{
    if (!$trail) {
        return '';
    }

    $root = str_replace('\\', '/', realpath(PREPROS::$config->root));

    // First crumb: the site itself. Use the `project` name (same value the LD
    // BreadcrumbList uses for its leading ListItem) so the visible trail and the
    // JSON-LD trail name the home the same way — Google wants them to match.
    $home  = PREPROS::$config->data->project ?? 'Home';
    $items = '<li><a href="' . $relroot . '">' . str_htmlesc($home) . '</a></li>';

    foreach ($trail as $crumb) {
        $dir = str_replace('\\', '/', dirname($crumb->file));
        $rel = trim(substr($dir, strlen($root)), '/');
        if ($rel === '') {
            continue; // the home page is already the first crumb
        }
        $items .= sprintf(
            '<li><a href="%s%s/">%s</a></li>',
            $relroot,
            $rel,
            str_htmlesc($crumb->title ?? 'Page')
        );
    }

    $items .= '<li aria-current="page">' . str_htmlesc($current ?? 'Page') . '</li>';

    return '<nav class="breadcrumb wrap" aria-label="Breadcrumb"><ol>' . $items . '</ol></nav>';
}
