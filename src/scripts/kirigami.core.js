/**
 * Bundled by the `js-core` esbuild task → scripts/kirigami.core.min.js
 *
 * Progressive enhancement only — the site is fully usable with JS disabled.
 * Kept dependency-free on purpose. `@kirigami/canva/theme` ships this exact
 * theme-toggle contract as an import (and `@kirigami/canva/observer` the
 * reveal-on-scroll one) — this starter inlines tiny equivalents instead.
 * The code-block copy button is handled by @kirigami/plugin-highlight.
 */

const documentReady = (fn) =>
    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', fn, { once: true })
        : fn();

documentReady(() => {

    /* ── Theme toggle ──────────────────────────────────────────────────
       Mirrors @kirigami/canva/theme: persists under `kirigami-theme`, wires
       any [data-theme-toggle] control (bare = flip, or ="light|dark|auto"),
       reflects the resolved theme back onto it, and fires `canva:themechange`
       on window. The <head> has an inline FOUC guard that reads the same key. */
    const root = document.documentElement;
    const media = matchMedia('(prefers-color-scheme: dark)');
    const stored = () => { try { return localStorage.getItem('kirigami-theme') || 'auto'; } catch { return 'auto'; } };
    const resolved = () => {
        const a = root.dataset.theme;
        return a === 'light' || a === 'dark' ? a : (media.matches ? 'dark' : 'light');
    };

    const sync = () => {
        const theme = resolved();
        document.querySelectorAll('[data-theme-toggle]').forEach((el) => {
            el.dataset.themeState = theme;
            el.setAttribute('aria-pressed', String(theme === 'dark'));
        });
        dispatchEvent(new CustomEvent('canva:themechange', { detail: { theme, preference: stored() } }));
    };

    const setPref = (pref) => {
        const forced = pref === 'light' || pref === 'dark';
        try { forced ? localStorage.setItem('kirigami-theme', pref) : localStorage.removeItem('kirigami-theme'); } catch {}
        if (forced) root.dataset.theme = pref; else delete root.dataset.theme;
        sync();
    };

    document.querySelectorAll('[data-theme-toggle]').forEach((el) => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            const attr = el.getAttribute('data-theme-toggle');
            setPref(['auto', 'light', 'dark'].includes(attr) ? attr : (resolved() === 'dark' ? 'light' : 'dark'));
        });
    });
    media.addEventListener('change', () => { if (stored() === 'auto') sync(); });
    sync();

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
