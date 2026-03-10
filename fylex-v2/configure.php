<?php
// configure.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Configure — Fylex Master</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,500&family=Jost:wght@200;300;400;500&family=Cormorant:ital,wght@0,300;0,400;1,300;1,400&display=swap"
    rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

  <style>
    :root {
      --cream: #F5F0E8;
      --navy: #1C2535;
      --rust: #B85C38;
      --ts: #7A6A52;
      /* Slider background colors */
      --bg-blue: #E3EEF4;
      --bg-green: #E6EEE3;
      --bg-cream: #F5EFEB;
    }

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Jost', sans-serif;
      font-weight: 300;
      color: var(--navy);
      overflow-x: hidden;
      background: var(--bg-blue); /* Default */
      transition: background-color 0.8s ease;
    }

    /* Minimal Header */
    header {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      padding: 40px 64px;
      display: flex;
      justify-content: flex-start;
      gap: 40px;
      z-index: 500;
    }

    header a {
      font-family: 'Jost', sans-serif;
      font-size: 14px;
      font-weight: 500;
      color: var(--navy);
      text-decoration: none;
      opacity: 0.6;
      transition: opacity 0.3s;
    }

    header a:hover {
      opacity: 1;
    }

    header a.active {
      opacity: 1;
      font-weight: 600;
      position: relative;
    }

    header a.active::after {
      content: '•';
      position: absolute;
      right: -12px;
      top: 50%;
      transform: translateY(-50%);
    }

    /* Main Slider Container */
    #watch-slider {
      position: relative;
      height: 100vh;
      width: 100vw;
      overflow: hidden;
    }

    .slide {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      padding: 0 8vw;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.8s ease, visibility 0.8s ease;
    }

    .slide.active {
      opacity: 1;
      visibility: visible;
      z-index: 10;
    }

    /* Content Left Side */
    .slide-content {
      flex: 1;
      max-width: 450px;
      z-index: 2;
    }

    .slide-title {
      font-family: 'Playfair Display', serif;
      font-size: 4vw;
      font-weight: 500;
      color: var(--navy);
      margin-bottom: 20px;
      line-height: 1.1;
      opacity: 0;
      transform: translateY(20px);
    }

    .slide-subtitle {
      font-weight: 500;
      margin-bottom: 8px;
      font-size: 16px;
      opacity: 0;
      transform: translateY(20px);
    }

    .slide-desc {
      font-size: 15px;
      line-height: 1.6;
      color: var(--ts);
      margin-bottom: 40px;
      opacity: 0;
      transform: translateY(20px);
    }

    .btn-configure {
      display: inline-block;
      padding: 14px 36px;
      background: #fff;
      color: var(--navy);
      font-weight: 500;
      font-size: 14px;
      text-decoration: none;
      border-radius: 30px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      transition: transform 0.3s, box-shadow 0.3s;
      opacity: 0;
      transform: translateY(20px);
    }

    .btn-configure:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    /* Image Right Side */
    .slide-image-wrapper {
      flex: 1.2;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      position: relative;
    }

    .slide-image {
      max-width: 80%;
      height: auto;
      object-fit: contain;
      transform: translateX(100px);
      opacity: 0;
      will-change: transform, opacity;
      filter: drop-shadow(-20px 30px 40px rgba(0,0,0,0.15));
    }

    /* Navigation Controls */
    .nav-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 48px;
      height: 48px;
      background: rgba(255,255,255,0.6);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 20;
      border: none;
      backdrop-filter: blur(4px);
      transition: background 0.3s, transform 0.3s;
    }

    .nav-btn:hover {
      background: #fff;
      transform: translateY(-50%) scale(1.05);
    }

    .nav-prev { left: 40px; }
    .nav-next { right: 40px; }

    /* Pagination */
    .pagination {
      position: absolute;
      bottom: 24px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 16px;
      z-index: 20;
    }

    .pag-line {
      width: 40px;
      height: 3px;
      background: rgba(28, 37, 53, 0.2);
      border-radius: 2px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .pag-line.active {
      background: var(--navy);
    }

    /* ─── FOOTER (Copied exactly from index.php) ─── */
    .footer-premium {
      background: var(--navy);
      color: var(--cream);
      padding: 100px 64px 40px;
      position: relative;
      z-index: 100;
    }

    .f-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 60px;
      max-width: 1400px;
      margin: 0 auto 80px;
    }

    .flogo {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      letter-spacing: .15em;
    }

    .flogo span { color: var(--rust); }

    .f-col h4 {
      font-size: 12px;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--stone);
      margin-bottom: 24px;
      font-weight: 400;
    }

    .f-links { list-style: none; }
    .f-links li { margin-bottom: 16px; }

    .f-links a {
      color: rgba(245,240,232,.6);
      text-decoration: none;
      font-size: 14px;
      transition: color .3s;
    }

    .f-links a:hover { color: var(--rust); }

    .f-bottom {
      max-width: 1400px;
      margin: 0 auto;
      padding-top: 40px;
      border-top: 1px solid rgba(245,240,232,.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      color: rgba(245,240,232,.4);
      letter-spacing: .05em;
    }

    .f-socials span { transition: color .3s; cursor: pointer; }
    .f-socials span:hover { color: var(--cream); }

    @media (max-width: 900px) {
      .slide {
        flex-direction: column;
        padding: 100px 5vw 0;
        text-align: center;
      }
      .slide-image-wrapper {
        justify-content: center;
        align-items: flex-start;
      }
      .slide-image {
        max-width: 90%;
        transform: translateX(0) scale(0.9);
      }
      .f-grid {
        grid-template-columns: 1fr 1fr;
      }
    }
    @media (max-width: 600px) {
      .f-grid {
        grid-template-columns: 1fr;
      }
      .f-bottom {
        flex-direction: column;
        gap: 20px;
        text-align: center;
      }
    }
  </style>
</head>

<body>

  <header>
    <a href="index.php">Home</a>
    <!-- <a href="#" class="active">All</a> -->
    <!-- <a href="#">Classic</a>
    <a href="#">Professional</a> -->
  </header>

  <main id="watch-slider">
    <!-- Slide 1: Nautilus -->
    <div class="slide active" data-bg="#E3EEF4">
      <div class="slide-content">
        <h1 class="slide-title">Nautilus</h1>
        <div class="slide-subtitle">The epitome of sports elegance</div>
        <p class="slide-desc">With the rounded octagonal shape of its bezel, the ingenious porthole construction of its case, and its horizontally embossed dial, the Nautilus has epitomized the elegant sports watch since 1976.</p>
        <a href="customize.php" class="btn-configure">Configure</a>
      </div>
      <div class="slide-image-wrapper">
        <img src="assets/004.png" alt="Patek Philippe Nautilus" class="slide-image" />
      </div>
    </div>

    <!-- Slide 2: Aquanaut -->
    <div class="slide" data-bg="#E6EEE3">
      <div class="slide-content">
        <h1 class="slide-title">Aquanaut</h1>
        <div class="slide-subtitle">Modern, dynamic, and spirited</div>
        <p class="slide-desc">Launched in 1997, the Aquanaut created a sensation. It was young, modern and unexpected. Its case was a rounded octagon, inspired by that of the Nautilus.</p>
        <a href="customize.php" class="btn-configure">Configure</a>
      </div>
      <div class="slide-image-wrapper">
        <img src="assets/img3.png" alt="Patek Philippe Aquanaut" class="slide-image" />
      </div>
    </div>

    <!-- Slide 3: Calatrava -->
    <div class="slide" data-bg="#F5EFEB">
      <div class="slide-content">
        <h1 class="slide-title">Calatrava</h1>
        <div class="slide-subtitle">The essence of the round wristwatch</div>
        <p class="slide-desc">With its pure lines, the Calatrava is recognized as the very essence of the round wristwatch and one of the finest symbols of the Patek Philippe style.</p>
        <a href="customize.php" class="btn-configure">Configure</a>
      </div>
      <div class="slide-image-wrapper">
        <img src="assets/img2.png" alt="Patek Philippe Calatrava" class="slide-image" />
      </div>
    </div>

    <!-- Controls -->
    <button class="nav-btn nav-prev">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M15 18l-6-6 6-6" />
      </svg>
    </button>
    <button class="nav-btn nav-next">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 18l6-6-6-6" />
      </svg>
    </button>

    <!-- Pagination -->
    <div class="pagination">
      <div class="pag-line active" data-index="0"></div>
      <div class="pag-line" data-index="1"></div>
      <div class="pag-line" data-index="2"></div>
    </div>
  </main>

  <footer class="footer-premium">
    <div class="f-grid">
      <div class="f-col">
        <div class="flogo" style="margin-bottom: 20px;">FY<span>·</span>LEX</div>
        <p style="font-size: 14px; opacity: 0.6; line-height: 1.6; max-width: 280px;">Excellence in horology and nautical engineering. Crafted in Geneva for the global adventurer.</p>
      </div>
      <div class="f-col">
        <h4>Heritage</h4>
        <ul class="f-links">
          <li><a href="#">Our Story</a></li>
          <li><a href="#">Geneva Atelier</a></li>
          <li><a href="#">Chronometry</a></li>
          <li><a href="#">Sustainability</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h4>Discover</h4>
        <ul class="f-links">
          <li><a href="#">All Collections</a></li>
          <li><a href="#">Master Series</a></li>
          <li><a href="#">Customization</a></li>
          <li><a href="#">Boutiques</a></li>
        </ul>
      </div>
      <div class="f-col">
        <h4>Legal</h4>
        <ul class="f-links">
          <li><a href="#">Terms of Use</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Warranty</a></li>
          <li><a href="#">Cookies</a></li>
        </ul>
      </div>
    </div>
    <div class="f-bottom">
      <p>© 2025 Fylex Horlogerie SA. All Rights Reserved.</p>
      <div class="f-socials">
        <span>GENEVA</span>
        <span style="margin-left: 20px;">MASTER WATCH</span>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const slides = document.querySelectorAll('.slide');
      const prevBtn = document.querySelector('.nav-prev');
      const nextBtn = document.querySelector('.nav-next');
      const pagLines = document.querySelectorAll('.pag-line');
      let currentIndex = 0;
      let isAnimating = false;

      // Initial Animation for first slide
      animateSlideIn(slides[0], 1);

      function goToSlide(index, direction) {
        if (isAnimating || index === currentIndex) return;
        isAnimating = true;

        const currentSlide = slides[currentIndex];
        const nextSlide = slides[index];
        
        // Update background color
        document.body.style.backgroundColor = nextSlide.getAttribute('data-bg');

        // Update pagination
        pagLines.forEach(l => l.classList.remove('active'));
        pagLines[index].classList.add('active');

        // Animate out current slide
        gsap.to(currentSlide.querySelectorAll('.slide-title, .slide-subtitle, .slide-desc, .btn-configure'), {
          y: -20,
          opacity: 0,
          duration: 0.4,
          stagger: 0.05,
          ease: "power2.in"
        });
        
        gsap.to(currentSlide.querySelector('.slide-image'), {
          x: direction === 1 ? -100 : 100,
          opacity: 0,
          duration: 0.6,
          ease: "power2.in",
          onComplete: () => {
            currentSlide.classList.remove('active');
            nextSlide.classList.add('active');
            animateSlideIn(nextSlide, direction);
          }
        });

        currentIndex = index;
      }

      function animateSlideIn(slide, direction) {
        // Reset positions
        gsap.set(slide.querySelectorAll('.slide-title, .slide-subtitle, .slide-desc, .btn-configure'), {
          y: 20,
          opacity: 0
        });
        
        gsap.set(slide.querySelector('.slide-image'), {
          x: direction === 1 ? 100 : -100,
          opacity: 0
        });

        // Animate in
        gsap.to(slide.querySelectorAll('.slide-title, .slide-subtitle, .slide-desc, .btn-configure'), {
          y: 0,
          opacity: 1,
          duration: 0.6,
          stagger: 0.1,
          ease: "power3.out",
          delay: 0.1
        });

        gsap.to(slide.querySelector('.slide-image'), {
          x: 0,
          opacity: 1,
          duration: 0.8,
          ease: "power3.out",
          onComplete: () => {
            isAnimating = false;
          }
        });
      }

      nextBtn.addEventListener('click', () => {
        let next = (currentIndex + 1) % slides.length;
        goToSlide(next, 1);
      });

      prevBtn.addEventListener('click', () => {
        let prev = (currentIndex - 1 + slides.length) % slides.length;
        goToSlide(prev, -1);
      });

      pagLines.forEach(line => {
        line.addEventListener('click', () => {
          let index = parseInt(line.getAttribute('data-index'));
          if (index > currentIndex) {
            goToSlide(index, 1);
          } else if (index < currentIndex) {
            goToSlide(index, -1);
          }
        });
      });
    });
  </script>
</body>
</html>
