# template-demo

A guided tour of [Kirigami](https://github.com/php-kirigami/kirigami) — the
zero-dependency static site generator that compiles PHP page templates to plain
HTML, running PHP 8.5 in WebAssembly.

Each page under `src/features/` demonstrates one capability with its source
alongside the result: Markdown + shortcodes, the image autogenerator, fenced
code, YAML/JSON/Markdown data files (local and over the network), and custom
tags / hooks.

## Develop

```console
npm install
npx kiri watch      # rebuild on change (no server)
```

Point an editor preview server (e.g. VS Code Live Server) at `src/` for a live
browser.

```console
npx kiri build      # one-off dev build
npx kiri export     # production build into dist/
```

## Images

`assets/images/` holds two placeholder source images — `cover.jpg` (wide, used
for the palette + hero) and `detail.jpg` (used for the resize / crop demos).
Replace them with real artwork; the build regenerates everything in
`src/images/`.

MIT © The Kirigami Team
