<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customize Your Watch — Fylex Master</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,500&family=Jost:wght@200;300;400;500;600&display=swap" rel="stylesheet">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

  <style>
    :root {
      --bg-brown: #5c4238;
      --bg-brown-light: #7a5c50;
      --text-white: #ffffff;
      --text-offwhite: rgba(255, 255, 255, 0.7);
      --accent: #E8A87A;
      --nav-bg: #F8F5F2;
      --nav-text: #1C2535;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
      font-family: 'Jost', sans-serif;
      background: var(--bg-brown);
      color: var(--text-white);
      overflow-x: hidden;
    }

    /* ── HERO CONFIGURATOR ── */
    #configurator {
      height: 100vh;
      width: 100%;
      background: radial-gradient(circle at center, var(--bg-brown-light) 0%, var(--bg-brown) 100%);
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      z-index: 5;
    }

    .c-header {
      position: absolute;
      top: 40px;
      left: 60px;
      z-index: 10;
    }

    .c-title {
      font-family: 'Jost', sans-serif;
      font-weight: 600;
      font-size: clamp(32px, 4vw, 56px);
      letter-spacing: -1px;
    }

    .close-btn {
      position: absolute;
      top: 40px;
      right: 60px;
      width: 40px;
      height: 40px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-decoration: none;
      font-size: 20px;
      transition: background 0.3s;
      z-index: 20;
    }

    .close-btn:hover { background: rgba(255,255,255,0.2); }

    .c-main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .watch-preview {
      height: 65vh;
      object-fit: contain;
      filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));
      transition: opacity 0.4s ease;
      will-change: transform, filter, opacity;
      transform: translateZ(0);
    }

    .thumbnails {
      position: absolute;
      right: 60px;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      gap: 20px;
      z-index: 15;
    }

    .thumb {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      border: 1px solid rgba(255,255,255,0.3);
      background: rgba(0,0,0,0.1);
      overflow: hidden;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: border-color 0.3s;
    }

    .thumb.active { border-color: white; }
    .thumb img { width: 80%; height: 80%; object-fit: contain; opacity: 0.8; }
    .thumb.active img { opacity: 1; }

    .controls-left {
      position: absolute;
      bottom: 140px;
      left: 60px;
      z-index: 15;
    }

    .step-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 16px;
    }

    .options-row {
      display: flex;
      gap: 30px;
      font-size: 15px;
      font-weight: 500;
      color: var(--text-offwhite);
      flex-wrap: wrap;
    }

    .opt { cursor: pointer; transition: color 0.3s; }
    .opt.active { color: white; }

    .next-step-wrap {
      position: absolute;
      bottom: 120px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 15;
    }

    .btn-next {
      background: white;
      color: var(--nav-text);
      font-family: 'Jost', sans-serif;
      font-size: 14px;
      font-weight: 600;
      padding: 14px 40px;
      border-radius: 30px;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: transform 0.2s;
      white-space: nowrap;
    }

    .btn-next:hover { transform: scale(1.05); }

    .summary-bar {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 90px;
      background: var(--nav-bg);
      color: var(--nav-text);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 60px;
      z-index: 20;
    }

    .s-info {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .s-model { font-weight: 600; font-size: 14px; }
    .s-specs { font-size: 13px; color: rgba(28, 37, 53, 0.6); }
    .s-price { font-size: 13px; font-weight: 500; margin-top: 2px; }

    .s-add {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: var(--nav-text);
      color: white;
      border: none;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.3s;
      flex-shrink: 0;
    }

    .s-add:hover { background: #000; }

    /* ═══════════════════════════════════════════
       PARALLAX STORY SECTION
    ═══════════════════════════════════════════ */
    #story {
      display: none;
      background: var(--bg-brown);
      color: var(--text-white);
      position: relative;
      overflow: hidden;
    }

    .orb {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      will-change: transform;
      filter: blur(80px);
      opacity: 0.25;
      z-index: 0;
      transform: translateZ(0);
    }
    .orb-1 { width: 600px; height: 600px; background: #E8A87A; top: -100px; left: -200px; }
    .orb-2 { width: 500px; height: 500px; background: #b08060; top: 40%; right: -150px; }
    .orb-3 { width: 400px; height: 400px; background: #c8956a; bottom: 200px; left: 20%; }

    .grid-lines {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
      opacity: 0.04;
    }
    .grid-lines::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 79px,
        rgba(255,255,255,0.6) 80px
      );
    }

    .chapter-num {
      position: absolute;
      top: 0.1em;
      left: -0.05em;
      font-family: 'Playfair Display', serif;
      font-size: 35vw;
      font-weight: 700;
      line-height: 0.8;
      color: rgba(255,255,255,0.03);
      pointer-events: none;
      z-index: 1;
      will-change: transform;
      user-select: none;
    }

    .accent-line {
      display: block;
      width: 80px;
      height: 2px;
      background: var(--accent);
      margin-bottom: 24px;
      transform-origin: left;
      will-change: transform;
    }

    .s-block {
      position: relative;
      height: 100vh;
      width: 100%;
      display: flex;
      align-items: center;
      padding: 0 10%;
      overflow: hidden;
      will-change: transform;
      backface-visibility: hidden;
      transform: translateZ(0);
      background: var(--bg-brown);
    }

    #b1 { z-index: 10; }
    #b2 { z-index: 20; }
    #b3 { z-index: 30; }
    #b4 { z-index: 40; }
    #b5 { z-index: 50; }

    .s-block:nth-child(even) .s-text-wrap {
      margin-left: auto;
      text-align: right;
    }
    .s-block:nth-child(even) .accent-line {
      margin-left: auto;
    }
    .s-block:nth-child(even) .chapter-num {
      left: auto;
      right: -0.05em;
    }

    .s-text-wrap {
      position: relative;
      z-index: 2;
      max-width: 620px;
    }

    .s-block h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(36px, 4.5vw, 64px);
      font-weight: 500;
      line-height: 1.1;
      margin-bottom: 28px;
      color: #fff;
      will-change: transform;
    }

    .s-block h2 em {
      font-style: italic;
      color: var(--accent);
    }

    .s-block p {
      font-size: clamp(16px, 1.4vw, 20px);
      line-height: 1.85;
      color: rgba(255,255,255,0.62);
      font-weight: 300;
    }

    .s-img-strip {
      position: absolute;
      right: 60px;
      top: 50%;
      transform: translateY(-50%);
      width: clamp(160px, 20vw, 280px);
      opacity: 0.12;
      pointer-events: none;
      will-change: transform;
    }
    .s-block:nth-child(even) .s-img-strip {
      right: auto;
      left: 60px;
    }

    .s-divider {
      height: 1px;
      margin: 0;
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 60;
      background: rgba(255,255,255,0.05);
    }

    .w-layer {
      position: absolute;
      top: 50%;
      right: clamp(40px, 8vw, 120px);
      transform: translateY(-50%);
      width: clamp(330px, 42vw, 620px);
      height: clamp(330px, 42vw, 620px);
      pointer-events: none;
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .w-layer img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: contain;
      will-change: transform, opacity;
    }
    .rim-img { z-index: 2; }
    .dial-img { z-index: 1; opacity: 0; }

    .s-tracker {
      position: fixed;
      right: 32px;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 14px;
      z-index: 100;
      mix-blend-mode: normal;
    }

    .dot {
      width: 3px;
      height: 22px;
      background: rgba(255,255,255,0.25);
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
    }

    .dot.active {
      background: var(--accent);
      transform: scaleY(1.9);
    }

    .scroll-hint {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      opacity: 0.5;
      font-size: 11px;
      letter-spacing: 3px;
      text-transform: uppercase;
      z-index: 10;
      animation: bounceDown 2s ease-in-out infinite;
      will-change: transform, opacity;
    }

    @keyframes bounceDown {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50%  { transform: translateX(-50%) translateY(8px); }
    }

    .scroll-hint svg { opacity: 0.7; }

    .dial-carousel-container {
      position: absolute;
      width: 100%;
      height: 100%;
      display: none;
      align-items: center;
      justify-content: center;
      gap: 30px;
      z-index: 25;
      pointer-events: none;
    }

    .dial-carousel {
      display: flex;
      align-items: center;
      gap: 120px;
      pointer-events: auto;
    }

    .dial-item {
      width: 220px;
      height: 220px;
      aspect-ratio: 1 / 1;
      cursor: pointer;
      transition: transform 0.3s, opacity 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      padding: 0;
      background: transparent !important;
    }

    .dial-item img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
      mix-blend-mode: screen;
    }

    .dial-item:hover { transform: scale(1.1); }
    .dial-item.hidden { opacity: 0; pointer-events: none; }

    .dial-nav-btn {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.3s;
      font-size: 18px;
      flex-shrink: 0;
      pointer-events: auto;
    }

    .dial-nav-btn:hover { background: rgba(255,255,255,0.2); }

    .dial-filters {
      position: absolute;
      bottom: 200px;
      left: 50%;
      transform: translateX(-50%);
      display: none;
      gap: 30px;
      font-size: 14px;
      font-weight: 500;
      color: var(--text-offwhite);
      z-index: 30;
      flex-wrap: wrap;
      justify-content: center;
      width: 90%;
    }

    .dial-filter-opt {
      cursor: pointer;
      transition: color 0.3s;
    }

    .dial-filter-opt.active { color: white; }

    #activeDialLayer {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 220px;
      height: 220px;
      pointer-events: none;
      z-index: 6;
      opacity: 0;
    }

    #activeDialLayer img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    /* ═══════════════════════════════════════════
       RESPONSIVE STYLES
    ═══════════════════════════════════════════ */

    /* ── Tablet: 768px – 1024px ── */
    @media (max-width: 1024px) {
      .c-header { left: 32px; top: 28px; }
      .close-btn { right: 32px; top: 28px; }

      .thumbnails {
        right: 20px;
        gap: 14px;
      }

      .thumb { width: 40px; height: 40px; }

      .controls-left {
        left: 32px;
        bottom: 110px;
      }

      .step-title { font-size: 17px; }
      .options-row { gap: 20px; font-size: 14px; }

      .next-step-wrap { bottom: 100px; }

      .summary-bar { padding: 0 32px; height: 80px; }

      .watch-preview { height: 52vh; }

      /* Story blocks */
      .s-block { padding: 0 7%; }

      .w-layer {
        right: clamp(20px, 5vw, 60px);
        width: clamp(240px, 35vw, 420px);
        height: clamp(240px, 35vw, 420px);
        opacity: 0.35;
      }

      .dial-carousel { gap: 60px; }
      .dial-item { width: 170px; height: 170px; }

      .dial-filters { bottom: 160px; gap: 18px; font-size: 13px; }

      .s-tracker { right: 18px; }
    }

    /* ── Mobile: ≤ 767px ── */
    @media (max-width: 767px) {
      /* Header */
      .c-header { left: 20px; top: 20px; }
      .c-title { font-size: clamp(22px, 6vw, 32px); }
      .close-btn { right: 20px; top: 20px; width: 34px; height: 34px; font-size: 18px; }

      /* Watch preview — centred, smaller */
      .watch-preview { height: 38vh; max-width: 75vw; }

      /* Thumbnails: horizontal strip above summary bar */
      .thumbnails {
        position: absolute;
        right: unset;
        top: unset;
        left: 50%;
        bottom: 230px;
        transform: translateX(-50%);
        flex-direction: row;
        gap: 12px;
      }

      .thumb { width: 36px; height: 36px; }

      /* Controls: centred above thumbnails */
      .controls-left {
        left: 50%;
        transform: translateX(-50%);
        bottom: 160px;
        text-align: center;
        width: 90%;
      }

      .step-title { font-size: 15px; margin-bottom: 10px; text-align: center; }

      .options-row {
        justify-content: center;
        gap: 16px;
        font-size: 13px;
        flex-wrap: wrap;
      }

      /* Next btn sits just above summary bar */
      .next-step-wrap { bottom: 84px; }
      .btn-next { padding: 12px 28px; font-size: 13px; }

      /* Summary bar */
      .summary-bar {
        padding: 0 20px;
        height: 72px;
      }
      .s-model { font-size: 13px; }
      .s-specs { font-size: 11px; }
      .s-price { font-size: 11px; }
      .s-add { width: 38px; height: 38px; font-size: 20px; }

      /* ── Story blocks on mobile ── */
      .s-block {
        padding: 60px 6%;
        align-items: flex-end;
        height: 100vh;
      }

      .w-layer {
        top: 12vh;
        right: 50%;
        transform: translateX(50%);
        width: 55vw;
        height: 55vw;
        opacity: 0.15;
        pointer-events: none;
      }

      /* Always left-align text on mobile */
      .s-block:nth-child(even) .s-text-wrap {
        margin-left: 0;
        text-align: left;
      }
      .s-block:nth-child(even) .accent-line { margin-left: 0; }
      .s-block:nth-child(even) .chapter-num {
        left: -0.05em;
        right: auto;
      }

      .s-text-wrap { max-width: 100%; }
      .s-block h2 { font-size: clamp(28px, 7vw, 42px); margin-bottom: 18px; }
      .s-block p  { font-size: clamp(14px, 3.8vw, 18px); line-height: 1.75; }
      .chapter-num { font-size: 55vw; opacity: 0.025; }

      /* Tracker */
      .s-tracker { right: 12px; gap: 10px; }
      .dot { width: 2px; height: 16px; }

      /* Dial carousel */
      .dial-carousel-container {
        top: auto;
        bottom: 190px;
        height: auto;
        width: 100%;
        gap: 8px;
        padding: 0 10px;
      }

      .dial-carousel {
        gap: 18px;
        flex-wrap: nowrap;
        overflow-x: auto;
        overflow-y: hidden;
        padding: 10px 8px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        max-width: calc(100vw - 110px);
        touch-action: pan-x;
      }
      .dial-carousel::-webkit-scrollbar { display: none; }
      .dial-item { width: 80px; height: 80px; flex-shrink: 0; }
      .dial-nav-btn { width: 34px; height: 34px; font-size: 15px; flex-shrink: 0; }

      /* Dial filters */
      .dial-filters {
        bottom: 150px;
        gap: 14px;
        font-size: 12px;
        flex-wrap: nowrap;
        overflow-x: auto;
        width: 88%;
        justify-content: flex-start;
        padding-bottom: 4px;
        scrollbar-width: none;
      }
      .dial-filters::-webkit-scrollbar { display: none; }
      .dial-filter-opt { white-space: nowrap; }

      /* Orbs — scale down */
      .orb-1 { width: 300px; height: 300px; }
      .orb-2 { width: 250px; height: 250px; }
      .orb-3 { width: 200px; height: 200px; }
    }

    /* ── Very small screens: ≤ 480px ── */
    @media (max-width: 480px) {
      .watch-preview { height: 35vh; max-width: 70vw; }

      .thumbnails { bottom: 220px; }
      .controls-left { bottom: 150px; }
      .next-step-wrap { bottom: 80px; }

      .summary-bar { height: 68px; }
      .options-row { gap: 12px; }

      .dial-carousel-container { bottom: 170px; }
      .dial-item { width: 70px; height: 70px; }

      .s-block h2 { font-size: clamp(24px, 6vw, 36px); }
    }

    /* ── Very small screens: ≤ 380px ── */
    @media (max-width: 380px) {
      .watch-preview { height: 32vh; max-width: 65vw; }

      .thumbnails { bottom: 210px; gap: 10px; }
      .thumb { width: 32px; height: 32px; }

      .controls-left { bottom: 140px; }
      .next-step-wrap { bottom: 76px; }
      .btn-next { padding: 10px 22px; font-size: 12px; }

      .summary-bar { height: 64px; padding: 0 16px; }

      .dial-carousel-container { bottom: 155px; }
      .dial-item { width: 60px; height: 60px; }
      .dial-nav-btn { width: 30px; height: 30px; font-size: 14px; }

      .dial-filters { bottom: 140px; font-size: 11px; }
    }

    /* ── Landscape mobile fix ── */
    @media (max-width: 767px) and (orientation: landscape) {
      .watch-preview { height: 60vh; max-width: 40vw; }

      .thumbnails {
        right: 20px;
        left: unset;
        top: 50%;
        bottom: unset;
        transform: translateY(-50%);
        flex-direction: column;
        gap: 10px;
      }

      .controls-left {
        left: 20px;
        transform: none;
        bottom: 80px;
        text-align: left;
        width: auto;
      }

      .step-title { text-align: left; }
      .options-row { justify-content: flex-start; }

      .next-step-wrap { bottom: 72px; }

      .summary-bar { height: 60px; }

      .s-block { padding: 20px 8%; align-items: center; }
      .s-block h2 { font-size: clamp(22px, 4vw, 36px); margin-bottom: 12px; }
      .s-block p { font-size: clamp(13px, 2vw, 16px); line-height: 1.6; }

      .w-layer {
        top: 50%;
        right: 5vw;
        transform: translateY(-50%);
        width: 35vw;
        height: 35vw;
        opacity: 0.2;
      }
    }
  </style>
</head>
<body>

  <!-- HERO CONFIGURATOR -->
  <section id="configurator">
    <header class="c-header">
      <h1 class="c-title" id="watchTitle">Day-Date 40</h1>
    </header>
    <a href="configure.php" class="close-btn">×</a>

    <div class="c-main">
      <img src="assets/fylex-watch-v2/40mm.png" alt="Watch preview" class="watch-preview" id="previewImg">
      <div id="activeDialLayer"></div>
      
      <div class="dial-carousel-container" id="dialCarouselWrap">
        <button class="dial-nav-btn" onclick="rotateDials(-1)">‹</button>
        <div class="dial-carousel" id="dialCarousel">
          <!-- Dials injected by JS -->
        </div>
        <button class="dial-nav-btn" onclick="rotateDials(1)">›</button>
      </div>
    </div>

    <div class="dial-filters" id="dialFilters">
      <span class="dial-filter-opt active">All</span>
      <span class="dial-filter-opt">Light dial</span>
      <span class="dial-filter-opt">Coloured dial</span>
      <span class="dial-filter-opt">Dark dial</span>
      <span class="dial-filter-opt">Gem-set dial</span>
      <span class="dial-filter-opt">Diamond-paved dial</span>
    </div>

    <div class="thumbnails" id="thumbList">
      <div class="thumb active" data-step="0"><img src="assets/fylex-watch-v2/only-dial.png"></div>
      <div class="thumb" data-step="1"><img src="assets/fylex-watch-v2/left-side.png"></div>
      <div class="thumb" data-step="2"><img src="assets/fylex-watch-v2/right-side.png"></div>
    </div>

    <div class="controls-left">
      <div class="step-title" id="stepTitle">Choose your size</div>
      <div class="options-row" id="optionsRow">
        <span class="opt active">36 mm</span>
        <span class="opt">40 mm</span>
      </div>
    </div>

    <div class="next-step-wrap">
      <button class="btn-next" id="btnNext" onclick="nextStep()">Material <span style="font-size:18px;">›</span></button>
    </div>

    <div class="summary-bar">
      <div class="s-info">
        <div class="s-model" id="sumModel">Day-Date 40</div>
        <div class="s-specs" id="sumSpecs">Oyster, 40 mm, Everose gold</div>
        <div class="s-price" id="sumPrice">₹ 4,787,000 ⓘ</div>
      </div>
      <button class="s-add">+</button>
    </div>
  </section>

  <!-- ═══════════ PARALLAX STORY SECTION ═══════════ -->
  <section id="story">

    <div class="orb orb-1" id="orb1"></div>
    <div class="orb orb-2" id="orb2"></div>
    <div class="orb orb-3" id="orb3"></div>

    <div class="grid-lines"></div>

    <!-- ── Block 1 ── -->
    <div class="s-block" id="b1">
      <span class="chapter-num" data-speed="-0.15">01</span>
      <div class="s-text-wrap">
        <span class="accent-line"></span>
        <h2>The Art of <em>Perfecting</em> Time</h2>
        <p>Since its creation in 1956, the Day-Date has remained an unparalleled symbol of prestige. Designed as the ultimate instrument for visionaries and leaders, it was the first ever watch to display the date and the day of the week spelt out in full. The Oyster case—waterproof, extraordinarily robust and perfectly proportioned—safeguards a mechanical movement entirely developed and manufactured to the most exacting standards.</p>
      </div>
    </div>

    <div class="s-divider" id="d1"></div>

    <!-- ── Block 2 ── -->
    <div class="s-block" id="b2">
      <div class="w-layer">
        <img src="rim1.png" alt="Watch Rim" class="rim-img">
      </div>
      <span class="chapter-num" data-speed="-0.12">02</span>
      <div class="s-text-wrap">
        <span class="accent-line"></span>
        <h2>Unyielding <em>Elegance</em></h2>
        <p>Every element is conceived with the pursuit of perfection. The unmistakable fluted bezel, originally designed to screw the bezel onto the case to ensure waterproofness, evolved rapidly into a mark of aesthetic distinction. Today, it stands as a signature element of classic horology, its facets catching the light to create an enduring, brilliant glow that announces its origin without uttering a single word.</p>
      </div>
    </div>

    <div class="s-divider" id="d2"></div>

    <!-- ── Block 3 ── -->
    <div class="s-block" id="b3">
      <div class="w-layer">
        <img src="rim1.png" alt="Watch Rim" class="rim-img">
        <img src="dial1.png" alt="Watch Dial" class="dial-img" id="dialB3">
      </div>
      <span class="chapter-num" data-speed="-0.18">03</span>
      <div class="s-text-wrap">
        <span class="accent-line"></span>
        <h2>Crafted from <em>the Earth</em></h2>
        <p>By operating its own exclusive foundry, our manufacture casts the finest 18 ct gold alloys. Formulations are secretly guarded to yield the precise color and structural integrity demanded. The resulting yellow, white, and everose golds possess an unblemished radiance—resistant to fading over time, they carry the warmth of a life well lived and the promise of a legacy passed proudly to the next generation.</p>
      </div>
    </div>

    <div class="s-divider" id="d3"></div>

    <!-- ── Block 4 ── -->
    <div class="s-block" id="b4">
      <span class="chapter-num" data-speed="-0.1">04</span>
      <div class="s-text-wrap">
        <span class="accent-line"></span>
        <h2>The <em>President</em> Bracelet</h2>
        <p>Refinement extends beyond the dial. The President bracelet—characterized by its semi-circular three-piece links—was created specifically for the launch of the Day-Date. Consistently fashioned only in precious metals, it offers ultimate comfort and grace. The concealed Crownclasp perfectly integrates into the design, rendering the seamless band an unbroken link of continuous elegance wrapping the wrist.</p>
      </div>
    </div>

    <div class="s-divider" id="d4"></div>

    <!-- ── Block 5 ── -->
    <div class="s-block" id="b5">
      <span class="chapter-num" data-speed="-0.14">05</span>
      <div class="s-text-wrap">
        <span class="accent-line"></span>
        <h2>A Calibre of <em>Distinction</em></h2>
        <p>At the heart of this masterpiece beats an entirely new generation calibre. Insensitive to magnetic fields and highly resistant to shocks, it offers a power reserve of approximately 70 hours. Our stringent internal certification criteria demand an accuracy of -2/+2 seconds per day, twice that required of an official chronometer. It is mechanical supremacy, quietly tracking the seconds of history's greatest moments.</p>
      </div>
    </div>

    <div class="s-tracker" id="tracker">
      <div class="dot active" data-target="b1"></div>
      <div class="dot" data-target="b2"></div>
      <div class="dot" data-target="b3"></div>
      <div class="dot" data-target="b4"></div>
      <div class="dot" data-target="b5"></div>
    </div>

  </section>

  <script>
    gsap.registerPlugin(ScrollTrigger);

    /* ─────────────────────────────────────────────
       CONFIGURATOR STATE MACHINE
    ───────────────────────────────────────────── */
    const steps = [
      {
        id: 'size',
        title: 'Choose your size',
        options: [
          { name: '36 mm', img: 'assets/fylex-watch-v2/36mm.png' },
          { name: '40 mm', img: 'assets/fylex-watch-v2/40mm.png' }
        ],
        nextLbl: 'Material'
      },
      {
        id: 'material',
        title: 'Choose your material',
        options: [
          { name: 'Yellow Gold', img: 'assets/fylex-watch-v2/goldwatch.png' },
          { name: 'White Gold', img: 'assets/fylex-watch-v2/white-gold.png' },
          { name: 'Everose gold', img: 'assets/fylex-watch-v2/everose-gold.png' },
          { name: 'Premium', img: 'assets/fylex-watch-v2/premium.png' }
        ],
        nextLbl: 'Bezel'
      },
      {
        id: 'bezel',
        title: 'Choose your bezel',
        options: [
          { name: 'Fluted', img: 'assets/fylex-watch-v2/Flutted.png' },
          { name: 'Brilliant Diamond set', img: 'assets/fylex-watch-v2/brilliant-diamond-set.png' }
        ],
        nextLbl: 'Dial'
      },
      {
        id: 'dial',
        title: 'Choose your dial',
        options: [
          { name: 'Olive Green', img: 'assets/fylex-watch-v2/olive-green.png', dialImg: 'assets/fylex-watch-v2/Olive-green-dial.png' },
          { name: 'Chocolate', img: 'assets/fylex-watch-v2/chocolate.png', dialImg: 'assets/fylex-watch-v2/Chocolate-dial.png' },
          { name: 'Meteorite', img: 'assets/fylex-watch-v2/metorite.png', dialImg: 'assets/fylex-watch-v2/metoritedial.png' },
          { name: 'Diamond-paved', img: 'assets/fylex-watch-v2/diamond-paved.png', dialImg: 'assets/fylex-watch-v2/Diamondpavedial.png' }
        ],
        nextLbl: 'Discover'
      },
      {
        id: 'discover',
        title: 'Final Configuration',
        options: [
          { name: 'View Variations', img: 'assets/fylex-watch-v2/goldwatch.png' }
        ],
        nextLbl: 'Scroll'
      }
    ];

    let currentStep = 0;
    let parallaxInited = false;

    const els = {
      title: document.getElementById('stepTitle'),
      row: document.getElementById('optionsRow'),
      btn: document.getElementById('btnNext'),
      img: document.getElementById('previewImg'),
      thumbs: () => document.querySelectorAll('.thumb')
    };

    function renderStep(idx) {
      if (idx >= steps.length) return;
      const step = steps[idx];
      els.title.innerText = step.title;
      els.btn.innerHTML = `${step.nextLbl} <span style="font-size:18px;">›</span>`;

      const storySec = document.getElementById('story');
      const dialCarouselWrap = document.getElementById('dialCarouselWrap');
      const dialFilters = document.getElementById('dialFilters');

      if (idx === steps.length - 1) {
        els.btn.style.display = 'none';
        storySec.style.display = 'block';
        setTimeout(() => {
          ScrollTrigger.refresh();
          if (!parallaxInited) { initParallax(); parallaxInited = true; }
        }, 120);
      } else {
        els.btn.style.display = 'flex';
        storySec.style.display = 'none';
      }

      const thumbList = document.getElementById('thumbList');

      if (step.id === 'dial') {
        els.row.style.display = 'none';
        dialCarouselWrap.style.display = 'flex';
        dialFilters.style.display = 'flex';
        thumbList.style.display = 'none';
        
        if (!appliedDial) appliedDial = step.options[0].dialImg;
        
        renderDialCarousel();
      } else {
        els.row.style.display = 'flex';
        dialCarouselWrap.style.display = 'none';
        dialFilters.style.display = 'none';
        thumbList.style.display = 'flex';
      }

      els.row.innerHTML = step.options.map((opt, i) =>
        `<span class="opt ${i===0 ? 'active' : ''}" data-img="${opt.img}">${opt.name}</span>`
      ).join('');

      document.querySelectorAll('.opt').forEach(optEl => {
        optEl.addEventListener('click', (e) => {
          document.querySelectorAll('.opt').forEach(o => o.classList.remove('active'));
          e.target.classList.add('active');
          updatePreviewImage(e.target.getAttribute('data-img'));
          els.thumbs().forEach(t => t.classList.remove('active'));
        });
      });

      updatePreviewImage(step.options[0].img);
      
      els.thumbs().forEach((t, i) => {
        t.classList.toggle('active', i === idx);
      });
    }

    function updatePreviewImage(src) {
      if (!src) return;
      const currentSrc = els.img.getAttribute('src');
      if (currentSrc === src || els.img.src === src) return;
      
      gsap.to(els.img, { opacity: 0, duration: 0.2, onComplete: () => {
        els.img.src = src;
        gsap.to(els.img, { opacity: 1, duration: 0.3 });
      }});
    }

    function nextStep() {
      if (currentStep < steps.length - 1) {
        currentStep++;
        renderStep(currentStep);
      } else {
        window.scrollBy({ top: window.innerHeight, behavior: 'smooth' });
      }
    }

    /* ── DIAL CAROUSEL LOGIC ── */
    let dialIndex = 0;
    let appliedDial = null;

    function renderDialCarousel() {
      const carousel = document.getElementById('dialCarousel');
      const step = steps[currentStep];
      if (!step || step.id !== 'dial') return;

      carousel.innerHTML = '';
      
      const firstHalf = step.options.slice(0, 2);
      const secondHalf = step.options.slice(2);

      const createItem = (opt, idx) => {
        const item = document.createElement('div');
        item.className = 'dial-item';
        item.innerHTML = `<img src="${opt.dialImg}" alt="${opt.name}">`;
        item.onclick = () => selectDial(opt, item);
        return item;
      };

      firstHalf.forEach((opt, i) => carousel.appendChild(createItem(opt, i)));
      
      const spacer = document.createElement('div');
      spacer.className = 'dial-spacer';
      spacer.style.width = '20px'; 
      spacer.style.flexShrink = '0';
      carousel.appendChild(spacer);
      
      secondHalf.forEach((opt, i) => carousel.appendChild(createItem(opt, i+2)));
    }

    function selectDial(opt, itemEl) {
      const activeLayer = document.getElementById('activeDialLayer');
      const carousel = document.getElementById('dialCarousel');
      const prevAppliedDial = appliedDial;
      
      appliedDial = opt.dialImg;

      const rect = itemEl.getBoundingClientRect();
      const flyer = document.createElement('div');
      flyer.className = 'dial-item';
      flyer.style.position = 'fixed';
      flyer.style.top = rect.top + 'px';
      flyer.style.left = rect.left + 'px';
      flyer.innerHTML = `<img src="${opt.dialImg}">`;
      flyer.style.zIndex = 100;
      document.body.appendChild(flyer);

      itemEl.classList.add('hidden');

      if (prevAppliedDial) {
        const slots = document.querySelectorAll('.dial-item');
        let targetSlot = null;
        slots.forEach(slot => {
           if (slot.querySelector('img').src.includes(prevAppliedDial)) {
             targetSlot = slot;
           }
        });

        if (targetSlot) {
          targetSlot.classList.remove('hidden');
          const slotRect = targetSlot.getBoundingClientRect();
          targetSlot.classList.add('hidden');
          
          const returnFlyer = document.createElement('div');
          returnFlyer.className = 'dial-item';
          returnFlyer.style.position = 'fixed';
          returnFlyer.style.top = '50%';
          returnFlyer.style.left = '50%';
          returnFlyer.style.transform = 'translate(-50%, -50%)';
          returnFlyer.innerHTML = `<img src="${prevAppliedDial}">`;
          returnFlyer.style.zIndex = 50;
          document.body.appendChild(returnFlyer);

          gsap.to(returnFlyer, {
            top: slotRect.top,
            left: slotRect.left,
            transform: 'translate(0, 0)',
            width: slotRect.width,
            height: slotRect.height,
            opacity: 1,
            duration: 0.6,
            ease: "power2.inOut",
            onComplete: () => {
              targetSlot.classList.remove('hidden');
              document.body.removeChild(returnFlyer);
            }
          });
        }
      }

      const watchImg = document.getElementById('previewImg');
      const watchRect = watchImg.getBoundingClientRect();
      
      const targetX = watchRect.left + (watchRect.width / 2) - 110;
      const targetY = watchRect.top + (watchRect.height / 2) - 110;

      gsap.to(flyer, {
        top: targetY,
        left: targetX,
        width: 220,
        height: 220,
        duration: 0.6,
        ease: "power2.inOut",
        onComplete: () => {
          updatePreviewImage(opt.img);
          gsap.to(flyer, { opacity: 0, duration: 0.2, onComplete: () => document.body.removeChild(flyer) });
        }
      });
    }

    document.querySelectorAll('.dial-filter-opt').forEach(filter => {
      filter.addEventListener('click', () => {
        document.querySelectorAll('.dial-filter-opt').forEach(f => f.classList.remove('active'));
        filter.classList.add('active');
        renderDialCarousel();
      });
    });

    function rotateDials(dir) {
       const step = steps[currentStep];
       if (!step || step.id !== 'dial') return;
       
       if (dir > 0) {
         step.options.push(step.options.shift());
       } else {
         step.options.unshift(step.options.pop());
       }
       renderDialCarousel();
    }

    document.querySelectorAll('.thumb').forEach(thumb => {
      thumb.addEventListener('click', () => {
        const thumbImg = thumb.querySelector('img');
        if (thumbImg) {
          const src = thumbImg.getAttribute('src');
          updatePreviewImage(src);
          document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
          thumb.classList.add('active');
          document.querySelectorAll('.opt').forEach(o => o.classList.remove('active'));
        }
      });
    });

    /* ─────────────────────────────────────────────
       PARALLAX INIT
    ───────────────────────────────────────────── */
    function initParallax() {
      const blocks   = document.querySelectorAll('.s-block');
      const dividers = document.querySelectorAll('.s-divider');
      const dots     = document.querySelectorAll('.dot');
      const story    = document.getElementById('story');
      const configurator = document.getElementById('configurator');

      ScrollTrigger.create({
        trigger: configurator,
        pin: true,
        pinSpacing: false,
        start: "top top",
        end: () => "+=" + window.innerHeight,
        refreshPriority: 1
      });

      const bgColors = [
        '#5c4238',
        '#3d2b22',
        '#6b4c3b',
        '#2e2018',
        '#5c4238'
      ];

      blocks.forEach((block, i) => {
        const textWrap  = block.querySelector('.s-text-wrap');
        const heading   = block.querySelector('h2');
        const paragraph = block.querySelector('p');
        const accentLine= block.querySelector('.accent-line');
        const chapNum   = block.querySelector('.chapter-num');
        const speed     = parseFloat(chapNum?.dataset.speed || '-0.15');

        block.style.backgroundColor = bgColors[i];

        ScrollTrigger.create({
          trigger: block,
          pin: true,
          pinSpacing: false,
          start: "top top",
          end: "bottom top",
          onToggle: self => {
            if (self.isActive) updateDots(i);
          }
        });

        if (chapNum) {
          gsap.to(chapNum, {
            yPercent: speed * 250,
            ease: 'none',
            force3D: true,
            scrollTrigger: {
              trigger: block,
              start: 'top bottom',
              end: 'bottom top',
              scrub: 1.2,
              fastScrollEnd: true,
              preventOverlaps: true
            }
          });
        }

        gsap.from(accentLine, {
          scaleX: 0,
          duration: 0.8,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: block,
            start: 'top 72%',
            toggleActions: 'play none none reverse'
          }
        });

        gsap.from(heading, {
          y: 60,
          opacity: 0,
          duration: 1.1,
          ease: 'power4.out',
          scrollTrigger: {
            trigger: block,
            start: 'top 68%',
            toggleActions: 'play none none reverse'
          }
        });

        gsap.from(paragraph, {
          y: 40,
          opacity: 0,
          duration: 1,
          delay: 0.15,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: block,
            start: 'top 62%',
            toggleActions: 'play none none reverse'
          }
        });

        if (i === 2) {
          const dial = block.querySelector('#dialB3');
          gsap.fromTo(dial, {
            scale: 0.85,
            opacity: 0
          }, {
            scale: 1,
            opacity: 1,
            duration: 1.2,
            ease: 'power2.out',
            scrollTrigger: {
              trigger: block,
              start: 'top top',
              toggleActions: 'play none none reverse'
            }
          });
        }

        const xFrom = i % 2 === 0 ? -30 : 30;
        gsap.from(textWrap, {
          x: xFrom,
          duration: 1.2,
          ease: 'power3.out',
          force3D: true,
          scrollTrigger: {
            trigger: block,
            start: 'top 75%',
            toggleActions: 'play none none reverse',
            fastScrollEnd: true
          }
        });

      });

      dividers.forEach(div => {
        gsap.from(div, {
          scaleX: 0,
          opacity: 0,
          duration: 1.4,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: div,
            start: 'top 88%',
            toggleActions: 'play none none reverse'
          }
        });
      });

      gsap.to('#orb1', {
        y: -150,
        ease: 'none',
        force3D: true,
        scrollTrigger: { trigger: story, start: 'top bottom', end: 'bottom top', scrub: 1.5 }
      });
      gsap.to('#orb2', {
        y: 120,
        x: -40,
        ease: 'none',
        force3D: true,
        scrollTrigger: { trigger: story, start: 'top bottom', end: 'bottom top', scrub: 2 }
      });
      gsap.to('#orb3', {
        y: -90,
        x: 60,
        ease: 'none',
        force3D: true,
        scrollTrigger: { trigger: story, start: 'top bottom', end: 'bottom top', scrub: 1.8 }
      });

      dots.forEach(dot => {
        dot.addEventListener('click', () => {
          const target = document.getElementById(dot.getAttribute('data-target'));
          if (target) target.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
      });
    }

    function updateDots(activeIdx) {
      document.querySelectorAll('.dot').forEach((d, i) => {
        d.classList.toggle('active', i === activeIdx);
      });
    }

    renderStep(0);
  </script>
</body>
</html>