<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FYLEX — Master Watch</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,500&family=Jost:wght@200;300;400;500&family=Cormorant:ital,wght@0,300;0,400;1,300;1,400&display=swap"
    rel="stylesheet" />
  <link rel="preconnect" href="https://www.youtube.com" />
  <link rel="preconnect" href="https://s.ytimg.com" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Observer.min.js"></script>
  <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>

  <style>
    :root {
      --cream: #F5F0E8;
      --cream-2: #EDE6D6;
      --cream-3: #E4D9C4;
      --stone: #C8BAA2;
      --warm: #A8987E;
      --tan: #7A6A52;
      --brown: #4A3C2A;
      --navy: #1C2535;
      --navy-2: #243040;
      --navy-3: #2E3C52;
      --rust: #B85C38;
      --rust-2: #D4704A;
      --td: #1A1410;
      --tm: #4A3C2A;
      --ts: #7A6A52;
      --tp: #A8987E;
    }

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html { scroll-behavior: auto; }

    body {
      background: var(--cream);
      color: var(--td);
      font-family: 'Jost', sans-serif;
      font-weight: 300;
      overflow-x: hidden;
    }

    ::-webkit-scrollbar { width: 3px; }
    ::-webkit-scrollbar-track { background: var(--cream-2); }
    ::-webkit-scrollbar-thumb { background: var(--rust); }

    /* ═══ NAV ═══ */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 301;
      padding: 32px 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all .5s;
    }

    nav.sticky {
      background: rgba(245, 240, 232, .93);
      backdrop-filter: blur(16px);
      padding: 20px 64px;
      border-bottom: 1px solid rgba(168, 152, 126, .18);
      box-shadow: 0 2px 40px rgba(74, 60, 42, .07);
    }

    nav.menu-open {
      background: transparent !important;
      backdrop-filter: none !important;
      border-bottom: none !important;
      box-shadow: none !important;
    }

    .nlogo {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      letter-spacing: .12em;
      font-weight: 400;
      color: var(--navy);
      text-decoration: none;
    }

    .nlogo span { color: var(--rust); }

    .nlinks {
      display: flex;
      gap: 44px;
      list-style: none;
    }

    .nlinks a {
      font-size: 12px;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--ts);
      text-decoration: none;
      font-weight: 400;
      transition: color .3s;
    }

    .nlinks a:hover { color: var(--rust); }

    .nbtn {
      font-size: 12px;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--cream);
      background: var(--navy);
      padding: 11px 28px;
      text-decoration: none;
      transition: background .3s;
      font-weight: 400;
    }

    .nbtn:hover { background: var(--navy-3); }

    /* Hamburger */
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 4px;
      z-index: 300;
    }

    .hamburger span {
      display: block;
      width: 24px;
      height: 2px;
      background: var(--navy);
      transition: all .3s;
    }

    nav.sticky .hamburger span { background: var(--navy); }

    .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .hamburger.open span:nth-child(2) { opacity: 0; }
    .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* Mobile Menu Overlay */
    .mobile-menu {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(245, 240, 232, .98);
      backdrop-filter: blur(20px);
      z-index: 250;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 36px;
      opacity: 0;
      pointer-events: none;
      transition: opacity .4s;
    }

    .mobile-menu.open {
      opacity: 1;
      pointer-events: all;
    }

    .mobile-menu a {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      color: var(--navy);
      text-decoration: none;
      letter-spacing: .05em;
      transition: color .3s;
    }

    .mobile-menu a:hover { color: var(--rust); }

    .mobile-menu .mnbtn {
      font-family: 'Jost', sans-serif;
      font-size: 12px;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--cream);
      background: var(--navy);
      padding: 14px 40px;
      margin-top: 12px;
    }

    /* ═══ COMMONS ═══ */
    .lbl {
      font-size: 11px;
      letter-spacing: .38em;
      text-transform: uppercase;
      color: var(--rust);
      font-weight: 400;
      margin-bottom: 14px;
    }

    .hd {
      font-family: 'Playfair Display', serif;
      font-size: clamp(36px, 5.5vw, 82px);
      font-weight: 400;
      line-height: 1.08;
      color: var(--navy);
    }

    .hd em {
      font-style: italic;
      color: var(--rust);
    }

    .bt {
      font-size: 15px;
      line-height: 1.85;
      color: var(--ts);
      max-width: 500px;
      font-weight: 300;
    }

    .rule {
      width: 44px;
      height: 2px;
      background: var(--rust);
      margin-bottom: 28px;
    }

    /* REVEALS */
    .r0 { opacity: 0; transform: translateY(28px); }
    .rl { opacity: 0; transform: translateX(-28px); }
    .rr { opacity: 0; transform: translateX(28px); }

    /* BTNS */
    .bf {
      font-size: 12px;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--cream);
      background: var(--navy);
      padding: 15px 40px;
      text-decoration: none;
      font-family: 'Jost', sans-serif;
      font-weight: 400;
      transition: background .3s, transform .3s;
      display: inline-block;
    }

    .bf:hover { background: var(--navy-3); transform: translateY(-2px); }

    .bg2 {
      font-size: 12px;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--navy);
      border: 1.5px solid rgba(28, 37, 53, .3);
      padding: 15px 40px;
      text-decoration: none;
      font-family: 'Jost', sans-serif;
      font-weight: 400;
      transition: border-color .3s, transform .3s;
      display: inline-block;
    }

    .bg2:hover { border-color: var(--navy); transform: translateY(-2px); }

    /* ═══ 1. HERO ═══ */
    #hero {
      height: 100vh;
      min-height: 500px;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      background: #000;
    }

    .yt-bg-wrap {
      position: absolute;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
    }

    .hvideo {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100vw;
      height: 56.25vw;
      min-height: 100vh;
      min-width: 177.77vh;
      transform: translate(-50%, -50%);
      opacity: .65;
      border: none;
      pointer-events: none;
    }

    .hov {
      position: absolute;
      inset: 0;
      background: linear-gradient(100deg, rgba(0,0,0,.4) 0%, rgba(0,0,0,.2) 40%, transparent 100%);
    }

    .hcon {
      position: relative;
      z-index: 2;
      padding: 0 64px;
      max-width: 700px;
    }

    .hey {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 28px;
      opacity: 0;
      transform: translateY(16px);
    }

    .heyline { width: 36px; height: 1.5px; background: var(--rust); }

    .hey span {
      font-size: 11px;
      letter-spacing: .4em;
      text-transform: uppercase;
      color: var(--rust);
      font-weight: 400;
    }

    .htitle {
      font-family: 'Playfair Display', serif;
      font-size: clamp(48px, 8vw, 108px);
      font-weight: 400;
      line-height: .96;
      color: #fff;
      margin-bottom: 12px;
      opacity: 0;
      transform: translateY(30px);
    }

    .htitle em { font-style: italic; color: var(--rust); }

    .hsub {
      font-family: 'Cormorant', serif;
      font-size: clamp(16px, 2vw, 24px);
      font-weight: 300;
      font-style: italic;
      color: rgba(255,255,255,.7);
      margin-bottom: 44px;
      opacity: 0;
      transform: translateY(20px);
    }

    .hact { display: flex; gap: 16px; opacity: 0; transform: translateY(20px); }

    .hscroll {
      position: absolute;
      bottom: 44px;
      left: 64px;
      display: flex;
      align-items: center;
      gap: 14px;
      opacity: 0;
      animation: fadein 1s 2.4s forwards;
    }

    .hscroll span {
      font-size: 10px;
      letter-spacing: .35em;
      text-transform: uppercase;
      color: var(--tp);
    }

    .stk {
      width: 1px;
      height: 44px;
      background: linear-gradient(to bottom, var(--rust), transparent);
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse { 0%,100%{opacity:.4} 50%{opacity:1} }
    @keyframes fadein { to{opacity:1} }

    .hbadge {
      position: absolute;
      right: 64px;
      bottom: 64px;
      width: 116px;
      height: 116px;
      border-radius: 50%;
      background: var(--navy);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 4px;
      z-index: 2;
      opacity: 0;
      animation: spin 22s linear infinite, fadein .8s 2.5s forwards;
    }

    @keyframes spin { to{transform:rotate(360deg)} }

    .hbadge span { animation: spin 22s linear infinite reverse; }
    .hbm { font-family: 'Playfair Display', serif; font-size: 11px; letter-spacing: .15em; color: var(--cream); }
    .hbs { font-size: 9px; letter-spacing: .3em; color: var(--stone); }

    /* VIDEO OVERLAYS */
    .video-overlay {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      z-index: 10;
      color: var(--cream);
      padding: 0 24px;
    }

    .video-overlay h1, .video-overlay h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(28px, 5vw, 72px);
      line-height: 1.1;
      margin-bottom: 24px;
      text-shadow: 0 4px 12px rgba(0,0,0,0.5);
    }

    .video-overlay p {
      max-width: 600px;
      font-size: clamp(13px, 1.2vw, 18px);
      line-height: 1.6;
      opacity: 0.9;
      text-shadow: 0 2px 8px rgba(0,0,0,0.5);
    }

    /* ═══ 2. ROTATION ═══ */
    #rot {
      height: 100vh;
      background: var(--cream-2);
      position: relative;
    }

    .rst {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .rbg {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, var(--cream-2), var(--cream-3));
    }

    .rblur {
      position: absolute;
      inset: -10%;
      background: url('https://images.unsplash.com/photo-1622434641406-a158123450f9?w=1400&q=55') center/cover no-repeat;
      opacity: .05;
      filter: blur(14px);
    }

    .watch-showcase {
      width: 100%;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 3;
    }

    #mainWatch {
      height: 75vh;
      max-width: 90vw;
      object-fit: contain;
      filter: drop-shadow(0 30px 60px rgba(28, 37, 53, 0.25));
      transform: translateY(100vh);
      opacity: 0.5;
      will-change: transform, opacity;
    }

    .rtxt {
      position: absolute;
      left: 64px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 4;
    }

    .rdeg {
      font-family: 'Playfair Display', serif;
      font-size: 96px;
      font-weight: 400;
      line-height: 1;
      color: rgba(28, 37, 53, .06);
      letter-spacing: -.02em;
      position: absolute;
      right: 48px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 4;
      pointer-events: none;
    }

    .rprog { display: none; }

    .rpag {
      position: absolute;
      bottom: 100px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 12px;
      z-index: 10;
    }

    .rdot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      border: 1.5px solid var(--rust);
      cursor: pointer;
      transition: all .3s;
    }

    .rdot.active { background: var(--rust); }

    /* ═══ 3. DIAL ═══ */
    #dial {
      background: var(--navy);
      padding: 140px 64px;
      overflow: hidden;
    }

    .dwrap {
      max-width: 1280px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 100px;
      align-items: center;
    }

    .dimg-col { position: relative; }

    .dimgf {
      position: relative;
      filter: drop-shadow(0 40px 100px rgba(0,0,0,.5));
    }

    .dimgf::after {
      content: '';
      position: absolute;
      inset: 20px;
      border: 1px solid rgba(245,240,232,.08);
      pointer-events: none;
    }

    .dimgf img {
      width: 100%;
      aspect-ratio: 1;
      object-fit: cover;
      display: block;
    }

    .dcap {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 28px 28px 32px;
      background: linear-gradient(to top, rgba(28,37,53,.9), transparent);
    }

    .dcap span {
      font-size: 11px;
      letter-spacing: .3em;
      text-transform: uppercase;
      color: rgba(245,240,232,.45);
    }

    .dtxt .hd { color: var(--cream); }
    .dtxt .hd em { color: #E8A87A; }
    .dtxt .bt { color: rgba(245,240,232,.52); max-width: 460px; }
    .dtxt .lbl { color: #E8A87A; }
    .dtxt .rule { background: #E8A87A; }

    .dspecs {
      margin-top: 52px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      border-top: 1px solid rgba(245,240,232,.08);
    }

    .dspec {
      padding: 24px 0 24px 24px;
      border-right: 1px solid rgba(245,240,232,.08);
      border-bottom: 1px solid rgba(245,240,232,.08);
    }

    .dspec:nth-child(even) { border-right: none; }
    .dspec:nth-last-child(-n+2) { border-bottom: none; }

    .dsv {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      font-weight: 400;
      color: var(--cream);
      margin-bottom: 4px;
    }

    .dsl {
      font-size: 11px;
      letter-spacing: .25em;
      text-transform: uppercase;
      color: rgba(245,240,232,.32);
    }

    /* ═══ 4. MATERIALS ═══ */
    #mat {
      background: var(--cream);
      padding: 140px 64px;
    }

    .mhdr {
      max-width: 560px;
      margin: 0 auto 80px;
      text-align: center;
    }

    .mhdr .rule { margin: 0 auto 28px; }

    .mgrid {
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr;
      gap: 3px;
      max-width: 1280px;
      margin: 0 auto;
    }

    .mc {
      position: relative;
      overflow: hidden;
    }

    .mc:first-child { grid-row: span 2; }

    .mc img {
      width: 100%;
      height: 100%;
      min-height: 300px;
      object-fit: cover;
      display: block;
      transition: transform .9s cubic-bezier(.25,.46,.45,.94);
    }

    .mc:hover img { transform: scale(1.05); }

    .mov2 {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(28,37,53,.82) 0%, rgba(28,37,53,.1) 50%, transparent 100%);
      transition: opacity .4s;
    }

    .mc:hover .mov2 { opacity: .88; }

    .mi {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 32px 28px;
    }

    .mn {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      font-weight: 400;
      color: var(--cream);
      margin-bottom: 6px;
    }

    .md { font-size: 13px; color: rgba(245,240,232,.6); line-height: 1.6; }

    .mt {
      display: inline-block;
      margin-top: 12px;
      font-size: 9px;
      letter-spacing: .35em;
      text-transform: uppercase;
      color: var(--rust-2);
      border: 1px solid rgba(212,112,74,.45);
      padding: 4px 12px;
    }

    .mc:first-child .mn { font-size: 30px; }

    /* ═══ 5. CRAFT ═══ */
    #craft {
      background: var(--cream-2);
      padding: 140px 64px;
    }

    .cwrap {
      max-width: 1280px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 100px;
      align-items: center;
    }

    .cimgs { position: relative; }

    .cimgm {
      width: 88%;
      aspect-ratio: 3/4;
      object-fit: cover;
      display: block;
      box-shadow: 0 40px 100px rgba(74,60,42,.2);
    }

    .cimga {
      position: absolute;
      right: 0;
      bottom: -44px;
      width: 52%;
      aspect-ratio: 1;
      object-fit: cover;
      border: 6px solid var(--cream-2);
      box-shadow: 0 20px 60px rgba(74,60,42,.2);
    }

    .clist {
      margin-top: 44px;
      display: flex;
      flex-direction: column;
      gap: 28px;
    }

    .ci {
      display: flex;
      gap: 20px;
      align-items: flex-start;
      padding-bottom: 28px;
      border-bottom: 1px solid rgba(168,152,126,.2);
    }

    .ci:last-child { border-bottom: none; padding-bottom: 0; }

    .cnum {
      font-family: 'Playfair Display', serif;
      font-size: 13px;
      color: var(--rust);
      flex-shrink: 0;
      padding-top: 2px;
    }

    .ci h4 {
      font-family: 'Jost', sans-serif;
      font-size: 14px;
      font-weight: 500;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--navy);
      margin-bottom: 7px;
    }

    .ci p { font-size: 13px; line-height: 1.75; color: var(--ts); }

    /* ═══ 6. MOVEMENT ═══ */
    #mv {
      background: var(--navy-2);
      padding: 140px 64px;
      position: relative;
      overflow: hidden;
    }

    .mvbg {
      position: absolute;
      inset: 0;
      background: url('https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?w=1400&q=55') center/cover no-repeat;
      opacity: .06;
    }

    .mvhdr {
      text-align: center;
      margin-bottom: 90px;
      position: relative;
      z-index: 2;
    }

    .mvhdr .hd { color: var(--cream); }
    .mvhdr .hd em { color: #E8A87A; }
    .mvhdr .lbl { color: #E8A87A; display: flex; justify-content: center; }
    .mvhdr .rule { background: #E8A87A; margin: 0 auto 28px; }
    .mvhdr .bt { color: rgba(245,240,232,.48); margin: 0 auto; text-align: center; }

    .mvgrid {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 2px;
      position: relative;
      z-index: 2;
    }

    .mvcard {
      background: rgba(245,240,232,.04);
      border: 1px solid rgba(245,240,232,.07);
      padding: 44px 36px;
      transition: background .4s, border-color .4s;
    }

    .mvcard:hover {
      background: rgba(245,240,232,.08);
      border-color: rgba(232,168,122,.2);
    }

    .mvico { margin-bottom: 24px; }

    .mvico svg {
      width: 40px;
      height: 40px;
      stroke: rgba(232,168,122,.7);
      fill: none;
      stroke-width: 1.2;
    }

    .mvval {
      font-family: 'Playfair Display', serif;
      font-size: 42px;
      font-weight: 400;
      color: var(--cream);
      line-height: 1;
      margin-bottom: 6px;
    }

    .mvval sup { font-size: 16px; vertical-align: super; color: rgba(245,240,232,.5); }

    .mvkey {
      font-size: 10px;
      letter-spacing: .3em;
      text-transform: uppercase;
      color: rgba(232,168,122,.7);
      margin-bottom: 12px;
    }

    .mvdsc { font-size: 13px; line-height: 1.7; color: rgba(245,240,232,.38); }

    .mvphotos {
      max-width: 1200px;
      margin: 56px auto 0;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 3px;
      position: relative;
      z-index: 2;
    }

    .mvp {
      aspect-ratio: 3/4;
      overflow: hidden;
      position: relative;
    }

    .mvp img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform .8s cubic-bezier(.25,.46,.45,.94);
      filter: brightness(.68) saturate(.55);
    }

    .mvp:hover img { transform: scale(1.06); filter: brightness(.84) saturate(.78); }

    .mvpl {
      position: absolute;
      bottom: 16px;
      left: 16px;
      font-size: 10px;
      letter-spacing: .3em;
      text-transform: uppercase;
      color: rgba(245,240,232,.48);
    }

    /* ═══ 7. VARIANTS ═══ */
    #vr {
      background: var(--cream);
      padding: 140px 64px;
    }

    .vrhdr { text-align: center; margin-bottom: 70px; }
    .vrhdr .rule { margin: 0 auto 28px; }

    .vrgrid {
      max-width: 1280px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
    }

    .vc, .vc.feat {
      position: relative;
      cursor: pointer;
      background: #EDE6D6 !important;
      transition: transform .4s cubic-bezier(.25,.46,.45,.94), box-shadow .4s;
    }
    .vc:hover { transform: translateY(-10px); box-shadow: 0 40px 80px rgba(74,60,42,.15); }

    .vcimg {
      width: 100%;
      aspect-ratio: 4/3;
      overflow: hidden;
      position: relative;
    }

    .vcimg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform .7s ease;
    }

    .vc:hover .vcimg img { transform: scale(1.06); }

    .vbdg {
      position: absolute;
      top: 16px;
      right: 16px;
      font-size: 9px;
      letter-spacing: .3em;
      text-transform: uppercase;
      color: var(--cream);
      background: var(--rust);
      padding: 5px 12px;
      z-index: 3;
    }

    .vbody { padding: 32px 28px 36px; background: transparent !important; }

    .vname {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      font-weight: 400;
      color: var(--navy) !important;
      margin-bottom: 6px;
    }
    .vsub {
      font-size: 12px;
      color: var(--ts) !important;
      letter-spacing: .04em;
      margin-bottom: 24px;
    }
    .vprice {
      font-family: 'Playfair Display', serif;
      font-size: 30px;
      font-weight: 400;
      color: var(--rust) !important;
      margin-bottom: 24px;
    }

    .vbtn {
      display: block;
      width: 100%;
      padding: 13px;
      text-align: center;
      font-size: 11px;
      letter-spacing: .25em;
      text-transform: uppercase;
      font-family: 'Jost', sans-serif;
      font-weight: 400;
      background: transparent;
      border: 1.5px solid rgba(28,37,53,.2);
      color: var(--navy);
      cursor: pointer;
      transition: all .3s;
    }

    .vc:hover .vbtn { background: var(--navy); color: var(--cream); border-color: var(--navy); }
    .vc.feat .vbtn { border-color: rgba(28,37,53,.2); color: var(--navy); }
    .vc.feat:hover .vbtn { background: var(--navy); color: var(--cream); }

    /* ═══ 8. CTA ═══ */
    #cta {
      position: relative;
      overflow: hidden;
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .ctaph {
      position: absolute;
      inset: 0;
      background: url('https://images.unsplash.com/photo-1587836374828-4dbafa94cf0e?w=1800&q=82') center/cover no-repeat;
    }

    .ctaov {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(28,37,53,.9) 0%, rgba(28,37,53,.72) 100%);
    }

    .ctacon {
      position: relative;
      z-index: 2;
      text-align: center;
      padding: 80px 40px;
      max-width: 780px;
      width: 100%;
    }

    .ctacon .lbl { color: rgba(232,168,122,.8); display: flex; justify-content: center; }
    .ctacon .rule { background: rgba(232,168,122,.8); margin: 0 auto 28px; }

    .ctatitle {
      font-family: 'Playfair Display', serif;
      font-size: clamp(40px, 6.5vw, 90px);
      font-weight: 400;
      line-height: 1.05;
      color: var(--cream);
      margin-bottom: 18px;
    }

    .ctatitle em { font-style: italic; color: #E8A87A; }

    .ctasub {
      font-size: 15px;
      color: rgba(245,240,232,.52);
      margin-bottom: 52px;
    }

    .ctaacts {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .ctafine {
      margin-top: 36px;
      font-size: 12px;
      color: rgba(245,240,232,.28);
      letter-spacing: .05em;
    }

    /* ═══ FOOTER ═══ */
    .footer-premium {
      background: #0F172A;
      padding: 100px 8% 40px;
      color: var(--cream);
      margin-bottom: 0;
    }

    .f-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 60px;
      margin-bottom: 80px;
    }

    .f-col h4 {
      font-family: 'Playfair Display', serif;
      font-size: 18px;
      margin-bottom: 30px;
      letter-spacing: 0.1em;
      color: #E8A87A;
    }

    .f-links { list-style: none; }
    .f-links li { margin-bottom: 15px; }

    .f-links a {
      color: rgba(245,240,232,0.6);
      text-decoration: none;
      font-size: 13px;
      transition: color 0.3s;
      letter-spacing: 0.05em;
    }

    .f-links a:hover { color: #E8A87A; }

    .f-bottom {
      border-top: 1px solid rgba(245,240,232,0.1);
      padding-top: 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      color: rgba(245,240,232,0.4);
    }

    .flogo {
      font-family: 'Playfair Display', serif;
      font-size: 21px;
      letter-spacing: .1em;
      color: var(--cream);
    }

    .flogo span { color: #E8A87A; }

    /* ═══ FEATURE BLOCKS ═══ */
    .fxt-feature-block {
      margin: 0;
      max-width: 100%;
      width: 100%;
      padding: 160px 8%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .fxt-feature-block.theme-blue {
      background: linear-gradient(180deg, #DBEAFE 0%, #F5F0E8 100%);
    }

    .fxt-feature-block.theme-warm {
      background: linear-gradient(180deg, #EDE6D6 0%, #F5F0E8 100%);
      border-top: 1px solid rgba(168,152,126,0.1);
    }

    .fxt-feature-block.theme-cool {
      background: linear-gradient(180deg, #243040 0%, #1C2535 100%);
      color: var(--cream);
    }

    .fxt-feature-block.theme-cool .hd { color: var(--cream); }
    .fxt-feature-block.theme-cool .bt { color: rgba(245,240,232,0.52); }

    .fxt-feature-block.theme-sea {
      background: #9bcced;
      max-width: 100%;
      margin: 0 auto;
      padding: 100px 64px 160px;
    }

    .fxt-feature-block.theme-sea .lbl {
      color: #9B4418;
      letter-spacing: 0.35em;
      font-weight: 500;
      font-size: 13px;
    }

    .fxt-feature-block.theme-sea .rule { background: #9B4418; width: 40px; height: 2px; }

    .fxt-feature-block.theme-sea .hd {
      color: #0F172A;
      font-size: clamp(48px, 8vw, 110px);
      line-height: 0.9;
      margin-top: 40px;
      letter-spacing: -0.02em;
    }

    .fxt-feature-block.theme-sea .hd em {
      display: block;
      color: #9B4418;
      font-size: clamp(60px, 10vw, 140px);
      font-family: serif;
      font-style: italic;
      margin-top: 10px;
    }

    .fxt-feature-block.theme-sea .bt {
      color: #1E293B;
      font-size: clamp(15px, 1.5vw, 22px);
      line-height: 1.6;
      max-width: 900px;
      margin: 40px auto 0;
      opacity: 0.8;
      font-weight: 300;
    }

    .fxt-feature-block.fxt-vertical-feature {
      display: flex;
      flex-direction: column;
      text-align: center;
      gap: 60px;
    }

    .fxt-feature-block.fxt-vertical-feature .fxt-feature-img { max-width: 800px; margin: 0 auto; }
    .fxt-feature-block.fxt-vertical-feature .rule { margin: 20px auto; }

    .fxt-feature-block img {
      width: 100%;
      height: auto;
      filter: drop-shadow(0 40px 80px rgba(28,37,53,0.15));
      transition: transform .8s cubic-bezier(.25,.46,.45,.94);
    }

    .fxt-feature-block:hover img { transform: translateY(-15px) scale(1.02); }
    .fxt-feature-con { position: relative; z-index: 2; }

    /* WATCH SEQUENCE */
    #watch-sequence {
      position: relative;
      height: 300vh;
      background: #FFF;
    }

    .watch-sticky {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      background: #FFF;
    }

    #watch-canvas {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* ════════════════════════════════
       RESPONSIVE BREAKPOINTS
    ════════════════════════════════ */

    /* ── Tablet (≤1024px) ── */
    @media (max-width: 1024px) {
      nav { padding: 28px 40px; }
      nav.sticky { padding: 18px 40px; }

      .nlinks { gap: 28px; }

      #dial { padding: 100px 40px; }
      .dwrap { gap: 60px; }

      #mat { padding: 100px 40px; }

      #craft { padding: 100px 40px; }
      .cwrap { gap: 60px; }

      #mv { padding: 100px 40px; }
      .mvgrid { grid-template-columns: 1fr 1fr; gap: 2px; }

      #vr { padding: 100px 40px; }

      .fxt-feature-block { padding: 100px 6%; gap: 60px; }

      .f-grid { grid-template-columns: 1fr 1fr; gap: 40px; }
    }

    /* ── Mobile (≤768px) ── */
    @media (max-width: 768px) {
      /* NAV */
      nav { padding: 20px 24px; }
      nav.sticky { padding: 16px 24px; }

      .nlinks, .nbtn { display: none; }
      .hamburger { display: flex; }
      .mobile-menu { display: flex; }

      /* HERO */
      .hcon { padding: 0 24px; max-width: 100%; }
      .hbadge { display: none; }
      .hscroll { left: 24px; bottom: 28px; }

      /* ROTATION */
      #rot { height: 95vh; }
      .rst { height: 95vh; }
      .watch-showcase { height: 75vh; }
      #mainWatch { height: 48vh; }
      .rtxt { 
        display: block; 
        position: absolute;
        top: 64px;
        left: 28px;
        transform: none;
        z-index: 5;
      }
      .rdeg { display: none; }
      .rpag { bottom: 44px; }

      /* DIAL */
      #dial { padding: 70px 24px; }
      .dwrap { grid-template-columns: 1fr; gap: 44px; }
      .dimgf::after { inset: 10px; }
      .dspecs { margin-top: 36px; border-top: 1px solid rgba(245,240,232,.1); }
      .dsv { font-size: 28px; letter-spacing: -0.01em; }
      .dspec { padding: 20px 0 20px 0; border-right: 1px solid rgba(245,240,232,.08); }
      .dspec:nth-child(even) { border-right: none; padding-left: 15px; }

      /* MATERIALS */
      #mat { padding: 70px 24px; }
      .mgrid { grid-template-columns: 1fr; gap: 3px; }
      .mc:first-child { grid-row: span 1; }
      .mc img { min-height: 260px; }
      .mhdr { margin-bottom: 48px; }

      /* CRAFT */
      #craft { padding: 70px 24px; }
      .cwrap { grid-template-columns: 1fr; gap: 44px; }
      .cimgs { padding-bottom: 44px; }
      .cimgm { width: 100%; }
      .cimga { width: 48%; bottom: 0; }

      /* MOVEMENT */
      #mv { padding: 70px 24px; }
      .mvgrid { grid-template-columns: 1fr; gap: 2px; }
      .mvcard { padding: 32px 24px; }
      .mvphotos { grid-template-columns: 1fr 1fr; gap: 3px; margin-top: 40px; }
      .mvval { font-size: 34px; }

      /* VARIANTS */
      #vr { padding: 70px 24px; }
      .vrgrid { grid-template-columns: 1fr; gap: 20px; }
      .vrhdr { margin-bottom: 48px; }

      /* CTA */
      .ctacon { padding: 60px 24px; }
      .ctasub { font-size: 14px; margin-bottom: 36px; }
      .ctaacts { flex-direction: column; align-items: center; gap: 16px; }
      .ctafine { font-size: 11px; }

      /* FEATURE BLOCKS */
      .fxt-feature-block {
        grid-template-columns: 1fr;
        padding: 60px 24px;
        gap: 40px;
      }

      .fxt-feature-block.theme-sea {
        padding: 60px 24px 80px;
      }

      /* VIDEO SECTIONS */
      #dial-video { height: 70vh; }
      #heritage-2-video { height: 60vh; }
      #watch-sequence { height: 180vh; }

      /* FOOTER */
      .footer-premium { padding: 60px 24px 32px; }
      .f-grid {
        grid-template-columns: 1fr;
        gap: 36px;
        margin-bottom: 48px;
      }
      .f-bottom {
        flex-direction: column;
        gap: 16px;
        text-align: center;
        padding-top: 24px;
      }
    }

    /* ── Small Mobile (≤480px) ── */
    @media (max-width: 480px) {
      nav { padding: 18px 20px; }
      nav.sticky { padding: 14px 20px; }

      .nlogo { font-size: 19px; }

      /* HERO */
      .video-overlay h1, .video-overlay h2 { font-size: clamp(24px, 7vw, 40px); }
      .video-overlay p { font-size: 13px; }

      /* DIAL */
      #dial { padding: 56px 20px; }
      .dspecs { grid-template-columns: 1fr 1fr; }
      .dsv { font-size: 22px; }

      /* MOVEMENT */
      #mv { padding: 56px 20px; }
      .mvphotos { grid-template-columns: 1fr 1fr; }

      /* VARIANTS */
      #vr { padding: 56px 20px; }
      .vbody { padding: 24px 20px 28px; }
      .vprice { font-size: 26px; }

      /* FEATURE BLOCKS */
      .fxt-feature-block { padding: 48px 20px; gap: 32px; }

      /* FOOTER */
      .footer-premium { padding: 48px 20px 28px; }
      .f-col h4 { font-size: 16px; margin-bottom: 20px; }
    }

    /* ── Landscape Mobile ── */
    @media (max-width: 768px) and (orientation: landscape) {
      #hero { min-height: 100vw; }
      #rot { height: auto; min-height: 100vw; }
      .rst { height: auto; min-height: 100vw; }
      .watch-showcase { height: 80vw; }
      #mainWatch { height: 70vw; }
      .video-overlay h1, .video-overlay h2 { font-size: clamp(22px, 5vw, 36px); }
    }
  </style>
</head>

<body>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu" id="mobileMenu">
    <a href="#" onclick="closeMobileMenu()">Heritage</a>
    <!-- <a href="#" onclick="closeMobileMenu()">Collection</a> -->
    <a href="configure.php" onclick="closeMobileMenu()">Configure</a>
    <!-- <a href="#" onclick="closeMobileMenu()">Boutiques</a>
    <a href="#" onclick="closeMobileMenu()">Journal</a> -->
    <!-- <a href="#cta" class="mnbtn" onclick="closeMobileMenu()">Acquire</a> -->
  </div>

  <nav id="nav">
    <a class="nlogo" href="#">FY<span></span>LEX</a>
    <ul class="nlinks">
      <li><a href="configure.php">Configure</a></li>
    </ul>
    <!-- <a class="nbtn" href="#cta">Acquire</a> -->
    <div class="hamburger" id="hamburger" onclick="toggleMobileMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <!-- 1. HERO -->
  <section id="hero">
    <div class="yt-bg-wrap">
      <video class="hvideo" src="Watch_Iframe_1.mp4" autoplay loop muted playsinline></video>
    </div>
    <div class="video-overlay">
      <h1 class="r-hero">The Master of <br><em>Nautical Precision</em></h1>
      <p class="r-hero">Discover the heritage of the seas, <br>where every second is a journey <br>crafted for those who command <br>the infinite horizon.</p>
    </div>
  </section>

  <!-- WATCH SEQUENCE SECTION -->
  <section id="watch-sequence">
    <div class="watch-sticky">
      <canvas id="watch-canvas"></canvas>
    </div>
  </section>

  <!-- 2. 360 ROTATION -->
  <section id="rot">
    <div class="rst">
      <div class="rbg"></div>
      <div class="rblur"></div>
      <div class="rtxt r0">
        <div class="lbl"></div>
        <div class="rule"></div>
        <h2 class="hd" style="font-size:clamp(28px,2.8vw,44px);max-width:200px;line-height:1.15;">Our Best<br /><em>Watches</em></h2>
      </div>
      <div class="watch-showcase">
        <img id="mainWatch" src="assets/001.png" alt="Fylex Watch" />
      </div>
      <div class="rpag" id="rpag">
        <div class="rdot active" data-index="0"></div>
        <div class="rdot" data-index="1"></div>
        <div class="rdot" data-index="2"></div>
      </div>
    </div>
  </section>

  <!-- DIAL VIDEO -->
  <section id="dial-video" style="height: 120vh; position: relative; overflow: hidden; background: #000;">
    <div class="yt-bg-wrap">
      <video class="hvideo" src="Watch-iframe-2.mp4" autoplay loop muted playsinline></video>
    </div>
    <div class="hov" style="background: rgba(0,0,0,0.3)"></div>
    <div class="video-overlay">
      <h2 class="r-dial">Deep Sea <br><em>Chronometry</em></h2>
      <p class="r-dial">Engineered for the abyss, <br>where pressure defines excellence. <br>A tribute to the pioneers <br>of underwater exploration <br>since the golden age.</p>
    </div>
  </section>

  <!-- 3. DIAL FEATURES -->
  <section id="dial">
    <div class="dwrap">
      <div class="dimg-col rl">
        <div class="dimgf">
          <img src="https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?w=900&q=85" alt="Fylex Dial" loading="lazy" />
          <div class="dcap"><span>Fylex Master · Ref. FX-3200</span></div>
        </div>
      </div>
      <div class="dtxt">
        <div class="lbl r0">Precision Dial</div>
        <div class="rule r0"></div>
        <h2 class="hd r0">Crafted for<br /><em>eternity</em></h2>
        <p class="bt r0" style="margin-top:22px;color:rgba(245,240,232,.52);">Every element of the Fylex Master dial is
          obsessively hand-finished in La Chaux-de-Fonds. Applied luminescent indices, guilloché sunburst texture and
          meteorite-inspired lacquer create a timepiece commanding presence.</p>
        <div class="dspecs r0">
          <div class="dspec">
            <div class="dsv">±1<span style="font-size:16px;opacity:.45">s</span></div>
            <div class="dsl">Daily Accuracy</div>
          </div>
          <div class="dspec">
            <div class="dsv">72<span style="font-size:16px;opacity:.45">h</span></div>
            <div class="dsl">Power Reserve</div>
          </div>
          <div class="dspec">
            <div class="dsv">31</div>
            <div class="dsl">Jewels</div>
          </div>
          <div class="dspec">
            <div class="dsv">300<span style="font-size:16px;opacity:.45">m</span></div>
            <div class="dsl">Water Resistance</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. CRAFTSMANSHIP -->
  <section id="heritage-1">
    <div class="fxt-feature-block theme-warm r0">
      <div class="fxt-feature-img rl">
        <img src="https://media.gq-magazine.co.uk/photos/606d98dde64c72d60de68443/16:9/w_1920,c_limit/Daytona-lead.jpg"
          alt="Sailing Heritage" loading="lazy" />
      </div>
      <div class="fxt-feature-con rr">
        <div class="lbl">Maritime Precision</div>
        <div class="rule"></div>
        <h2 class="hd">A Legacy of<br /><em>the Sea</em></h2>
        <p class="bt" style="margin-top:22px;">At Fylex, we celebrate timepieces that combine precision engineering with
          timeless nautical inspiration. Watches designed for life at sea have long been trusted tools for navigators
          who rely on accuracy to stay on course in unpredictable conditions. Featuring rotatable bezels and
          high-precision movements, these exceptional timepieces allow sailors to calculate and track navigational time
          with confidence. Today, their elegant design and functional craftsmanship make them just as impressive on land
          as they are on open water.</p>
      </div>
    </div>
  </section>

  <section id="heritage-2-video" style="height: 120vh; position: relative; overflow: hidden; background: #000;">
    <div class="yt-bg-wrap">
      <video class="hvideo" src="Watch-iframe-3.mp4" autoplay loop muted playsinline></video>
    </div>
    <div class="hov" style="background: rgba(0,0,0,0.3)"></div>
    <div class="video-overlay">
      <h2 class="r-hero">The Art of <em>Precision</em></h2>
      <p class="r-hero">Every Fylex timepiece is born from a relentless pursuit of perfection. From the initial sketch to the final assembly, our master watchmakers combine centuries-old techniques with pioneering technology. We believe that true luxury lies in the details—the invisible gears, the hand-polished surfaces, and the unwavering commitment to chronometric excellence that defines our heritage.</p>
    </div>
  </section>

  <!-- 6. MOVEMENT -->
  <section id="mv">
    <div class="fxt-feature-block theme-cool r0">
      <div class="fxt-feature-img rl">
        <img src="assets/movement_detail.png" alt="The Movement" loading="lazy" />
      </div>
      <div class="fxt-feature-con rr">
        <div class="lbl">Calibre FX-3200</div>
        <div class="rule"></div>
        <h2 class="hd">The heart of<br /><em>precision</em></h2>
        <p class="bt" style="margin-top:22px;">In-house movement, 14 years of R&amp;D, manufactured and assembled
          entirely in Geneva. Superlative Chronometer certified to ±1 second per day across all conditions.</p>
      </div>
    </div>

    <div class="mvbg"></div>
    <div class="mvgrid">
      <div class="mvcard r0">
        <div class="mvico"><svg viewBox="0 0 40 40">
            <circle cx="20" cy="20" r="16" />
            <line x1="20" y1="4" x2="20" y2="10" />
            <line x1="20" y1="30" x2="20" y2="36" />
            <line x1="4" y1="20" x2="10" y2="20" />
            <line x1="30" y1="20" x2="36" y2="20" />
            <circle cx="20" cy="20" r="4" />
          </svg></div>
        <div class="mvkey">Frequency</div>
        <div class="mvval">28<sup>,800 vph</sup></div>
        <div class="mvdsc">4 Hz oscillation for silky smooth seconds sweep. Beats in perfect time, every time.</div>
      </div>
      <div class="mvcard r0">
        <div class="mvico"><svg viewBox="0 0 40 40">
            <path d="M20 4 L36 20 L20 36 L4 20 Z" />
            <path d="M20 12 L28 20 L20 28 L12 20 Z" />
            <circle cx="20" cy="20" r="3" />
          </svg></div>
        <div class="mvkey">Power Reserve</div>
        <div class="mvval">72<sup>h</sup></div>
        <div class="mvdsc">Dual mainspring barrel architecture provides three full days of operation.</div>
      </div>
      <div class="mvcard r0">
        <div class="mvico"><svg viewBox="0 0 40 40">
            <circle cx="20" cy="20" r="15" />
            <circle cx="20" cy="20" r="8" />
            <line x1="20" y1="5" x2="20" y2="12" />
            <line x1="20" y1="28" x2="20" y2="35" />
            <line x1="5" y1="20" x2="12" y2="20" />
            <line x1="28" y1="20" x2="35" y2="20" />
          </svg></div>
        <div class="mvkey">Certification</div>
        <div class="mvval">COSC</div>
        <div class="mvdsc">Superlative Chronometer certified to ±1 second per day across all conditions.</div>
      </div>
    </div>
    <style>
      .hvideo, .vcimg img, .fxt-feature-block img, #mainWatch {
        will-change: transform, opacity;
        backface-visibility: hidden;
        -webkit-font-smoothing: antialiased;
      }
    </style>
    <div class="mvphotos">
      <div class="mvp r0"><img src="https://images.unsplash.com/photo-1594534475808-b18fc33b045e?w=500&q=76"
          alt="Balance wheel" loading="lazy" /><span class="mvpl">Balance Wheel</span></div>
      <div class="mvp r0"><img src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?w=500&q=76"
          alt="Escapement" loading="lazy" /><span class="mvpl">Escapement</span></div>
      <div class="mvp r0"><img src="https://images.unsplash.com/photo-1539874754764-5a96559165b0?w=500&q=76"
          alt="Main Barrel" loading="lazy" /><span class="mvpl">Main Barrel</span></div>
      <div class="mvp r0"><img src="https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?w=500&q=76" alt="Rotor"
          loading="lazy" /><span class="mvpl">Self-winding Rotor</span></div>
    </div>
  </section>

  <!-- 7. VARIANTS -->
  <section id="vr">
    <div class="vrhdr">
      <div class="lbl r0">The Collection</div>
      <div class="rule r0"></div>
      <h2 class="hd r0">Choose your <em>legacy</em></h2>
    </div>
    <div class="vrgrid">
      <div class="vc r0">
        <div class="vcimg"><img src="https://images.unsplash.com/photo-1587836374828-4dbafa94cf0e?w=700&q=84"
            alt="Master Steel" loading="lazy" /></div>
        <div class="vbody">
          <div class="vname">Master Steel</div>
          <div class="vsub">904L Steel · Black Dial · Oyster Bracelet</div>
          <div class="vprice">$14,800</div><button class="vbtn">Configure &amp; Order</button>
        </div>
      </div>
      <div class="vc feat r0">
        <div class="vbdg">Best Seller</div>
        <div class="vcimg"><img src="https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=700&q=84"
            alt="Master Gold" loading="lazy" /></div>
        <div class="vbody">
          <div class="vname">Master Gold</div>
          <div class="vsub">18K Rose Gold · Champagne Dial · Leather</div>
          <div class="vprice">$38,500</div><button class="vbtn">Configure &amp; Order</button>
        </div>
      </div>
      <div class="vc r0">
        <div class="vcimg"><img src="https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?w=700&q=84"
            alt="Master Noir" loading="lazy" /></div>
        <div class="vbody">
          <div class="vname">Master Noir</div>
          <div class="vsub">DLC Coated · Meteorite Dial · Rubber Strap</div>
          <div class="vprice">$22,400</div><button class="vbtn">Configure &amp; Order</button>
        </div>
      </div>
    </div>
  </section>

  <!-- 8. CTA -->
  <section id="cta">
    <div class="ctaph"></div>
    <div class="ctaov"></div>
    <div class="ctacon">
      <div class="lbl r0">A Timepiece. A Legacy.</div>
      <div class="rule r0"></div>
      <h2 class="ctatitle r0">Own the<br /><em>Master</em></h2>
      <p class="ctasub r0">Limited production of 500 pieces per year. Each individually numbered and registered.</p>
      <div class="ctaacts r0">
        <a class="bf" href="#">Acquire Now</a>
        <a href="#"
          style="font-size:12px;letter-spacing:.22em;text-transform:uppercase;color:rgba(245,240,232,.5);text-decoration:none;padding:15px 0;border-bottom:1px solid rgba(245,240,232,.22);transition:color .3s;align-self:center;"
          onmouseenter="this.style.color='rgba(245,240,232,.9)'"
          onmouseleave="this.style.color='rgba(245,240,232,.5)'">Visit a Boutique →</a>
      </div>
      <p class="ctafine r0">Complimentary worldwide delivery · 5-year movement guarantee · White-glove service</p>
    </div>
  </section>

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
    // ─── MOBILE MENU ───
    function toggleMobileMenu() {
      const menu = document.getElementById('mobileMenu');
      const burger = document.getElementById('hamburger');
      const nav = document.getElementById('nav');
      const isOpen = menu.classList.contains('open');

      menu.classList.toggle('open');
      burger.classList.toggle('open');
      nav.classList.toggle('menu-open');

      if (!isOpen) {
        gsap.fromTo(menu.querySelectorAll('a'),
          { y: 30, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.6, stagger: 0.08, ease: 'power3.out', delay: 0.1 }
        );
      }
    }

    function closeMobileMenu() {
      const menu = document.getElementById('mobileMenu');
      const burger = document.getElementById('hamburger');
      const nav = document.getElementById('nav');

      menu.classList.remove('open');
      burger.classList.remove('open');
      nav.classList.remove('menu-open');
    }

    // ─── LENIS SMOOTH SCROLL ───
    const lenis = new Lenis({
      duration: 1.2,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      orientation: 'vertical',
      gestureOrientation: 'vertical',
      smoothWheel: true,
      wheelMultiplier: 1,
      smoothTouch: false,
      touchMultiplier: 2,
      infinite: false,
    });

    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => { lenis.raf(time * 1000); });
    gsap.ticker.lagSmoothing(0);

    // ─── GSAP ───
    gsap.registerPlugin(ScrollTrigger);
    ScrollTrigger.create({ start: 'top -60', end: 99999, toggleClass: { targets: '#nav', className: 'sticky' } });

    function reveal(sel, xFrom) {
      gsap.utils.toArray(sel).forEach((el) => {
        gsap.fromTo(el,
          { opacity: 0, x: xFrom || 0, y: xFrom ? 0 : 28 },
          { opacity: 1, x: 0, y: 0, duration: 1.1, ease: 'power3.out', scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' } }
        );
      });
    }
    reveal('.r0'); reveal('.rl', -32); reveal('.rr', 32);

    // ─── HERO REVEALS ───
    setTimeout(() => {
      gsap.utils.toArray('.r-hero').forEach((el, i) => {
        gsap.fromTo(el,
          { opacity: 0, y: 30, scale: 0.95 },
          { opacity: 1, y: 0, scale: 1, duration: 1.8, ease: 'power4.out', delay: 0.5 + (i * 0.2) }
        );
      });
    }, 100);

    gsap.utils.toArray('.r-dial').forEach((el, i) => {
      gsap.fromTo(el, { opacity: 0, y: 40 }, {
        opacity: 1, y: 0, duration: 1.5, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 80%' },
        delay: i * 0.2
      });
    });

    // ─── FLOATING OVERLAYS ───
    gsap.to('.video-overlay', {
      y: '+=15',
      duration: 3,
      ease: 'sine.inOut',
      repeat: -1,
      yoyo: true
    });

    // ─── FEATURE BLOCK ANIMATIONS ───
    gsap.utils.toArray('.fxt-feature-block').forEach(block => {
      const img = block.querySelector('img');
      const con = block.querySelector('.fxt-feature-con');
      if (img) {
        gsap.fromTo(img,
          { scale: 1.1, opacity: 0, x: -40 },
          { scale: 1, opacity: 1, x: 0, duration: 1.4, ease: 'power4.out', scrollTrigger: { trigger: block, start: 'top 80%' } }
        );
      }
      if (con) {
        gsap.fromTo(con,
          { opacity: 0, x: 40 },
          { opacity: 1, x: 0, duration: 1.2, ease: 'power3.out', delay: 0.2, scrollTrigger: { trigger: block, start: 'top 80%' } }
        );
      }
    });

    // ─── WATCH SEQUENCE ANIMATION ───
    const canvas = document.getElementById("watch-canvas");
    const context = canvas.getContext("2d");
    canvas.width = 1920;
    canvas.height = 1080;

    const frameCount = 210;
    const currentFrame = index => `watch/ezgif-frame-${(index + 1).toString().padStart(3, '0')}.jpg`;

    const images = [];
    const airpods = { frame: 0 };

    for (let i = 0; i < frameCount; i++) {
      const img = new Image();
      img.src = currentFrame(i);
      images.push(img);
    }

    gsap.to(airpods, {
      frame: frameCount - 1,
      snap: "frame",
      ease: "none",
      scrollTrigger: {
        trigger: "#watch-sequence",
        pin: ".watch-sticky",
        start: "top top",
        end: "bottom bottom",
        scrub: 0.5
      },
      onUpdate: render
    });

    images[0].onload = render;

    function render() {
      context.clearRect(0, 0, canvas.width, canvas.height);
      const img = images[airpods.frame];
      if (img) context.drawImage(img, 0, 0, canvas.width, canvas.height);
    }

    // ─── WATCH 360 ROTATION ───
    const watchImages = ['assets/001.png', 'assets/002.png', 'assets/003.png'];
    let activeWatchIndex = 0;
    const mainWatch = document.getElementById('mainWatch');

    const isMobile = window.innerWidth <= 768;

    ScrollTrigger.create({
      trigger: "#rot",
      start: "top top",
      end: isMobile ? "+=120%" : "+=150%",
      pin: true,
      animation: gsap.fromTo(mainWatch,
        { y: isMobile ? '80vh' : '100vh', opacity: 0.5, scale: 0.8 },
        { y: '0vh', opacity: 1, scale: 1, ease: 'none' }
      ),
      scrub: 0.5
    });

    const dots = document.querySelectorAll('.rdot');
    
    function changeWatch(index) {
      if (index === activeWatchIndex) return;
      activeWatchIndex = index;
      dots.forEach(d => d.classList.remove('active'));
      dots[index].classList.add('active');
      gsap.to(mainWatch, {
        opacity: 0, duration: 0.3, ease: 'power2.inOut',
        onComplete: () => {
          mainWatch.src = watchImages[activeWatchIndex];
          gsap.to(mainWatch, { opacity: 1, duration: 0.4, ease: 'power2.inOut' });
        }
      });
    }

    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        changeWatch(i);
        // Reset timer on manual click
        clearInterval(watchInterval);
        startWatchInterval();
      });
    });

    let watchInterval;
    function startWatchInterval() {
      watchInterval = setInterval(() => {
        let nextIndex = (activeWatchIndex + 1) % watchImages.length;
        changeWatch(nextIndex);
      }, 12000);
    }
    startWatchInterval();
  </script>
</body>

</html>

