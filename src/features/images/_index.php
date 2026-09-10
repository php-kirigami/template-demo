<?php
/**
 * @title      Images
 * @section    features
 * @breadcrumb true
 * @position   2
 * @kicker     Assets
 * @abstract   One image autogenerator, three surfaces — Sass, PHP and an HTML tag — with no native dependency.
 */

// The PHP surface: img_asset() returns a URL relative to this file and registers
// the source so the build only regenerates a file when it is missing or stale.
$src_640  = img_asset('detail.jpg', 640);
$src_1200 = img_asset('detail.jpg', 1200);
?>

<?= demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot) ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">Feature</p>
        <h1 class="section__title">Images</h1>
        <p class="section__intro"><?= str_htmlesc($abstract) ?></p>
    </div>

    <div class="prose">
        <h2>The HTML tag</h2>
        <p>
            <code>&lt;img asset="…" width height cover&gt;</code> is a thin wrapper
            over <code>IMG::asset()</code>. It swaps <code>asset</code> for the
            generated <code>src</code>; every other attribute passes through.
        </p>

        <img asset="detail.jpg" width="900" alt="detail.jpg scaled to 900px wide" loading="lazy">

        <p>Add <code>height</code> and <code>cover</code> to crop to fill:</p>

        <img asset="detail.jpg" width="520" height="520" cover alt="detail.jpg cropped to a square" loading="lazy">

        <h2>The PHP surface</h2>
        <p>
            <code>img_asset($path, $w, $h, $cover)</code> hands back the URL for
            you to place — here in a hand-built <code>srcset</code>:
        </p>

        <img
            src="<?= $src_640 ?>"
            srcset="<?= $src_640 ?> 640w, <?= $src_1200 ?> 1200w"
            sizes="(min-width: 800px) 720px, 100vw"
            alt="Responsive image via img_asset()"
            loading="lazy">

        <h2>The palette</h2>
        <p>
            <code>&lt;swatches&gt;</code> — a custom tag from
            <code>_lib/functions.php</code> — calls <code>img_palette()</code>,
            the same median-cut extraction the Sass <code>colors()</code> function
            uses for this site's <code>--brand-1</code> / <code>--brand-2</code>.
        </p>
    </div>

    <swatches asset="cover.jpg" count="6"></swatches>
</section>
