<?php
/**
 * @title      Code
 * @section    features
 * @breadcrumb true
 * @position   3
 * @kicker     Docs
 * @abstract   Fenced code blocks with language classes, a highlight plugin hook, and a copy button in ~20 lines of JS.
 */
?>

<?= demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot) ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">Feature</p>
        <h1 class="section__title">Code</h1>
        <p class="section__intro"><?= str_htmlesc($abstract) ?></p>
    </div>

    <div class="prose">
<markdown>
Fenced blocks become `<pre><code class="language-…">`. With
`@kirigami/plugin-highlight` listed under `plugins:` the tokens are coloured at
build time; without it you still get the language class to style yourself. Either
way there is **no client-side highlighter shipped**.

```php
// _lib/functions.php — a custom tag in ~5 lines
register_tag('swatches', function ($tag, $attrs, $body) {
    $chips = '';
    foreach (img_palette($attrs['asset'], 6) as $hex) {
        $chips .= "<li style=\"--chip:$hex\"><span></span></li>";
    }
    return "<ul class=\"swatches\">$chips</ul>";
});
```

```scss
.card {
    background: var(--surface-2);
    box-shadow: var(--shadow);
    &:hover { transform: translateY(-4px); }
}
```

```console
$ npx kiri watch
[css-core] batch 1 styles/kirigami.core.scss
✔ Build finished
```

The copy button on every block is added by `scripts/kirigami.core.js` — it wraps
each `<pre>`, no library involved.
</markdown>
    </div>
</section>
