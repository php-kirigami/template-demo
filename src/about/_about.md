# About this demo

This site is the `template-demo` repo — the starter that
[`kiri create`](https://github.com/php-kirigami/kirigami) scaffolds from. Every
page is a small, real example of one Kirigami feature.

## How a page becomes HTML

1. The PHPDOC block is parsed; each annotation becomes a PHP variable.
2. Values ending in `.yaml` / `.json` / `.md` are loaded as data.
3. `_layout/header.php` is included, then the page body, then `_layout/footer.php`.
4. Registered tags run on the assembled HTML — `<markdown>`, `<img asset>`, `<swatches>`.
5. `post_render` hooks fire, and the `.html` file is written.

This page is pure Markdown. Its `_index.php` is nothing but a PHPDOC block with
`@content _about.md` and `@indent 4`: the PHP is never executed for output, so
the layout just wraps the converted file.

## Stack

- **Kirigami** — the generator
- **@kirigami/canva** — shared Sass tokens and the folded-paper logo
- **esbuild** + **Dart Sass** — the two build tasks
- **@kirigami/kiribuild** — deploys on push to `main`

> [!TIP]
> Run `npx kiri watch` and point VS Code Live Server at `src/` for a live preview.
