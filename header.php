<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<style>
  :root {
    --gold: #c9a96e;
    --gold-light: #e8d5b0;
    --gold-dim: rgba(201,169,110,0.35);
    --cream: #f5f0e8;
    --dark: #0d0d0d;
    --header-h: 70px;
  }

  *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

  html, body {
    overflow-x: hidden;
    max-width: 100vw;
  }

  /* ─── HAMBURGER & MOBILE NAV ─── */
  .hamburger {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    width: 40px; height: 40px;
    cursor: pointer;
    border: none; background: none;
    padding: 6px;
    z-index: 1100;
    position: relative;
  }
  .hamburger span {
    display: block;
    width: 100%; height: 1px;
    background: var(--gold);
    transition: transform 0.4s cubic-bezier(0.23,1,0.32,1), opacity 0.3s;
    transform-origin: center;
  }
  .hamburger.open span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
  .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
  .hamburger.open span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }

  /* ── BACKDROP ── */
  .mobile-menu-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 1040;
    background: rgba(0,0,0,0.45);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s ease;
  }
  .mobile-menu-backdrop.open {
    opacity: 1;
    pointer-events: all;
  }

  .mobile-menu {
    display: none;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    width: clamp(260px, 60vw, 420px);
    z-index: 1050;
    background: rgba(8,6,3,0.96);
    border-left: 1px solid var(--gold-dim);
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    gap: 0;
    padding: 0 0 40px 0;
    opacity: 0;
    pointer-events: none;
    transform: translateX(100%);
    transition: opacity 0.4s ease, transform 0.4s cubic-bezier(0.23,1,0.32,1);
  }
  .mobile-menu.open {
    opacity: 1;
    pointer-events: all;
    transform: translateX(0);
  }
  .mobile-menu a {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(1.6rem, 6vw, 2.4rem);
    font-weight: 300;
    letter-spacing: 0.12em;
    color: var(--cream);
    text-decoration: none;
    text-transform: uppercase;
    padding: 18px 40px;
    border-bottom: 1px solid rgba(201,169,110,0.12);
    width: 100%;
    text-align: left;
    transition: color 0.3s, background 0.3s, padding-left 0.3s;
  }
  .mobile-menu a:first-child { border-top: 1px solid rgba(201,169,110,0.12); }
  .mobile-menu a:hover { color: var(--gold); background: rgba(201,169,110,0.05); padding-left: 52px; }
  .mobile-menu .mobile-cta {
    margin-top: 36px;
    margin-left: 40px;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.22em;
    color: var(--dark);
    background: var(--gold);
    padding: 14px 36px;
    transition: background 0.3s;
    border: none;
    width: auto;
  }
  .mobile-menu .mobile-cta:hover { background: var(--gold-light); color: var(--dark); }

  /* ── HEADER ── */
  header {
    position: fixed; top:0; left:0; width:100%; height: var(--header-h);
    z-index:1000;
    display:flex; align-items:center; justify-content:space-between;
    padding: 0 clamp(20px, 5vw, 56px);
    border-bottom:1px solid var(--gold-dim);
    background: rgba(0, 0, 0, 0.5);
    transition: background .4s, backdrop-filter .4s, border-color .4s;
  }
  header.scrolled { 
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter:blur(14px); 
    border-bottom-color:rgba(201,169,110,.6); 
  }

  .logo {
    font-family:'Cormorant Garamond',serif;
    font-size: clamp(1.3rem, 4vw, 1.7rem);
    font-weight:300; letter-spacing:.25em;
    color:var(--gold); text-transform:uppercase; text-decoration:none;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .logo img {
    height: 32px;
    width: auto;
  }

  header nav { display:flex; gap: clamp(16px, 3vw, 40px); }
  header nav a {
    font-size:.68rem; font-weight:500; letter-spacing:.2em;
    text-transform:uppercase; color:var(--gold-light);
    text-decoration:none; position:relative; padding-bottom:4px;
    transition:color .3s; white-space: nowrap;
  }
  header nav a::after {
    content:''; position:absolute; bottom:0; left:0;
    width:0; height:1px; background:var(--gold); transition:width .35s;
  }
  header nav a:hover { color:var(--gold); }
  header nav a:hover::after { width:100%; }

  header .cta {
    font-size:.65rem; font-weight:600; letter-spacing:.22em;
    text-transform:uppercase; color:var(--dark); background:var(--gold);
    padding:11px 26px; text-decoration:none; transition:background .3s;
    white-space: nowrap;
  }
  header .cta:hover { background:var(--gold-light); }

  @media (max-width: 900px) {
    header nav, header .cta { display: none !important; }
    .hamburger { display: flex !important; }
    .mobile-menu { display: flex; }
    .mobile-menu-backdrop { display: block; }
  }

  body.menu-open { overflow: hidden; }
</style>

<!-- Mobile menu backdrop -->
<div class="mobile-menu-backdrop" id="menuBackdrop" onclick="closeMenu()"></div>

<!-- Mobile slide-in menu -->
<div class="mobile-menu" id="mobileMenu">
  <a href="index.php" onclick="closeMenu()">Collection</a>
  <a href="configure.php" onclick="closeMenu()">Configure</a>
  <a href="#" onclick="closeMenu()">Atelier</a>
  <a href="#" onclick="closeMenu()">Contact</a>
  <a href="#" class="mobile-cta" onclick="closeMenu()">Reserve</a>
</div>

<header id="hdr">
  <a href="index.php" class="logo">
    <img src="../Fylex_V1/fylex_logo.png" alt="Fylex Logo">
    Fylex
  </a>
  <nav>
    <a href="index.php">Collection</a>
    <a href="configure.php">Configure</a>
    <a href="#">Atelier</a>
    <a href="#">Contact</a>
  </nav>
  <a href="#" class="cta">Reserve</a>
  <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
    <span></span>
    <span></span>
    <span></span>
  </button>
</header>

<script>
  /* ── HAMBURGER & MOBILE MENU ── */
  const hamburger     = document.getElementById('hamburger');
  const mobileMenu    = document.getElementById('mobileMenu');
  const menuBackdrop  = document.getElementById('menuBackdrop');

  function openMenu() {
    hamburger.classList.add('open');
    hamburger.setAttribute('aria-expanded', 'true');
    mobileMenu.style.display = 'flex';
    menuBackdrop.style.display = 'block';
    mobileMenu.getBoundingClientRect(); // trigger reflow
    menuBackdrop.getBoundingClientRect();
    mobileMenu.classList.add('open');
    menuBackdrop.classList.add('open');
    document.body.classList.add('menu-open');
  }

  function closeMenu() {
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    mobileMenu.classList.remove('open');
    menuBackdrop.classList.remove('open');
    document.body.classList.remove('menu-open');
  }

  hamburger.addEventListener('click', () => {
    hamburger.classList.contains('open') ? closeMenu() : openMenu();
  });

  /* ── HEADER SCROLL ── */
  const hdr = document.getElementById('hdr');
  window.addEventListener('scroll', () => {
    hdr.classList.toggle('scrolled', window.scrollY > 60);
  }, { passive: true });

  /* ── KEYBOARD ── */
  document.addEventListener('keydown', e => { 
    if (e.key === 'Escape') closeMenu(); 
  });
</script>
