<div align="center">

<img src="https://zmotrin.github.io/assets/kirigami/kirigami-logo-universal.svg" alt="Kirigami" width="400" />

---

# template-demo

A guided tour of **[Kirigami](https://github.com/php-kirigami/kirigami)** — the
zero-dependency static site generator that compiles PHP page templates to plain
HTML, running PHP 8.5 in WebAssembly inside Node. No PHP install, no server, no
headless browser.

The site doubles as an official starter: `npx kiri create template-demo` gives
you this exact project to strip down and build on.

[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE)
[![Node](https://img.shields.io/badge/node-%3E%3D24.0.0-brightgreen)](#develop)
[![Claude.ai Ready](https://img.shields.io/badge/Claude.ai-Ready-d97757.svg)](#claudeai-ready)
[![Live demo](https://img.shields.io/badge/demo-GitHub%20Pages-24292f.svg)](https://php-kirigami.github.io/template-demo/)

</div>

---

## What's inside

The home page (`src/_index.php`) links to seven feature pages under
`src/features/`, each demonstrating one Kirigami capability with its source shown
next to the result:

| Page | Shows |
|---|---|
| **Markdown** | the built-in GFM engine — tables, footnotes, alerts, emoji — and `{% shortcode %}` plugins, usable from a `<markdown>` tag, a `.md` data file, or `MD::toHtml()`. |
| **Images** | the image autogenerator: resize, crop-to-fill and palette sampling from Sass, PHP and an `<img asset="…">` tag, with no native image dependency. |
| **Code** | fenced code blocks highlighted at build time by `@kirigami/plugin-highlight` (highlight.js spans baked in, nothing shipped to the browser) plus its copy button. |
| **Data files** | pointing a PHPDOC annotation at a YAML / JSON file to get structured data — including a fetch over the network at build time (`prepros.network: true`). |
| **Tags & hooks** | registering a custom HTML tag, a Markdown shortcode and render-pipeline hooks from one `_lib/functions.php` includes file. |
| **Audio** | `<player>` / `<playlist>` from `@kirigami/plugin-player`: a waveform, tags and cover art baked at build time from the audio file, cached in `src/_data/player/`. |
| **Video** | `<clip>` / `<inline-clip>` from `@kirigami/plugin-clip`: a local video whose poster is picked at build time by `@kirigami/bestframe`, and a silent looping clip. |

Also here: a shared layout (`src/_layout/`), a `feature` page type that gives
every feature page its breadcrumb and heading, a `@kirigami/canva` design system
with a warm "washi paper" palette, light/dark theming with a FOUC-guarded toggle,
and a CI workflow that builds and deploys to GitHub Pages on every push to `main`.

## Project structure

```
.
├── kirigami.yaml          # the one config file
├── CLAUDE.md              # project conventions for AI assistants (see below)
├── assets/
│   ├── images/            #   originals for the image autogenerator
│   └── fonts/
├── scripts/               # named PHP scripts for `kiri run`
└── src/                   # = kirigami.root — the site
    ├── _layout/           #   header.php / footer.php, types/feature.*.php
    ├── _lib/functions.php #   custom tags / hooks / shortcodes
    ├── _index.php         #   → src/index.html
    ├── features/          #   the seven feature pages
    ├── about/
    ├── styles/            #   Sass entry, compiled to *.min.css
    ├── scripts/           #   esbuild entry, bundled to *.min.js
    └── images/            #   generated images (never hand-edit)
```

## Develop

Requires **Node `>= 24`** and **npm `>= 10.2.3`**.

```console
npm install
npx kiri serve      # build, then rebuild on save with a live-reloading local server
```

```console
npx kiri watch      # rebuild on save, no server
npx kiri build      # one-off dev build
npx kiri export     # production build into dist/
npx kiri run <script> [args…]   # run scripts/<script>.php in the PHP runtime
```

Every command takes `--help`. In VS Code, the recommended Kirigami extension
runs the same commands and the dev server from the Command Palette and the
status bar.

## Images

`assets/images/` holds two placeholder source images — `cover.jpg` (wide, used
for the palette + hero) and `detail.jpg` (used for the resize / crop demos).
Replace them with real artwork; the build regenerates everything in `src/images/`
(keep target sizes ≤ the source dimensions — upscaling throws).

## Deployment

`.github/workflows/page.yml` runs on every push to `main`: it builds with
[`php-kirigami/kiribuild@v2`](https://github.com/php-kirigami/kiribuild), commits
back anything the build regenerated (e.g. `src/images/` derivatives), then
publishes `dist/` to GitHub Pages. Enable it once per repo under
**Settings → Pages → Source: GitHub Actions**.

## Claude.ai Ready

This template ships a **`CLAUDE.md`** at the repo root: the project's conventions,
the page-authoring model (PHPDOC headers, data files, page types, built-in tags)
and where to find the full reference, in the READMEs of the installed
`@kirigami/*` packages, which always match the versions the project uses.

It is read automatically by **[Claude Code](https://claude.com/claude-code)** and
by **Claude on [claude.ai](https://claude.ai)** when the repo is connected, so an
assistant can work on the project productively from the first prompt — without you
pasting docs or it guessing at the conventions. The same file works for any tool
that picks up `CLAUDE.md` / `AGENTS.md`-style context.

If you scaffold your own site from this template, keep `CLAUDE.md` and fill in its
top "What this project is" block for your project.

## License

MIT © 2026 Kirigami — see [LICENSE](./LICENSE).
