<?php
/**
 * @title       Kirigami Demo
 * @section     home
 * @breadcrumb  true
 * @abstract    A guided tour of Kirigami — a zero-dependency static site generator that compiles PHP templates to plain HTML.
 */

$features = [
    ['features/markdown/', 'Markdown',   'Content', 'A GFM Markdown engine with tables, footnotes, alerts and shortcode plugins — usable from a tag, a data file or PHP.'],
    ['features/images/',   'Images',     'Assets',  'One image autogenerator, three surfaces. Resize, crop and sample palettes with no native dependency anywhere.'],
    ['features/code/',     'Code',       'Docs',    'Fenced code blocks with language classes, ready for a highlight plugin, with a copy button bolted on in ~15 lines of JS.'],
    ['features/data/',     'Data files', 'Content', 'Point a PHPDOC annotation at a YAML or JSON file and get structured data — or fetch it over the network at build time.'],
    ['features/tags/',     'Tags & hooks','Extend', 'Register your own HTML tags, Markdown shortcodes and render-pipeline hooks from a single includes file.'],
];
?>

<section class="hero">
    <div class="hero__folds" aria-hidden="true"></div>
    <div class="hero__inner wrap">
        <span class="hero__eyebrow">PHP 8.5 · WebAssembly · zero server</span>
        <h1 class="hero__title"><?php echo str_htmlesc($tagline); ?></h1>
        <p class="hero__lead"><?php echo str_htmlesc($abstract); ?></p>
        <div class="hero__actions">
            <a class="btn btn--primary" href="<?php echo $relroot; ?>features/">Explore the features</a>
            <a class="btn btn--ghost" href="https://github.com/php-kirigami/kirigami">View on GitHub</a>
        </div>
    </div>
</section>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">What you get</p>
        <h2 class="section__title">Every page is just PHP that runs once</h2>
        <p class="section__intro">
            Kirigami compiles the templates below to dependency-free static HTML.
            Each card is a real page in this site — open one to see the feature and
            its source side by side.
        </p>
    </div>

    <div class="grid">
        <?php foreach ($features as [$href, $name, $kicker, $text]): ?>
            <a class="card" href="<?php echo $relroot . $href; ?>" data-reveal>
                <span class="card__kicker"><?php echo $kicker; ?></span>
                <span class="card__title"><?php echo $name; ?></span>
                <span class="card__text"><?php echo $text; ?></span>
                <span class="card__more">Open →</span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">The whole build</p>
        <h2 class="section__title">One config file, one command</h2>
    </div>
    <div class="prose">
        <markdown>
        ```yaml
        # kirigami.yaml
        kirigami:
          project: Kirigami Demo
          baseurl: https://php-kirigami.github.io/template-demo
          root:    src

        prepros:
          before:   _layout/header.php
          after:    _layout/footer.php
          includes: [_lib/functions.php]

        tasks:
          - { name: js-core,  type: esbuild, entry: scripts/kirigami.core.js }
          - { name: css-core, type: sass,    entry: styles/kirigami.core.scss }
        ```

        ```shell
        $ npx kiri build      # dev build — every task once
        $ npx kiri watch      # rebuild on change (no server)
        $ npx kiri export     # production build into dist/
        ```

        {% badge accent Zero deps %} {% badge ok No PHP install %} {% badge muted No headless browser %}
        </markdown>
    </div>
</section>
