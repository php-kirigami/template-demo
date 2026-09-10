<?php
/**
 * @title      Markdown
 * @section    features
 * @breadcrumb true
 * @position   1
 * @kicker     Content
 * @abstract   A GFM Markdown engine with tables, footnotes, alerts and pluggable shortcodes.
 */
?>

<?= demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot) ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">Feature</p>
        <h1 class="section__title">Markdown</h1>
        <p class="section__intro"><?= str_htmlesc($abstract) ?></p>
    </div>

    <div class="prose">
<markdown>
Everything between the markdown tags is converted with `md_to_html()` after PHP
runs. Common leading indentation is stripped first, so it sits neatly inside
indented layout markup.

## GFM essentials

| Surface   | Call                    | Alignment |
|:----------|:------------------------|----------:|
| Tag       | `<markdown>` block      |     right |
| Data file | `@content _page.md`     |    center |
| PHP       | `md_to_html($string)`   |      left |

Task lists, strikethrough and autolinks all work:

- [x] ATX + Setext headings with an auto `id`
- [x] Footnotes[^engine]
- [ ] ~~A build server~~

> [!NOTE]
> Alerts — `[!NOTE]`, `[!TIP]`, `[!WARNING]` — render as styled callouts.

[^engine]: The parser is a single ~1200-line zero-dependency PHP class.

## Shortcode plugins

Registered once in `_lib/functions.php`, then usable anywhere Markdown is parsed
— a markdown block, a `.md` data file, or a raw `md_to_html()` call.

{% callout info "The callout shortcode" Wrapped text becomes a styled box, with an optional bold title. %}

{% checklist "Ship checklist"
Write the page
Run npx kiri export
Push to main
%}

This project also registers its own **badge** shortcode:

{% badge accent New %} {% badge ok Stable %} {% badge muted Draft %}
</markdown>
    </div>
</section>
