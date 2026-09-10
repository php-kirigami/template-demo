/**
 * Bundled by the `js-core` esbuild task → scripts/kirigami.core.min.js
 *
 * Progressive enhancement only — the site is fully usable with JS disabled.
 * Kept dependency-free on purpose; `@kirigami/canva/scripts/*` offers the same
 * helpers if you'd rather import them.
 */

const documentReady = (fn) =>
    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', fn, { once: true })
        : fn();

documentReady(() => {

    /* ── Theme toggle ──────────────────────────────────────────────── */
    const root = document.documentElement;
    const prefersDark = matchMedia('(prefers-color-scheme: dark)');

    document.querySelector('.theme-toggle')?.addEventListener('click', () => {
        const current = root.dataset.theme || (prefersDark.matches ? 'dark' : 'light');
        const next = current === 'dark' ? 'light' : 'dark';
        root.dataset.theme = next;
        try { localStorage.setItem('theme', next); } catch {}
    });

    /* ── Mobile nav toggle ─────────────────────────────────────────── */
    const toggle = document.querySelector('.nav-toggle');
    const nav    = document.getElementById('site-nav');

    toggle?.addEventListener('click', () => {
        const open = nav.hasAttribute('data-open');
        nav.toggleAttribute('data-open', !open);
        toggle.setAttribute('aria-expanded', String(!open));
    });

    /* ── Copy button on every code block ───────────────────────────── */
    document.querySelectorAll('.prose pre').forEach((pre) => {
        const wrap = document.createElement('div');
        wrap.className = 'code-block';
        pre.replaceWith(wrap);
        wrap.append(pre);

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'copy-btn';
        btn.textContent = 'Copy';
        wrap.append(btn);

        btn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(pre.innerText.trim());
                btn.textContent = 'Copied';
                btn.setAttribute('data-copied', '');
                setTimeout(() => {
                    btn.textContent = 'Copy';
                    btn.removeAttribute('data-copied');
                }, 1600);
            } catch {
                btn.textContent = 'Press ⌘C';
            }
        });
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
