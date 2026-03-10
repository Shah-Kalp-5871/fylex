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

    /* Step Thumbnails Right */
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

    /* Left Controls */
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

    /* Bottom Next Button */
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

    /* Fixed Summary Bar */
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

  </style>
</head>
<body>

  <!-- HERO CONFIGURATOR -->
  <section id="configurator">
    <!-- Header -->
    <header class="c-header">
      <h1 class="c-title" id="watchTitle">Day-Date 40</h1>
    </header>
    <a href="configure.php" class="close-btn">×</a>

    <!-- Main Subject -->
    <div class="c-main">
      <img src="assets/img12.png" alt="Watch preview" class="watch-preview" id="previewImg">
    </div>

    <!-- Thumbnails Map -->
    <div class="thumbnails" id="thumbList">
      <div class="thumb active" data-step="0"><img src="assets/img12.png"></div>
      <div class="thumb" data-step="1"><img src="assets/img1.png"></div>
      <div class="thumb" data-step="2"><img src="assets/img3.png"></div>
      <div class="thumb" data-step="3"><img src="assets/004.png"></div>
      <div class="thumb" data-step="4"><img src="assets/img12.png"></div>
    </div>

    <!-- Controls area -->
    <div class="controls-left">
      <div class="step-title" id="stepTitle">Choose your size</div>
      <div class="options-row" id="optionsRow">
        <span class="opt active">36 mm</span>
        <span class="opt">40 mm</span>
      </div>
    </div>

    <!-- Action -->
    <div class="next-step-wrap">
      <button class="btn-next" id="btnNext" onclick="nextStep()">Material <span style="font-size:18px;">›</span></button>
    </div>

    <!-- Bottom Attached Bar -->
    <div class="summary-bar">
      <div class="s-info">
        <div class="s-model" id="sumModel">Day-Date 40</div>
        <div class="s-specs" id="sumSpecs">Oyster, 40 mm, Everose gold</div>
        <div class="s-price" id="sumPrice">₹ 4,787,000 ⓘ</div>
      </div>
      <button class="s-add">+</button>
    </div>
  </section>

  <!-- PARALLAX CONTENT SECTION -->
  <section id="story">
    
    <div class="s-container">
      <div class="s-content">
        
        <div class="s-para" id="p1">
          <h2>The Art of Perfecting Time</h2>
          <p>Since its creation in 1956, the Day-Date has remained an unparalleled symbol of prestige. Designed as the ultimate instrument for visionaries and leaders, it was the first ever watch to display the date and the day of the week spelt out in full in a window on the dial. The Oyster case—waterproof, extraordinarily robust and perfectly proportioned—safeguards a mechanical movement entirely developed and manufactured to the most exacting standards.</p>
        </div>

        <div class="s-para" id="p2">
          <h2>Unyielding Elegance</h2>
          <p>Every element is conceived with the pursuit of perfection. The unmistakable fluted bezel, originally designed to screw the bezel onto the case to ensure waterproofness, evolved rapidly into a mark of aesthetic distinction. Today, it stands as a signature element of classic horology, its facets catching the light to create an enduring, brilliant glow that announces its origin without uttering a single word.</p>
        </div>

        <div class="s-para" id="p3">
          <h2>Crafted from the Earth</h2>
          <p>By operating its own exclusive foundry, our manufacture casts the finest 18 ct gold alloys. Formulations are secretly guarded to yield the precise color and structural integrity demanded. The resulting yellow, white, and everose golds possess an unblemished radiance—resistant to fading over time, they carry the warmth of a life well lived and the promise of a legacy passed proudly to the next generation.</p>
        </div>

        <div class="s-para" id="p4">
          <h2>The President Bracelet</h2>
          <p>Refinement extends beyond the dial. The President bracelet—characterized by its semi-circular three-piece links—was created specifically for the launch of the Day-Date. Consistently fashioned only in precious metals, it offers ultimate comfort and grace. The concealed Crownclasp perfectly integrates into the design, rendering the seamless band an unbroken link of continuous elegance wrapping the wrist.</p>
        </div>

        <div class="s-para" id="p5">
          <h2>A Calibre of Distinction</h2>
          <p>At the heart of this masterpiece beats an entirely new generation calibre. Insensitive to magnetic fields and highly resistant to shocks, it offers a power reserve of approximately 70 hours. Our stringent internal certification criteria demand an accuracy of -2/+2 seconds per day, twice that required of an official chronometer. It is mechanical supremacy, quietly tracking the seconds of history's greatest moments.</p>
        </div>

      </div>

      <!-- Right Side Sticky Pagination for Story -->
      <div class="s-tracker">
        <div class="track-line"></div>
        <div class="dot active" data-target="p1"></div>
        <div class="dot" data-target="p2"></div>
        <div class="dot" data-target="p3"></div>
        <div class="dot" data-target="p4"></div>
        <div class="dot" data-target="p5"></div>
      </div>
    </div>
  </section>

  <style>
    /* Parallax Section CSS */
    #story {
      display: none; /* Hidden by default */
      background: var(--bg-brown);
      color: var(--text-white);
      position: relative;
      padding: 180px 0;
    }

    .s-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      position: relative;
    }

    .s-content {
      width: 70%;
      display: flex;
      flex-direction: column;
      gap: 300px; /* huge gaps to enable long scrolling */
      padding-bottom: 200px;
    }

    .s-para {
      /* Opacity and Transform will be handled by GSAP */
      will-change: transform, opacity;
    }

    .s-para h2 {
      font-family: 'Playfair Display', serif;
      font-size: 48px;
      margin-bottom: 28px;
      color: var(--accent);
    }

    .s-para p {
      font-size: 20px;
      line-height: 1.8;
      color: rgba(255, 255, 255, 0.7);
      font-weight: 300;
    }

    /* Fixed tracker on the right side */
    .s-tracker {
      position: sticky;
      top: 40vh;
      width: 40px;
      height: 250px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      z-index: 50;
      padding-right: 20px;
    }

    .track-line {
      display: none; /* Hide the vertical line */
    }

    .dot {
      width: 3px;
      height: 24px;
      background: rgba(255, 255, 255, 0.4);
      border: none;
      border-radius: 4px;
      position: relative;
      z-index: 1;
      transition: all 0.4s ease;
      transform-origin: center center;
    }

    .dot.active {
      transform: scaleY(1.8);
      background: #ffffff;
    }
  </style>

  <script>
    // State machine for configurator
    const steps = [
      {
        id: 'size',
        title: 'Choose your size',
        options: ['36 mm', '40 mm'],
        nextLbl: 'Material',
        preview: 'assets/img2.png'
      },
      {
        id: 'material',
        title: 'Choose your material',
        options: ['Yellow Gold', 'White Gold', 'Everose gold', 'Premium'],
        nextLbl: 'Bezel',
        preview: 'assets/img1.png'
      },
      {
        id: 'bezel',
        title: 'Choose your bezel',
        options: ['Fluted', 'Brilliant Diamond set'],
        nextLbl: 'Dial',
        preview: 'assets/img3.png'
      },
      {
        id: 'dial',
        title: 'Choose your dial',
        options: ['Olive Green', 'Chocolate', 'Meteorite', 'Diamond-paved'],
        nextLbl: 'Discover',
        preview: 'assets/004.png'
      },
      {
        id: 'discover',
        title: 'Final Configuration',
        options: ['View Variations'],
        nextLbl: 'Scroll',
        preview: 'assets/img2.png'
      }
    ];

    let currentStep = 0;

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
      
      // Update UI texts
      els.title.innerText = step.title;
      els.btn.innerHTML = `${step.nextLbl} <span style="font-size:18px;">›</span>`;

      // Hide next button, and Show story section, on the final step
      const storySec = document.getElementById('story');
      if (idx === steps.length - 1) {
        els.btn.style.display = 'none';
        storySec.style.display = 'block';
        // Refresh ScrollTrigger since layout changed from display:none to block
        setTimeout(() => ScrollTrigger.refresh(), 100);
      } else {
        els.btn.style.display = 'flex';
        storySec.style.display = 'none';
      }
      
      // Render options
      els.row.innerHTML = step.options.map((opt, i) => 
        `<span class="opt ${i===0 ? 'active' : ''}">${opt}</span>`
      ).join('');

      // Add click events to new options
      document.querySelectorAll('.opt').forEach(optEl => {
        optEl.addEventListener('click', (e) => {
          document.querySelectorAll('.opt').forEach(o => o.classList.remove('active'));
          e.target.classList.add('active');
        });
      });

      // Update image
      gsap.to(els.img, { opacity: 0, duration: 0.2, onComplete: () => {
        els.img.src = step.preview;
        gsap.to(els.img, { opacity: 1, duration: 0.3 });
      }});

      // Update Thumbs highlighting
      els.thumbs.forEach(t => t.classList.remove('active'));
      if(els.thumbs[idx]) els.thumbs[idx].classList.add('active');
    }

    function nextStep() {
      if (currentStep < steps.length - 1) {
        currentStep++;
        renderStep(currentStep);
      } else {
        // Scroll to content if the user clicks "Scroll" on the discover step
        window.scrollBy({ top: window.innerHeight, behavior: 'smooth' });
      }
    }

    // Attach click to thumbnails to jump steps
    els.thumbs.forEach(thumb => {
      thumb.addEventListener('click', () => {
        const stepIdx = parseInt(thumb.getAttribute('data-step'));
        currentStep = stepIdx;
        renderStep(stepIdx);
      });
    });

    // Story Parallax Reveal Logic using ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);
    
    const paras = document.querySelectorAll('.s-para');
    const dots = document.querySelectorAll('.dot');

    function updateDot(id) {
      dots.forEach(d => {
        d.classList.remove('active');
        if (d.getAttribute('data-target') === id) {
          d.classList.add('active');
        }
      });
    }

    paras.forEach((p, i) => {
      // Parallax text animation
      gsap.fromTo(p, 
        { y: 120, opacity: 0 },
        {
          y: -40,
          opacity: 1,
          ease: "none",
          scrollTrigger: {
            trigger: p,
            start: "top 85%",
            end: "bottom 35%",
            scrub: 1, // 1 second smoothing
            onEnter: () => updateDot(p.id),
            onEnterBack: () => updateDot(p.id)
          }
        }
      );
    });

  </script>
</body>
</html>
