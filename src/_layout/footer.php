    </main>

    <footer class="site-footer">
        <div class="wrap">
            <div class="site-footer__grid">
                <div class="site-footer__col">
                    <a class="brand" href="<?php echo $relroot; ?>">
                        <span class="brand__mark" aria-hidden="true"></span>
                        <?php echo str_htmlesc($project); ?>
                    </a>
                    <p style="margin-top:.6rem;max-width:24ch;color:var(--ink-muted)">
                        <?php echo str_htmlesc($tagline); ?>
                    </p>
                </div>

                <div class="site-footer__col">
                    <h3>Pages</h3>
                    <ul>
                        <li><a href="<?php echo $relroot; ?>">Home</a></li>
                        <li><a href="<?php echo $relroot; ?>features/">Features</a></li>
                        <li><a href="<?php echo $relroot; ?>about/">About</a></li>
                    </ul>
                </div>

                <div class="site-footer__col">
                    <h3>Kirigami</h3>
                    <ul>
                        <li><a href="https://github.com/php-kirigami/kirigami">Source</a></li>
                        <li><a href="https://github.com/php-kirigami/kiribuild">Deploy action</a></li>
                        <li><a href="<?php echo $relroot; ?>sitemap.xml">Sitemap</a></li>
                    </ul>
                </div>
            </div>

            <div class="site-footer__bottom">
                <span>&copy; <?php echo date('Y'); ?> <?php echo str_htmlesc($author); ?>. MIT licensed.</span>
                <span>Built with Kirigami · last updated {{build-date}}</span>
            </div>
        </div>
    </footer>
</body>
</html>
