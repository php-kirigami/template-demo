<?php
/**
 * @title      Code
 * @section    features
 * @breadcrumb true
 * @position   3
 * @kicker     Docs
 * @abstract   Fenced blocks (and a <highlight> tag) coloured at build time by @kirigami/plugin-highlight, copy button included.
 */
?>

<?php echo demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot); ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">Feature</p>
        <h1 class="section__title">Code</h1>
        <p class="section__intro"><?php echo str_htmlesc($abstract); ?></p>
    </div>

    <div class="prose">
        <markdown>
        Fenced blocks become `<pre><code class="language-…">`. This site lists
        `@kirigami/plugin-highlight` under `plugins:`, so its `prepros:html` hook runs
        highlight.js over every block **at build time** — the `.hljs-*` spans you see
        below are baked into the HTML. Drop the plugin and you still get the bare
        language class to style yourself. Either way there is **no client-side
        highlighter shipped**.

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

        ```shell
        $ npx kiri watch
        [css-core] batch 1 styles/kirigami.core.scss
        ✔ Build finished
        ```

        The hover **Copy** button on every block comes from the plugin's `copyButton`
        option — a ~1 KB script folded into the `js-core` bundle via the `esbuild:after`
        hook, its styles via `sass:after`.

        Prefer an explicit tag to a fence? `plugin-highlight` also registers a
        `<highlight lang="…">` tag (PHP side, `prepros:php` hook) that normalises to the
        same markup:
        </markdown>

        <highlight lang="php">
        #[Route('/feed.xml')]
        public function feed(Repository $posts): Response
        {
            return $this->render('feed.xml.twig', ['posts' => $posts->latest(20)]);
        }
        </highlight>
    </div>
</section>
