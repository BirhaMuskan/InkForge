<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INKFORGE</title>
  <link rel="stylesheet" href="{{asset('home/css/homeStyle.css')}}">
  <link rel="stylesheet" href="{{asset('home/css/nav.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
@include('home.homeLayout')
  <!-- SLIDER -->
  <section class="slider">
    <div class="slide active" style="background-image:url('{{ asset('home/images/hero3.png') }}')"></div>
    <div class="slide" style="background-image:url('{{ asset('home/images/hero2.jpg') }}')"></div>
    <div class="slide" style="background-image:url('{{ asset('home/images/hero1.jpg') }}')"></div>

    <div class="overlay"></div>

    <div class="hero-content">
      <h1>INKFORGE</h1>
      <p>Shop from Artists all around the WORLD.<br> Wanna create Your OWN? We Have Got You!</p>
      <button class="hero-btn">Explore Collection</button>
    </div>

    <div class="dots">
      <div class="dot active"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
  </section>
  <!-- ===== BEST SELLERS SLIDER (Marketplace Level) ===== -->
  <section class="best-sellers">
    <div class="container">

      <div class="bs-header">

        <div>
          <h2>Best Sellers</h2>
          <p class="bs-sub">Top trending products this week</p>
        </div>
        <div class="bs-controls">
          <button class="bs-btn" id="bsPrev">❮</button>
          <button class="bs-btn" id="bsNext">❯</button>
        </div>
      </div>

      <div class="bs-slider-wrapper">
        <div class="bs-slider" id="bsSlider">

          <!-- PRODUCT 1 -->
          <div class="product-card">
            <div class="product-img">
              <span class="badge">HOT</span>
              <img src="0226/views/1,width=500,height=500,appearanceId=231,backgroundColor=F2F2F2,modelId=15731,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Minimal Mountain T-Shirt</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$19.99 <span class="old-price">$24.99</span></p>
            </div>
          </div>

          <!-- PRODUCT 2 -->
          <div class="product-card">
            <div class="product-img">
              <span class="badge">BEST</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T1459A839PA3861PT28X0Y10D1053985868W10000H8051/views/1,width=500,height=500,appearanceId=839,backgroundColor=F2F2F2,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Travel Adventure Hoodie</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$39.99 <span class="old-price">$49.99</span></p>
            </div>
          </div>

          <!-- PRODUCT 3 -->
          <div class="product-card">
            <div class="product-img">
              <span class="badge">NEW</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T842A2PA3667PT17X62Y12D1048645201W12790H25000/views/1,width=500,height=500,appearanceId=77,backgroundColor=F2F2F2,modelId=13303,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Nature Line Phone Case</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$14.99 <span class="old-price">$19.99</span></p>
            </div>
          </div>

          <!-- PRODUCT 4 -->
          <div class="product-card">
            <div class="product-img">
              <span class="badge">HOT</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T1049A361PA3068PT17X0Y20D1055632003W24929H25995/views/1,width=500,height=500,appearanceId=361,backgroundColor=F2F2F2,modelId=2018,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Abstract Wall Art</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$29.99 <span class="old-price">$39.99</span></p>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">
              <span class="badge">HOT</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T812A1PA4256PT17X55Y44D1055755509W23499H35979/views/2,width=500,height=500,appearanceId=1,backgroundColor=F2F2F2,modelId=20499,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Abstract Wall Art</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$29.99 <span class="old-price">$39.99</span></p>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">
              <span class="badge">HOT</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T2950A1PA4640PT34X47Y4D1049788241W3090H4000Cx00A7B5:xE5E1E6:xE03C31:xD7C4B7/views/1,width=500,height=500,appearanceId=725,backgroundColor=F2F2F2,modelId=10813,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Abstract Wall Art</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$29.99 <span class="old-price">$39.99</span></p>
            </div>
          </div>

          <div class="product-card">
            <div class="product-img">
              <span class="badge">HOT</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T2440A1PA4523PT17X53Y30D1054531928W18630H25000/views/1,width=500,height=500,appearanceId=1,backgroundColor=F2F2F2,modelId=12383,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Abstract Wall Art</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$29.99 <span class="old-price">$39.99</span></p>
            </div>
          </div>
          <div class="product-card">
            <div class="product-img">
              <span class="badge">HOT</span>
              <img src="https://image.spreadshirtmedia.com/image-server/v1/products/T512A231PA4049PT17X37Y16D1037705440W22722H30226/views/1,width=500,height=500,appearanceId=231,backgroundColor=F2F2F2,modelId=15731,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Minimal Mountain T-Shirt</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$19.99 <span class="old-price">$24.99</span></p>
            </div>
          </div>

          <!-- PRODUCT 2 -->
          <div class="product-card">
            <div class="product-img">
              <span class="badge">BEST</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T1459A839PA3861PT28X0Y10D1053985868W10000H8051/views/1,width=500,height=500,appearanceId=839,backgroundColor=F2F2F2,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Travel Adventure Hoodie</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$39.99 <span class="old-price">$49.99</span></p>
            </div>
          </div>

          <!-- PRODUCT 3 -->
          <div class="product-card">
            <div class="product-img">
              <span class="badge">NEW</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T842A2PA3667PT17X62Y12D1048645201W12790H25000/views/1,width=500,height=500,appearanceId=77,backgroundColor=F2F2F2,modelId=13303,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Nature Line Phone Case</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$14.99 <span class="old-price">$19.99</span></p>
            </div>
          </div>

          <!-- PRODUCT 4 -->
          <div class="product-card">
            <div class="product-img">
              <span class="badge">HOT</span>
              <img
                src="https://image.spreadshirtmedia.com/image-server/v1/products/T1049A361PA3068PT17X0Y20D1055632003W24929H25995/views/1,width=500,height=500,appearanceId=361,backgroundColor=F2F2F2,modelId=2018,crop=list">
              <div class="quick-actions">
                <button>♡</button>
                <button>🛒</button>
              </div>
            </div>
            <div class="product-info">
              <p class="product-title">Abstract Wall Art</p>
              <div class="product-rating">★★★★★</div>
              <p class="product-price">$29.99 <span class="old-price">$39.99</span></p>
            </div>
          </div>

        </div>

      </div>

      <div class="bs-dots" id="bsDots"></div>

    </div>
  </section>
  <!-- ===== INKFORGE DESIGN STUDIO ===== -->

  <section class="design-studio">
    <div class="ds-container">

      <!-- VISUAL LEFT -->
      <div class="ds-visual">
        <div class="mockup-card">
          <img
            src="https://images.ctfassets.net/5hig0ukq7ib0/7MuMCuJnEUZZzL7TGmchSp/17603cbfc956475ecde8141a428de7af/HomepageTile_Desktop_2024_Home_Living.png?fm=jpg&q=85&w=1080&fl=progressive"
            alt="Designer Mockup">
          <div class="mockup-badge">Live Preview</div>
        </div>
        <div class="mockup-card secondary">
          <img
            src="https://images.ctfassets.net/5hig0ukq7ib0/o3mGgWSj4iR9TR6tXuIW1/da8878062313a1369d2f61e3c8727bee/24Q402_GM_Holiday_NJaG_OnSite_Homepage-Desktop_Tile-Deals.png?fm=jpg&q=85&w=1080&fl=progressive"
            alt="Multi-Angle Preview">
          <div class="mockup-badge">Multi-Angle</div>
        </div>
      </div>

      <!-- CONTENT RIGHT -->
      <div class="ds-content">
        <h2>Create, Customize & Sell Your Designs</h2>
        <p>Use InkForge Studio to bring your imagination to life. From T-shirts to mugs, stickers to wall art — design
          it all with ease!</p>

        <div class="ds-features">
          <div class="ds-feature">
            <div class="icon-circle" style="background:#FF6B6B;"><i class="fa-solid fa-upload"></i></div>
            <p>Upload Artwork & Images</p>
          </div>
          <div class="ds-feature">
            <div class="icon-circle" style="background:#FFD93D;"><i class="fa-solid fa-font"></i></div>
            <p>Text & Typography Tools</p>
          </div>
          <div class="ds-feature">
            <div class="icon-circle" style="background:#6BCB77;"><i class="fa-solid fa-shirt"></i></div>
            <p>Apply Designs to 200+ Products</p>
          </div>
          <div class="ds-feature">
            <div class="icon-circle" style="background:#4D96FF;"><i class="fa-solid fa-eye"></i></div>
            <p>Real-Time Preview All Angles & Colors</p>
          </div>
          <div class="ds-feature">
            <div class="icon-circle" style="background:#FF6B6B;"><i class="fa-solid fa-globe"></i></div>
            <p>Global Production & Shipping</p>
          </div>
          <div class="ds-feature">
            <div class="icon-circle" style="background:#FFD93D;"><i class="fa-solid fa-sack-dollar"></i></div>
            <p>Marketplace Sales & Earnings</p>
          </div>
        </div>

        <div class="ds-actions">
          <button class="ds-primary">Start Designing</button>
          <button class="ds-secondary">Open Your Shop</button>
        </div>
      </div>

    </div>
  </section>

  <!-- ===== CATEGORIES GRID ===== -->

  <section class="categories-grid">
    <div class="container">
      <div class="bs-header">
        <h2>Shop by Category</h2>
      </div>

      <div class="bs-slider-wrapper">
        <div class="bs-slider" id="categoriesSlider">

          @foreach($categories as $category)
          <a style="text-decoration: none; " href="{{ route('cards', ['category[]' => $category->id]) }}" class="product-card">
          <div class="product-card">
            <div class="product-img">
              <img src="{{ $category->Image }}"
                alt="Apparel">
            </div>
            <div class="product-info">
              <p class="product-title">{{$category->name}}</p>
              <p class="product-price">{{$category->description}}</p>
            </div>
          </div>
          </a>
          @endforeach
        </div>
      </div>

      <!-- Slider controls -->
      <div class="bs-controls" style="justify-content:flex-end;margin-top:20px;">
        <button class="bs-btn" id="catPrev">❮</button>
        <button class="bs-btn" id="catNext">❯</button>
      </div>
    </div>
  </section>

  <!-- FEATURED DESIGNERS SECTION -->
  <section class="featured-designers">
    <h2>Featured Designers</h2>
    <p>Meet the creative minds shaping our marketplace!</p>

    <div class="fd-bubbles">
      <!-- <div class="bubble" style="--size:120px; --bg:linear-gradient(135deg,#FF6B6B,#FFD93D);">
        <img src="https://i.pravatar.cc/150?img=1" alt="Luna Art">
        <span class="designer-name">Luna Art</span>
      </div>
      <div class="bubble" style="--size:100px; --bg:linear-gradient(135deg,#6BCB77,#4D96FF);">
        <img src="https://i.pravatar.cc/150?img=2" alt="Kai Colors">
        <span class="designer-name">Kai Colors</span>
      </div>
      <div class="bubble" style="--size:140px; --bg:linear-gradient(135deg,#FF6B6B,#FF9F1C);">
        <img src="https://i.pravatar.cc/150?img=3" alt="Mira Studio">
        <span class="designer-name">Mira Studio</span>
      </div>
      <div class="bubble" style="--size:130px; --bg:linear-gradient(135deg,#3f773b,#FF6B6B);">
        <img src="https://i.pravatar.cc/150?img=5" alt="Leo Design">
        <span class="designer-name">Leo Design</span>
      </div> -->

      @foreach($designers as $designer)
<div class="bubble"
     style="
        --size:{{ rand(100,140) }}px;
        --bg:linear-gradient(135deg,#{{ substr(md5($designer->id),0,6) }},#FFD93D);
     ">

    <img src="{{ $designer->avatar_url }}" alt="{{ $designer->username }}">


    <span class="designer-name">
        {{ $designer->username }}
    </span>
</div>
@endforeach


    </div>
  </section>
  <!-- TRUST BADGES SECTION -->
  <section class="trust-badges">
    <div class="tb-container">
      <h2>Trusted by Professionals Worldwide</h2>
      <p>Our platform ensures secure transactions, verified creators, and high-quality products. Every purchase is
        backed by our guarantee.</p>

      <div class="tb-grid">
        <div class="tb-card">
          <i class="fa-solid fa-shield-halved"></i>
          <h3>Secure Payments</h3>
          <p>Encrypted and safe transactions for every order, so you can shop worry-free.</p>
        </div>
        <div class="tb-card">
          <i class="fa-solid fa-truck-fast"></i>
          <h3>Fast Global Shipping</h3>
          <p>Reliable and trackable shipping worldwide, reaching customers on time.</p>
        </div>
        <div class="tb-card">
          <i class="fa-solid fa-award"></i>
          <h3>Quality Guarantee</h3>
          <p>We only partner with verified creators and print partners to ensure top-quality products.</p>
        </div>
        <div class="tb-card">
          <i class="fa-solid fa-users"></i>
          <h3>Trusted Community</h3>
          <p>Thousands of satisfied buyers and creators trust InkForge for their designs and products.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- BUSINESS / BULK ORDERS SECTION -->
  <section class="business-bulk">
    <div class="bb-container">
      <!-- Left: Visual / Illustration -->
      <div class="bb-visual">
        <img src="https://www.bigapplewarehouseservices.com/wp-content/uploads/2019/08/Wholesalers-And-Distributors.jpg"
          alt="Bulk Orders Illustration">
        <div class="bb-badge">Trusted by Businesses</div>
      </div>

      <!-- Right: Content -->
      <div class="bb-content">
        <h2>Business & Bulk Orders</h2>
        <p>Looking to order in bulk? InkForge makes it easy for companies, resellers, and organizations to get
          high-quality custom products at scale.</p>

        <div class="bb-features">
          <div class="bb-feature">
            <i class="fa-solid fa-boxes-stacked"></i>
            <p>Custom Bulk Printing</p>
          </div>
          <div class="bb-feature">
            <i class="fa-solid fa-truck-fast"></i>
            <p>Fast, Reliable Shipping</p>
          </div>
          <div class="bb-feature">
            <i class="fa-solid fa-handshake-angle"></i>
            <p>Dedicated Account Manager</p>
          </div>
          <div class="bb-feature">
            <i class="fa-solid fa-dollar-sign"></i>
            <p>Exclusive Discounts</p>
          </div>
        </div>

        <div class="bb-actions">
          <button class="bb-primary">Get a Quote</button>
          <button class="bb-secondary">Learn More</button>
        </div>
      </div>
    </div>

    <!-- Animated Background Shapes -->
    <div class="bb-bg-shapes">
      <div class="bb-shape circle" style="--size:80px; --x:10%; --y:20%; --bg:#6BCB77;"></div>
      <div class="bb-shape circle" style="--size:120px; --x:70%; --y:50%; --bg:#FF6B6B;"></div>
      <div class="bb-shape triangle" style="--size:60px; --x:40%; --y:80%; --bg:#FFD93D;"></div>
      <div class="bb-shape circle" style="--size:100px; --x:85%; --y:10%; --bg:#4D96FF;"></div>
    </div>
  </section>

  <!-- FOOTER ECOSYSTEM -->
  <footer class="footer-ecosystem">
    <div class="fe-container">

      <!-- Brand Info -->
      <div class="fe-column">
        <h3>INKFORGE</h3>
        <p>Empowering creators worldwide to bring their designs to life. From apparel to art, our platform connects
          creators and buyers seamlessly.</p>
        <div class="fe-socials">
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
      </div>

      <!-- Marketplace -->
      <div class="fe-column">
        <h4>Marketplace</h4>
        <a href="#">Explore</a>
        <a href="#">Clothing</a>
        <a href="#">Stickers</a>
        <a href="#">Phone Cases</a>
        <a href="#">Wall Art</a>
        <a href="#">Home & Living</a>
      </div>

      <!-- Support -->
      <div class="fe-column">
        <h4>Support</h4>
        <a href="#">Help Center</a>
        <a href="#">Shipping & Delivery</a>
        <a href="#">Returns & Refunds</a>
        <a href="#">Policies</a>
        <a href="#">Contact Us</a>
      </div>

      <!-- Community -->
      <div class="fe-column">
        <h4>Community</h4>
        <p>Subscribe to our newsletter for updates and exclusive offers.</p>
        <input type="email" placeholder="Enter your email">
        <button>Subscribe</button>
      </div>

    </div>

    <div class="fe-bottom">
      <p>© 2026 INKFORGE. All Rights Reserved.</p>
    </div>
  </footer>


  <script>
    const bsSlider = document.getElementById('bsSlider');
    const nextBtn = document.getElementById('bsNext');
    const prevBtn = document.getElementById('bsPrev');
    const cards = document.querySelectorAll('.best-sellers .product-card');

    let bsIndex = 0;
    const cardWidth = cards[0].offsetWidth + 28; // width + gap

    function updateSlider() {
      bsSlider.style.transform = `translateX(-${bsIndex * cardWidth}px)`;
    }

    nextBtn.onclick = () => {
      if (bsIndex < cards.length - 1) {
        bsIndex++;
        updateSlider();
      }
    };

    prevBtn.onclick = () => {
      if (bsIndex > 0) {
        bsIndex--;
        updateSlider();
      }
    };

    /* Auto slide */
    setInterval(() => {
      if (bsIndex < cards.length - 1) {
        bsIndex++;
      } else {
        bsIndex = 0;
      }
      updateSlider();
    }, 4500);

    let slides = document.querySelectorAll('.slide');
    let dots = document.querySelectorAll('.dot');
    let index = 0;

    function showSlide(i) { slides.forEach(s => s.classList.remove('active')); dots.forEach(d => d.classList.remove('active')); slides[i].classList.add('active'); dots[i].classList.add('active'); }
    function autoSlide() { index++; if (index >= slides.length) index = 0; showSlide(index); }
    let sliderInterval = setInterval(autoSlide, 4000);

    dots.forEach((dot, i) => { dot.addEventListener('click', () => { index = i; showSlide(index); clearInterval(sliderInterval); sliderInterval = setInterval(autoSlide, 4000); }); });

    function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('active'); }

    // categories slider
    const categoriesSlider = document.getElementById('categoriesSlider');
    const catNext = document.getElementById('catNext');
    const catPrev = document.getElementById('catPrev');
    const catCards = categoriesSlider.querySelectorAll('.product-card');

    let catIndex = 0;
    const catCardWidth = catCards[0].offsetWidth + 28;

    function updateCatSlider() {
      categoriesSlider.style.transform = `translateX(-${catIndex * catCardWidth}px)`;
    }

    catNext.onclick = () => {
      if (catIndex < catCards.length - 1) {
        catIndex++;
        updateCatSlider();
      }
    };

    catPrev.onclick = () => {
      if (catIndex > 0) {
        catIndex--;
        updateCatSlider();
      }
    };

    /* Optional: Auto slide */
    setInterval(() => {
      if (catIndex < catCards.length - 1) {
        catIndex++;
      } else {
        catIndex = 0;
      }
      updateCatSlider();
    }, 5000);



    const bubbles = document.querySelectorAll('.bubble');

    bubbles.forEach(bubble => {
      const startX = Math.random() * 90; // percentage of width
      const startY = Math.random() * 80; // percentage of height
      const endX1 = (Math.random() - 0.5) * 50; // x movement
      const endX2 = (Math.random() - 0.5) * 50;
      const endX3 = (Math.random() - 0.5) * 50;
      const duration = 10 + Math.random() * 10; // 10-20s

      bubble.style.left = `${startX}%`;
      bubble.style.top = `${startY}%`;

      bubble.style.setProperty('--x1', `${endX1}px`);
      bubble.style.setProperty('--x2', `${endX2}px`);
      bubble.style.setProperty('--x3', `${endX3}px`);
      bubble.style.animationDuration = `${duration}s`;
    });


  </script>

</body>

</html>