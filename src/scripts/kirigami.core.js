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
// that reads the same key. `@kirigami/canva/observer` similarly ships the
// reveal-on-scroll contract — this starter keeps a tiny equivalent inline.
import "@kirigami/canva/theme";

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

    /* ── Reveal-on-scroll ──────────────────────────────────────────── */
    const reveal = [...document.querySelectorAll('[data-reveal]')];
    const show = (el) => el.classList.add('is-in');

    if (reveal.length && 'IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (!e.isIntersecting) return;
                show(e.target);
                io.unobserve(e.target);
            });
        }, { rootMargin: '0px 0px -8% 0px' });

        // Anything already on screen shows now; the rest waits for scroll.
        reveal.forEach((el) => {
            if (el.getBoundingClientRect().top < innerHeight) show(el);
            else io.observe(el);
        });

        // Safety net: never leave content hidden.
        setTimeout(() => reveal.forEach(show), 1200);
    } else {
        reveal.forEach(show);
    }
});
