/**
 * Bundled by the `js-core` esbuild task → scripts/kirigami.core.min.js
 *
 * Progressive enhancement only — the site is fully usable with JS disabled.
 * The code-block copy button is handled by @kirigami/plugin-highlight.
 */

// Theme toggle: wires every [data-theme-toggle] control (bare = flip, or
// ="light|dark|auto"), persists under `kirigami-theme`, reflects the resolved
// theme back onto the control, keeps it in sync with OS changes in auto mode,
// and fires `canva:themechange` on window. The <head> has an inline FOUC guard
// that reads the same key.
import "@kirigami/canva/theme";

// Reveal on scroll: adds `is-in` to each [data-reveal] as it enters the
// viewport. The CSS half (hide until `.is-in`, gated on `.js`) is in
// styles/partials/_main.scss.
import "@kirigami/canva/reveal";

const documentReady = (fn) =>
    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', fn, { once: true })
        : fn();

documentReady(() => {

    /* ── Mobile nav toggle ─────────────────────────────────────────── */
    const toggle = document.querySelector('.nav-toggle');
    const nav    = document.getElementById('site-nav');

    toggle?.addEventListener('click', () => {
        const open = nav.hasAttribute('data-open');
        nav.toggleAttribute('data-open', !open);
        toggle.setAttribute('aria-expanded', String(!open));
    });
});
