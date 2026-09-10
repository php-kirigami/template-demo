# Todo — template-demo

Project-specific tasks for this repo. Toolchain / plugin / core work lives in
`php-kirigami/kirigami`'s own `todo.md`.

---

## Open

- **Decide the theme toggle: keep inlined, or `import "@kirigami/canva/theme"`.**
  `src/scripts/kirigami.core.js` currently hand-rolls the toggle (its own comment
  says this is deliberate — "this starter inlines tiny equivalents instead"). It
  already mirrors the canva 2.1.0 contract exactly: `kirigami-theme` key,
  `[data-theme-toggle]` (bare = flip, or `="light|dark|auto"`),
  `data-theme-state` / `aria-pressed`, `canva:themechange` on `window`, re-sync
  on OS change while in `auto`. `@kirigami/canva` is already a devDependency.
  - If we switch: `import "@kirigami/canva/theme"` wires it on import
    (`bindToggles()`); `@kirigami/canva/observer` covers reveal-on-scroll; the
    burger nav could move to `@kirigami/canva/components/burger`. That trims
    `kirigami.core.js` to near-empty — which is the better demo of "you don't
    write this yourself".
  - If we keep it inlined: drop the "TODO" framing, it's a design choice. The
    starter shows the contract without a dependency.

- **`image.format` stays `webp`.** avif fails to encode at several sizes in the
  current `@kirigami/php-wasm` `IMG` build. Revisit when that's fixed upstream.

- **`G-XXXXXXXXXX` in `src/features/data/index.html`** is a deliberate demo
  placeholder (analytics id example). Leave it, just don't "fix" it into a real
  id.

- **Inline SVG in the theme toggle serialises lowercase** (`viewBox` →
  `viewbox`, etc.). Now that `prepros.format: true`, `HTML::format()` lowercases
  every element/attribute name, including camelCase SVG foreign content.
  Browsers re-fix it at parse (foreign-content adjustment) so the icons render,
  but the emitted source is technically invalid. Upstream toolchain bug — logged
  in `php-kirigami/kirigami`'s `todo.md` as a DX issue; nothing to do in this
  repo but don't be surprised by it in the built output.

---

## Done

Completed items are kept as HTML comments below (visible in source, out of the
rendered list) so we don't redo them.

<!-- commit d227127 "Rebuild template-demo as a full feature tour" + follow-ups:
- `plugins:` block active in `kirigami.yaml` with the current
  `name` / `active` / `options` API (`@kirigami/plugin-highlight`) — the old
  `options: { style, color }` shape is gone.
- Hand-rolled copy button removed from `kirigami.core.js`; the `.copy-btn` /
  `.code-block` SCSS is gone. `@kirigami/plugin-highlight`'s `copyButton` owns
  the button (layout via `sass:after`, script folded into `js-core` via
  `esbuild:after`).
- Code-block + inline-`code` styling comes from the plugin's `theme: auto`
  sheet, appended to `css-core` (see `_main.scss` notes).
- `_conf.scss` is `$theme: both`; `_main.scss` handles `data-theme` light/dark.
-->

<!-- prepros.format re-enabled (2026-09-10):
`prepros.format: true` in `kirigami.yaml`. `@kirigami/php-prepros` 1.4.0+ keeps
`<pre>` / `<textarea>` verbatim, so the old whitespace-collapse issue is gone.
Output on every tour page (incl. the highlighted `<pre>` blocks and the
`<highlight>` tag) verified clean.
-->

<!-- markdown / highlight source indentation (2026-09-10):
`<markdown>` / `<highlight>` blocks in the page sources are indented to sit under
their `<div class="prose">` (both tags strip common leading indentation, so the
rendered output is unaffected — this is source readability only).
-->
