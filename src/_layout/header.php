<?php
/**
 * prepros.before — prepended to every page.
 *
 * In scope here: everything from the `kirigami:` block ($project, $baseurl,
 * $tagline, $description, …), every PHPDOC annotation of the page being rendered
 * ($title, $abstract, $section, …), plus $relroot and $absurl.
 */

$page_title = !empty($title) && $title !== $project
    ? "{$title} — {$project}"
    : "{$project} — {$tagline}";

$meta_desc  = trim($description ?? '') ?: (trim($abstract ?? '') ?: $tagline);
$section    = $section ?? '';

// $absurl is a root-relative path; prepend the origin for absolute <link>s.
$origin    = preg_replace('#^(https?://[^/]+).*#', '$1', $baseurl);
$canonical = $origin . $absurl;

$nav = [
    ''          => ['label' => 'Home',     'key' => 'home'],
    'features/'  => ['label' => 'Features', 'key' => 'features'],
    'about/'     => ['label' => 'About',    'key' => 'about'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        (function () {
            var r = document.documentElement;
            r.classList.add('js');
            try {
                var t = localStorage.getItem('theme');
                if (t === 'dark' || t === 'light') r.dataset.theme = t;
            } catch (e) {}
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= str_htmlesc($page_title) ?></title>
    <meta name="description" content="<?= str_htmlesc($meta_desc) ?>">
    <meta name="author" content="<?= str_htmlesc($author) ?>">
    <link rel="canonical" href="<?= str_htmlesc($canonical) ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= str_htmlesc($project) ?>">
    <meta property="og:title" content="<?= str_htmlesc($title ?? $project) ?>">
    <meta property="og:description" content="<?= str_htmlesc($meta_desc) ?>">
    <meta property="og:url" content="<?= str_htmlesc($canonical) ?>">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="<?= $relroot ?>styles/kirigami.core.min.css?###TIMESTAMP###">
    <script defer src="<?= $relroot ?>scripts/kirigami.core.min.js?###TIMESTAMP###"></script>
</head>
<body class="page-<?= str_htmlesc($section ?: 'home') ?>">
    <a class="skip-link" href="#main">Skip to content</a>

    <header class="site-header">
        <div class="wrap site-header__inner">
            <a class="brand" href="<?= $relroot ?>">
                <span class="brand__mark" aria-hidden="true"></span>
                <?= str_htmlesc($project) ?>
            </a>

            <nav class="site-nav" id="site-nav" aria-label="Primary">
                <ul class="site-nav__list">
                    <?php foreach ($nav as $path => $item): ?>
                        <li>
                            <a class="site-nav__link"
                               href="<?= $relroot . $path ?>"
                               <?= $section === $item['key'] ? 'aria-current="page"' : '' ?>><?= $item['label'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <button class="theme-toggle" type="button" aria-label="Switch between light and dark">
                <svg class="theme-toggle__moon" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="currentColor" d="M12 3a9 9 0 1 0 9 9c0-.46-.04-.92-.1-1.36A5.5 5.5 0 0 1 12.36 3.1 9.6 9.6 0 0 0 12 3Z"/></svg>
                <svg class="theme-toggle__sun" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
            </button>

            <button class="nav-toggle" aria-expanded="false" aria-controls="site-nav" aria-label="Toggle menu">
                <span></span>
            </button>
        </div>
    </header>

    <main id="main">
