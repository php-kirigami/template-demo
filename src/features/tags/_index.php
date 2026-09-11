<?php
/**
 * @title      Tags & hooks
 * @section    features
 * @breadcrumb true
 * @position   5
 * @kicker     Extend
 * @abstract   Register your own HTML tags, Markdown shortcodes and render hooks from one includes file.
 */
?>

<?php echo demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot); ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">Feature</p>
        <h1 class="section__title">Tags &amp; hooks</h1>
        <p class="section__intro"><?php echo str_htmlesc($abstract); ?></p>
    </div>

    <div class="prose">
        <markdown>
        `prepros.includes: [_lib/functions.php]` runs one file before any page renders.
        This site uses it for all three extension points.

        ### A custom tag

        ```php
        register_tag('swatches', function ($tag, $attrs, $body) {
            $chips = '';
            foreach (img_palette($attrs['asset'], (int) $attrs['count']) as $hex) {
                $chips .= "<li style=\"--chip:$hex\"><span></span><code>$hex</code></li>";
            }
            return "<ul class=\"swatches\">$chips</ul>";
        });
        ```

        Used as `<swatches asset="cover.jpg" count="5">`, it renders:
        </markdown>

        <swatches asset="cover.jpg" count="5"></swatches>

        <markdown>
        ### A tag from a plugin

        Tags don't have to be hand-rolled — [`@kirigami/plugin-extlink`](https://www.npmjs.com/package/@kirigami/plugin-extlink)
        registers `<extlink src="…">` the exact same way, via `prepros:php`. It
        scrapes the target page for its title, description, preview image and
        site name, and caches all of it to disk (`_data/extlink/`,
        `assets/images/extlink/`) so a later build never re-crawls a URL it
        has already resolved:
        </markdown>

        <extlink src="https://github.com/php-kirigami/kirigami">

        <markdown>
        ### A Markdown shortcode

        ```php
        md_register_plugin('badge', fn($args, $body) => sprintf(
            '<span class="badge badge--%s">%s</span>',
            $args[0], str_htmlesc(implode(' ', array_slice($args, 1)))
        ));
        ```

        A bare call renders inline — {% badge accent Live %} — anywhere Markdown is parsed.

        ### A render hook

        ```php
        $token = '{{' . 'build-date}}';
        register_hook('post_render', fn($html) =>
            str_replace($token, date('F j, Y'), $html));
        ```

        This hook rewrites a placeholder token on the assembled HTML — look at the
        "last updated …" line at the bottom of every page.
        </markdown>
    </div>
</section>
