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
      z-index: 5; /* Base layer */
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

    /* ── Floating ambient orbs ── */
    .orb {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      will-change: transform;
      filter: blur(80px);
      opacity: 0.18;
    }
    .orb-1 { width: 600px; height: 600px; background: #E8A87A; top: -100px; left: -200px; }
    .orb-2 { width: 500px; height: 500px; background: #b08060; top: 40%; right: -150px; }
    .orb-3 { width: 400px; height: 400px; background: #c8956a; bottom: 200px; left: 20%; }

    /* ── Horizontal rule grid ── */
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

    /* ── Big decorative chapter numbers ── */
    .chapter-num {
      position: absolute;
      left: -0.05em;
      top: -0.3em;
      font-family: 'Playfair Display', serif;
      font-size: clamp(160px, 18vw, 260px);
      font-weight: 700;
      line-height: 1;
      color: transparent;
      -webkit-text-stroke: 1px rgba(232,168,122,0.12);
      pointer-events: none;
      will-change: transform;
      user-select: none;
    }

    /* ── Thin decorative accent line ── */
    .accent-line {
      display: block;
      width: 60px;
      height: 2px;
      background: var(--accent);
      margin-bottom: 28px;
      transform-origin: left center;
    }

    /* ── Individual story block ── */
    .s-block {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: center;
      padding: 0 60px 0 clamp(60px, 10vw, 160px);
      overflow: hidden;
      background: var(--bg-brown); /* Default background */
    }

    /* Assign z-index to blocks for stacking */
    #b1 { z-index: 10; }
    #b2 { z-index: 20; }
    #b3 { z-index: 30; }
    #b4 { z-index: 40; }
    #b5 { z-index: 50; }

    /* Alternating: even blocks shift content right */
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

    /* Decorative side image strip */
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

    /* Glowing separator between blocks */
    .s-divider {
      height: 1px;
      /* background: linear-gradient(90deg, transparent 0%, rgba(232,168,122,0.35) 50%, transparent 100%); */
      margin: 0;
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 60;
      background: rgba(255,255,255,0.05);
    }

    /* ── ROLEX PARALLAX COMPONENTS ── */
    .w-layer {
      position: absolute;
      top: 50%;
      right: clamp(40px, 8vw, 120px);
      transform: translateY(-50%);
      width: clamp(330px, 42vw, 620px);
      height: clamp(330px, 42vw, 620px);
      pointer-events: none;
      z-index: 1; /* Relative to its block */
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

    /* ── Tracker dots ── */
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

    /* ── Scroll hint arrow ── */
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
    }

    @keyframes bounceDown {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50%  { transform: translateX(-50%) translateY(8px); }
    }

    .scroll-hint svg { opacity: 0.7; }

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
    </div>

    <div class="thumbnails" id="thumbList">
      <div class="thumb active" data-step="0"><img src="assets/fylex-watch-v2/40mm.png"></div>
      <div class="thumb" data-step="1"><img src="assets/fylex-watch-v2/gold watch.png"></div>
      <div class="thumb" data-step="2"><img src="assets/fylex-watch-v2/Fluted.png"></div>
      <div class="thumb" data-step="3"><img src="assets/fylex-watch-v2/olive-green.png"></div>
      <div class="thumb" data-step="4"><img src="assets/fylex-watch-v2/gold watch.png"></div>
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

    <!-- Ambient background orbs -->
    <div class="orb orb-1" id="orb1"></div>
    <div class="orb orb-2" id="orb2"></div>
    <div class="orb orb-3" id="orb3"></div>

    <!-- Grid lines overlay -->
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

      <!-- Scroll hint inside last block -->
      <div class="scroll-hint">
        <span>Scroll</span>
        <svg width="16" height="20" viewBox="0 0 16 20" fill="none">
          <path d="M8 0v16M1 9l7 7 7-7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>

    <!-- Fixed tracker -->
    <div class="s-tracker" id="tracker">
      <div class="dot active" data-target="b1"></div>
      <div class="dot" data-target="b2"></div>
      <div class="dot" data-target="b3"></div>
      <div class="dot" data-target="b4"></div>
      <div class="dot" data-target="b5"></div>
    </div>

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
          { name: 'Yellow Gold', img: 'assets/fylex-watch-v2/gold watch.png' },
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
          { name: 'Fluted', img: 'assets/fylex-watch-v2/Fluted.png' },
          { name: 'Brilliant Diamond set', img: 'assets/fylex-watch-v2/Brilliant-diamondset.png' }
        ],
        nextLbl: 'Dial'
      },
      {
        id: 'dial',
        title: 'Choose your dial',
        options: [
          { name: 'Olive Green', img: 'assets/fylex-watch-v2/olive-green.png' },
          { name: 'Chocolate', img: 'assets/fylex-watch-v2/chocolate.png' },
          { name: 'Meteorite', img: 'assets/fylex-watch-v2/metorite.png' },
          { name: 'Diamond-paved', img: 'assets/fylex-watch-v2/Diamond-paved.png' }
        ],
        nextLbl: 'Discover'
      },
      {
        id: 'discover',
        title: 'Final Configuration',
        options: [
          { name: 'View Variations', img: 'assets/fylex-watch-v2/gold watch.png' }
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
      thumbs: document.querySelectorAll('.thumb')
    };

    function renderStep(idx) {
      if (idx >= steps.length) return;
      const step = steps[idx];
      els.title.innerText = step.title;
      els.btn.innerHTML = `${step.nextLbl} <span style="font-size:18px;">›</span>`;

      const storySec = document.getElementById('story');
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

      els.row.innerHTML = step.options.map((opt, i) =>
        `<span class="opt ${i===0 ? 'active' : ''}" data-img="${opt.img}">${opt.name}</span>`
      ).join('');

      document.querySelectorAll('.opt').forEach(optEl => {
        optEl.addEventListener('click', (e) => {
          document.querySelectorAll('.opt').forEach(o => o.classList.remove('active'));
          e.target.classList.add('active');
          updatePreviewImage(e.target.getAttribute('data-img'));
        });
      });

      updatePreviewImage(step.options[0].img);

      els.thumbs.forEach(t => t.classList.remove('active'));
      if (els.thumbs[idx]) els.thumbs[idx].classList.add('active');
    }

    function updatePreviewImage(src) {
      if (els.img.src.includes(src)) return;
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

    els.thumbs.forEach(thumb => {
      thumb.addEventListener('click', () => {
        currentStep = parseInt(thumb.getAttribute('data-step'));
        renderStep(currentStep);
      });
    });

    /* ─────────────────────────────────────────────
       PARALLAX INIT (called once story is revealed)
    ───────────────────────────────────────────── */
    function initParallax() {
      const blocks   = document.querySelectorAll('.s-block');
      const dividers = document.querySelectorAll('.s-divider');
      const dots     = document.querySelectorAll('.dot');
      const story    = document.getElementById('story');
      const configurator = document.getElementById('configurator');

      /* ── 0. Pin the configurator to let story overlap ── */
      ScrollTrigger.create({
        trigger: configurator,
        pin: true,
        pinSpacing: false,
        start: "top top",
        end: () => "+=" + window.innerHeight, // Stays pinned until b1 covers it
        refreshPriority: 1
      });

      /* ── 1. Per-block animations ── */
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

        // Apply bg color directly to block for layering
        block.style.backgroundColor = bgColors[i];

        /* ── Pin the block ── */
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

        /* ── Chapter number deep parallax ── */
        if (chapNum) {
          gsap.to(chapNum, {
            yPercent: speed * 300,
            ease: 'none',
            scrollTrigger: {
              trigger: block,
              start: 'top bottom',
              end: 'bottom top',
              scrub: true
            }
          });
        }

        /* ── Accent line draw-in ── */
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

        /* ── Heading: clip + rise reveal ── */
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

        /* ── Paragraph: staggered word-group rise ── */
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

        /* ── Dial Reveal for Section 3 ── */
        if (i === 2) { // Section 3 (b3)
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
              start: 'top top', // Start reveal exactly when section 3 starts overlapping
              toggleActions: 'play none none reverse'
            }
          });
        }

        /* ── Subtle text-wrap horizontal drift (alternating direction) ── */
        const xFrom = i % 2 === 0 ? -30 : 30;
        gsap.from(textWrap, {
          x: xFrom,
          duration: 1.2,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: block,
            start: 'top 75%',
            toggleActions: 'play none none reverse'
          }
        });

      });

      /* ── 3. Dividers: scale-in from centre ── */
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

      /* ── 4. Ambient orbs parallax (very slow drift) ── */
      gsap.to('#orb1', {
        y: -200,
        ease: 'none',
        scrollTrigger: { trigger: story, start: 'top bottom', end: 'bottom top', scrub: 2 }
      });
      gsap.to('#orb2', {
        y: 180,
        x: -60,
        ease: 'none',
        scrollTrigger: { trigger: story, start: 'top bottom', end: 'bottom top', scrub: 3 }
      });
      gsap.to('#orb3', {
        y: -120,
        x: 80,
        ease: 'none',
        scrollTrigger: { trigger: story, start: 'top bottom', end: 'bottom top', scrub: 2.5 }
      });

      /* ── 5. Dot tracker click navigation ── */
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