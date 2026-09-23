<?php
/**
 * prepros.types.feature.before — the chrome every Features page shares
 * (@type feature): breadcrumb, eyebrow, title and intro. The page itself
 * only writes its content. @eyebrow overrides the default "Feature" label.
 */
?>
<?php echo demo_breadcrumb(fs_get_breadcrumb(), $title, $relroot); ?>

<section class="section wrap">
    <div class="section__head">
        <p class="eyebrow"><?php echo str_htmlesc($eyebrow ?? 'Feature'); ?></p>
        <h1 class="section__title"><?php echo str_htmlesc($title); ?></h1>
        <p class="section__intro"><?php echo str_htmlesc($abstract); ?></p>
    </div>
