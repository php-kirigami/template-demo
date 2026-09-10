<?php
/**
 * @title      Data files
 * @section    features
 * @breadcrumb true
 * @position   4
 * @kicker     Content
 * @abstract   Point a PHPDOC annotation at a YAML or JSON file and get structured data back.
 * @articles   _articles.yaml
 * @stats      _stats.json
 * @readme     https://raw.githubusercontent.com/php-kirigami/kirigami/main/README.md
 */

// prepros.network: true lets the built-in loader fetch @readme over HTTP and run
// it through MD::toHtml(). On a network failure it silently stays a string, so
// check we actually got HTML back before rendering it.
$readme_html = (!empty($readme) && str_starts_with(ltrim($readme), '<')) ? $readme : null;
?>

<?php echo demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot); ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">Feature</p>
        <h1 class="section__title">Data files</h1>
        <p class="section__intro"><?php echo str_htmlesc($abstract); ?></p>
    </div>

    <div class="prose">
        <p>
            When an annotation value ends in <code>.yaml</code>, <code>.yml</code>,
            <code>.json</code> or <code>.md</code> and resolves to a file next to
            the page, it is parsed and injected as data instead of a string.
            <code>@stats _stats.json</code> here became a decoded object:
        </p>
    </div>

    <div class="stat-grid">
        <?php foreach ($stats->metrics as $m): ?>
            <div class="stat" data-reveal>
                <div class="stat__num"><?php echo str_htmlesc($m->value); ?></div>
                <div class="stat__label"><?php echo str_htmlesc($m->label); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="prose">
        <p>
            And <code>@articles _articles.yaml</code> — a YAML sequence — arrived
            as an array of objects to loop over:
        </p>
    </div>

    <ul class="article-list">
        <?php foreach ($articles as $a): ?>
            <li class="article" data-reveal>
                <a href="<?php echo str_htmlesc($a->url); ?>"><?php echo str_htmlesc($a->title); ?></a>
                <span class="article__meta"><?php echo date('M Y', strtotime($a->date)); ?></span>
                <p><?php echo str_htmlesc($a->blurb); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if ($readme_html): ?>
        <div class="prose">
            <p>
                Finally, <code>@readme https://…/README.md</code> was fetched over
                the network at build time and converted from Markdown:
            </p>
            <details>
                <summary>Kirigami README (fetched at build)</summary>
                <?php echo $readme_html; ?>
            </details>
        </div>
    <?php endif; ?>
</section>
