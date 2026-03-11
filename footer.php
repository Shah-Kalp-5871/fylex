<?php
/**
 * footer.php — Exact footer extracted from Fylex page
 */
?>
<style>
  :root {
    --gold: #c9a96e;
    --gold-light: #e8d5b0;
    --gold-dim: rgba(201,169,110,0.35);
    --cream: #f5f0e8;
    --dark: #0d0d0d;
  }

  footer {
    background: var(--dark);
    padding: clamp(40px, 8vw, 80px) clamp(20px, 5vw, 56px) clamp(20px, 4vw, 40px);
    border-top: 1px solid var(--gold-dim);
    position: relative;
    display: flex;
    flex-direction: column;
    gap: clamp(30px, 6vw, 60px);
    overflow: hidden;
  }

  .footer-main {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: clamp(20px, 4vw, 40px);
  }

  .footer-col h4 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 0.9rem;
    font-weight: 400;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 24px;
  }

  .footer-col ul { list-style: none; }
  .footer-col ul li { margin-bottom: 12px; }

  .footer-link {
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(245,240,232,0.5);
    text-decoration: none;
    transition: color 0.3s, transform 0.3s;
    display: inline-block;
  }
  .footer-link:hover { color: var(--gold-light); transform: translateX(4px); }

  .footer-brand p {
    font-size: 0.75rem;
    line-height: 1.8;
    color: rgba(245,240,232,0.4);
    max-width: 280px;
    margin-top: 16px;
  }

  .footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding-top: clamp(20px, 4vw, 40px);
    border-top: 1px solid rgba(201,169,110,0.1);
  }

  .footer-bottom p {
    font-size: 0.55rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(201,169,110,0.3);
  }

  .footer-mark {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem;
    font-weight: 300;
    letter-spacing: 0.4em;
    color: var(--gold-dim);
    text-transform: uppercase;
  }

  .logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(1.3rem, 4vw, 1.7rem);
    font-weight: 300;
    letter-spacing: .25em;
    color: var(--gold);
    text-transform: uppercase;
    text-decoration: none;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .logo img {
    height: 32px;
    width: auto;
  }

  @media (max-width: 992px) {
    .footer-main { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 576px) {
    .footer-main { grid-template-columns: 1fr; }
    .footer-bottom { justify-content: center; text-align: center; }
    .footer-mark { display: none; }
  }
</style>

<footer>
  <div class="footer-main">
    <div class="footer-col footer-brand">
      <a href="#" class="logo">
        <img src="fylex_logo.png" alt="Fylex Logo">
        Fylex
      </a>
      <p>Redefining luxury horology through centuries of Swiss excellence and precision engineering.</p>
    </div>
    <div class="footer-col">
      <h4>Our Collections</h4>
      <ul>
        <li><a href="#" class="footer-link">Grand Complications</a></li>
        <li><a href="#" class="footer-link">Master Chronometer</a></li>
        <li><a href="#" class="footer-link">The Atelier series</a></li>
        <li><a href="#" class="footer-link">Heritage Collection</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>The House</h4>
      <ul>
        <li><a href="#" class="footer-link">Our Origins</a></li>
        <li><a href="#" class="footer-link">Craftsmanship</a></li>
        <li><a href="#" class="footer-link">Sustainability</a></li>
        <li><a href="#" class="footer-link">Careers</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Client Services</h4>
      <ul>
        <li><a href="#" class="footer-link">Contact Us</a></li>
        <li><a href="#" class="footer-link">Private Viewing</a></li>
        <li><a href="#" class="footer-link">Watch Care</a></li>
        <li><a href="#" class="footer-link">Registry</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2026 Fylex · Swiss Made</p>
    <div class="footer-mark">F · Y · L · E · X</div>
    <p>Crafted with Intention</p>
  </div>
</footer>