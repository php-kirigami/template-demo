    </main>

    <footer class="site-footer">
        <div class="wrap">
            <div class="site-footer__grid">
                <div class="site-footer__col">
                    <a class="brand" href="<?= $relroot ?>">
                        <span class="brand__mark" aria-hidden="true"></span>
                        <?= str_htmlesc($project) ?>
                    </a>
                    <p style="margin-top:.6rem;max-width:24ch;color:var(--ink-muted)">
                        <?= str_htmlesc($tagline) ?>
                    </p>
                </div>

                <div class="site-footer__col">
                    <h3>Pages</h3>
                    <ul>
                        <li><a href="<?= $relroot ?>">Home</a></li>
                        <li><a href="<?= $relroot ?>features/">Features</a></li>
                        <li><a href="<?= $relroot ?>about/">About</a></li>
                    </ul>
                </div>

                <div class="site-footer__col">
                    <h3>Kirigami</h3>
                    <ul>
                        <li><a href="https://github.com/php-kirigami/kirigami">Source</a></li>
                        <li><a href="https://github.com/php-kirigami/kiribuild">Deploy action</a></li>
                        <li><a href="<?= $relroot ?>sitemap.xml">Sitemap</a></li>
                    </ul>
                </div>
            </div>

            <div class="site-footer__bottom">
                <span>&copy; <?= date('Y') ?> <?= str_htmlesc($author) ?>. MIT licensed.</span>
                <span>Built with Kirigami · last updated {{build-date}}</span>
            </div>
        </div>
    </footer>
</body>
</html>
