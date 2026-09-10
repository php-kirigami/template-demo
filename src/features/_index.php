<?php
/**
 * @title      Features
 * @section    features
 * @breadcrumb true
 * @abstract   Each page here demonstrates one Kirigami capability with its source shown alongside the result.
 */

// fs_get_children() scans the folders directly below this one, reads each
// _index.php PHPDOC block and returns them ordered by @position, then name.
$children = fs_get_children();
?>

<?= demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot) ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow">Reference</p>
        <h1 class="section__title">Features</h1>
        <p class="section__intro"><?= str_htmlesc($abstract) ?></p>
    </div>

    <div class="grid">
        <?php foreach ($children as $child): ?>
            <a class="card" href="<?= $relroot . 'features/' . basename(dirname($child->file)) ?>/" data-reveal>
                <span class="card__kicker"><?= str_htmlesc($child->kicker ?? 'Feature') ?></span>
                <span class="card__title"><?= str_htmlesc($child->title ?? 'Untitled') ?></span>
                <span class="card__text"><?= str_htmlesc($child->abstract ?? '') ?></span>
                <span class="card__more">Open →</span>
            </a>
        <?php endforeach; ?>
    </div>
</section>
