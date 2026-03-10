/* ─────────────────────────────────────────────
   ROLEX — Inspired by atom.uprock.pro
   Script: clock, marker generation, scroll FX
───────────────────────────────────────────── */

(function () {
    'use strict';

    // ── Utility ────────────────────────────────
    const $ = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

    // ── Generate hour markers into a dial container ──
    function buildMarkers(container, isDark = false) {
        if (!container) return;
        // Use requestAnimationFrame so element is rendered and has dimensions
        requestAnimationFrame(() => {
            const dialSize = container.parentElement.offsetWidth;
            const cx = dialSize / 2;
            const cy = dialSize / 2;

            for (let i = 0; i < 60; i++) {
                const marker = document.createElement('div');
                const angleDeg = (i / 60) * 360 - 90;
                const angleRad = angleDeg * Math.PI / 180;
                const isHour = i % 5 === 0;

                const outerR = cx * 0.88;
                const innerR = cx * (isHour ? 0.78 : 0.84);

                const x1 = cx + Math.cos(angleRad) * outerR;
                const y1 = cy + Math.sin(angleRad) * outerR;
                const x2 = cx + Math.cos(angleRad) * innerR;
                const y2 = cy + Math.sin(angleRad) * innerR;

                const len = Math.hypot(x2 - x1, y2 - y1);
                const ang = Math.atan2(y2 - y1, x2 - x1) * 180 / Math.PI;

                marker.style.cssText = `
                    position: absolute;
                    left: ${x1}px;
                    top: ${y1 - (isHour ? 1.5 : 0.75)}px;
                    width: ${len}px;
                    height: ${isHour ? '3px' : '1.5px'};
                    background: ${isDark ? (isHour ? 'rgba(255,255,255,0.75)' : 'rgba(255,255,255,0.25)') : (isHour ? 'rgba(0,0,0,0.55)' : 'rgba(0,0,0,0.18)')};
                    border-radius: 2px;
                    transform-origin: 0 50%;
                    transform: rotate(${ang}deg);
                    pointer-events: none;
                `;
                container.appendChild(marker);
            }
        });
    }

    // ── Set hand rotation ───────────────────────
    function setHand(el, deg) {
        if (el) el.style.transform = `rotate(${deg}deg)`;
    }

    // ── Live Clock ──────────────────────────────
    function updateClock() {
        const now = new Date();
        const s = now.getSeconds() + now.getMilliseconds() / 1000;
        const m = now.getMinutes() + s / 60;
        const h = (now.getHours() % 12) + m / 60;

        const sDeg = s * 6;
        const mDeg = m * 6;
        const hDeg = h * 30;

        // Hero watch
        setHand($('#hourHand'), hDeg);
        setHand($('#minuteHand'), mDeg);
        setHand($('#secondHand'), sDeg);

        // Small features watch
        setHand($('#hourHandSm'), hDeg);
        setHand($('#minuteHandSm'), mDeg);
        setHand($('#secondHandSm'), sDeg);

        // Large aesthetics watch
        setHand($('#hourHandLg'), hDeg);
        setHand($('#minuteHandLg'), mDeg);
        setHand($('#secondHandLg'), sDeg);
    }

    // ── Navbar scroll state ─────────────────────
    function initNavbar() {
        const nav = $('#navbar');
        const darkSections = ['.statement-section', '.features-section', '.world-section', '.footer-section'];

        function updateNav() {
            const sy = window.scrollY;
            // Check if we're over a dark section
            let overDark = false;
            darkSections.forEach(sel => {
                const el = $(sel);
                if (!el) return;
                const rect = el.getBoundingClientRect();
                if (rect.top < 60 && rect.bottom > 0) overDark = true;
            });
            nav.classList.toggle('dark-nav', overDark);
        }

        window.addEventListener('scroll', updateNav, { passive: true });
        updateNav();
    }

    // ── Scroll parallax for hero watch ──────────
    function initHeroParallax() {
        const wrap = $('#watchFaceWrap');
        if (!wrap) return;

        window.addEventListener('scroll', () => {
            const sy = window.scrollY;
            const vh = window.innerHeight;
            if (sy > vh) return; // only in hero
            const progress = sy / vh; // 0 → 1

            // Slightly move watch up and scale down as we scroll
            const translateY = -progress * 80;
            const scale = 1 - progress * 0.25;
            const opacity = 1 - progress * 1.4;

            wrap.style.transform = `translateY(${translateY}px) scale(${scale})`;
            wrap.style.opacity = Math.max(0, opacity);
        }, { passive: true });
    }

    // ── Reveal on scroll (IntersectionObserver) ─
    function initReveal() {
        const els = $$('.reveal-text, .aesthetics-text, .heritage-eyebrow, .heritage-title, .heritage-body');

        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

        els.forEach(el => io.observe(el));
    }

    // ── Feature words parallax ──────────────────
    function initFeatureParallax() {
        const section = $('.features-section');
        if (!section) return;
        const words = $$('.feature-word', section);

        // Initial visibility animation
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    words.forEach((w, i) => {
                        setTimeout(() => {
                            w.style.opacity = '1';
                            w.style.transform = getWordTransform(w, 0);
                        }, i * 120);
                    });
                }
            });
        }, { threshold: 0.2 });

        words.forEach(w => {
            w.style.opacity = '0';
            w.style.transition = 'opacity 0.8s ease, transform 0.8s cubic-bezier(0.16,1,0.3,1)';
        });

        io.observe(section);

        // Subtle parallax on scroll
        window.addEventListener('scroll', () => {
            const rect = section.getBoundingClientRect();
            if (rect.top > window.innerHeight || rect.bottom < 0) return;
            const progress = (-rect.top) / rect.height; // -0 to 1

            words.forEach(w => {
                const shift = progress * 30 * (w.classList.contains('word-tl') || w.classList.contains('word-tr') ? -1 : 1);
                w.style.transform = getWordTransform(w, shift);
            });
        }, { passive: true });
    }

    function getWordTransform(w, yShift) {
        if (w.classList.contains('word-tr') || w.classList.contains('word-br')) {
            return `translateY(${yShift}px)`;
        }
        return `translateY(${yShift}px)`;
    }

    // ── Smooth nav link scrolling ───────────────
    function initNavLinks() {
        $$('a[href^="#"]').forEach(link => {
            link.addEventListener('click', e => {
                const id = link.getAttribute('href');
                const target = $(id);
                if (!target) return;
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });
    }

    // ── Section entrance animations ─────────────
    function initSectionAnimations() {
        const sections = $$('.world-section .world-inner > *');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.opacity = '1';
                    e.target.style.transform = 'translateY(0)';
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.2 });

        sections.forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(40px)';
            el.style.transition = `opacity 0.8s ease ${i * 0.12}s, transform 0.8s cubic-bezier(0.16,1,0.3,1) ${i * 0.12}s`;
            io.observe(el);
        });
    }

    // ── Scroll hint fade ────────────────────────
    function initScrollHint() {
        const hint = $('.scroll-hint');
        if (!hint) return;
        window.addEventListener('scroll', () => {
            hint.style.opacity = window.scrollY > 80 ? '0' : '0.6';
        }, { passive: true });
    }

    // ── Init ────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {

        // Build markers
        buildMarkers($('#hourMarkersEl'), false);
        buildMarkers($('#hourMarkersSmEl'), true);
        buildMarkers($('#hourMarkersLgEl'), false);

        // Start clock with rAF for smooth animation
        function tick() {
            updateClock();
            requestAnimationFrame(tick);
        }
        tick();

        // All other inits
        initNavbar();
        initHeroParallax();
        initReveal();
        initFeatureParallax();
        initNavLinks();
        initSectionAnimations();
        initScrollHint();
    });

})();
