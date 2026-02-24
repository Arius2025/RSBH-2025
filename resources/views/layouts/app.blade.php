<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if(app()->environment('production'))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TRKQN4BR');</script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RCMW2MH8LW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-RCMW2MH8LW');
    </script>
    @endif
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RS Tk. III Baladhika Husada') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
      /* ========================================= */
      /* 1. GLOBAL LAYOUT FIX                      */
      /* ========================================= */
      body {
          background-color: #E6F4EA;
          display: flex;
          flex-direction: column;
          min-height: 100vh;
          padding-top: 0 !important; 
          margin: 0;
      }

      main { flex: 1; }

      .transition { transition: all 0.3s ease; }
      .hover-shadow:hover, .card.hover-shadow:hover {
          transform: translateY(-5px); 
          box-shadow: 0 12px 28px rgba(0,0,0,0.2)!important;
      }
      .text-shadow { text-shadow: 0 2px 6px rgba(0,0,0,0.6); }

      /* ========================================= */
      /* 2. FLOATING QUICK ACCESS (Compact)        */
      /* ========================================= */
      .floating-access {
          position: fixed;
          right: 20px;
          bottom: 20px; 
          z-index: 9999;
          display: flex;
          flex-direction: column;
          gap: 10px;
          align-items: flex-end;
      }

      /* Style Tombol Compact */
      .btn-floating {
          border-radius: 50px;
          padding: 8px 16px; /* Padding lebih kecil */
          display: flex;
          align-items: center;
          gap: 10px;
          box-shadow: 0 4px 15px rgba(0,0,0,0.2);
          transition: transform 0.2s ease;
          border: 2px solid white;
          text-decoration: none;
          color: white;
      }

      .btn-floating:hover {
          transform: scale(1.05);
          color: white;
      }

      /* Teks di dalam tombol */
      .btn-floating .text-group {
          display: flex;
          flex-direction: column;
          line-height: 1.1;
          text-align: left;
      }

      .btn-floating .main-text {
          font-weight: 700;
          font-size: 0.9rem;
      }

      .btn-floating .sub-text {
          font-size: 0.65rem; /* Ukuran font kecil untuk keterangan */
          opacity: 0.9;
          white-space: nowrap;
      }

      /* Mobile Adjustment: Naikkan agar tidak ketutupan footer/navbar */
      @media (max-width: 768px) {
          .floating-access {
              bottom: 80px; 
              right: 15px;
          }
          /* Sedikit perkecil padding di HP */
          .btn-floating {
              padding: 6px 14px;
          }
      }

      /* ========================================= */
      /* 3. NAVBAR STYLES                          */
      /* ========================================= */
      .navbar-custom {
          transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
          background-color: rgba(255, 255, 255, 0.95) !important;
          backdrop-filter: blur(8px);
          -webkit-backdrop-filter: blur(8px);
          padding: 10px 0;
          border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      }
      .navbar-scrolled {
          padding: 5px 0 !important;
          background-color: rgba(255, 255, 255, 0.98) !important;
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
      }
      .nav-link-custom {
          font-weight: 600; color: #444 !important; padding: 6px 15px !important;
          margin: 0 2px; font-size: 0.9rem; transition: all 0.2s ease; border-radius: 8px;
      }
      .nav-link-custom:hover { color: #2ecc71 !important; background: rgba(46, 204, 113, 0.1); }
      .nav-link-custom.active { color: #ffffff !important; background-color: #2ecc71; }
      
      .nav-link-mobile {
          color: #3498db; text-align: center; padding: 10px 0;
          text-decoration: none; font-size: 1.5rem; transition: all 0.3s; flex-grow: 1;
      }
      .nav-link-mobile.active-mobile { color: #2ecc71; border-top: 3px solid #2ecc71; }

      /* ========================================= */
      /* 4. HERO & CONTENT STYLES                  */
      /* ========================================= */
      .hero-section {
          position: relative; height: 500px; 
          background: url('images/rumah sakit dkt.jpg') no-repeat center center/cover;
          border-radius: 15px; overflow: hidden;
          box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); display: flex; align-items: center; 
      }
      @media (max-width: 992px) { .hero-section { height: 380px; align-items: flex-end; } }
      .hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 50, 0, 0.65); z-index: 1; }
      .hero-content { position: relative; z-index: 2; width: 100%; padding: 0 15px; }

      /* ========================================= */
      /* 5. TENTANG KAMI & GALERI                  */
      /* ========================================= */
      .tentang-kami-card { display: flex; flex-direction: row; border-radius: 15px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
      .tentang-kami-img { background-color: #2ecc71; padding: 40px; flex: 0 0 35%; display: flex; align-items: center; justify-content: center; }
      .karumkit-photo-wrapper { width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 5px solid rgba(255, 255, 255, 0.7); box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); }
      .karumkit-photo-wrapper img { width: 100%; height: 100%; object-fit: cover; }
      .tentang-kami-content { background-color: #fff; flex: 1; }
      @media (max-width: 768px) { .tentang-kami-card { flex-direction: column; } .tentang-kami-img { flex: 0 0 100%; padding: 30px; } }

      .galeri-carousel { overflow-x: auto; white-space: nowrap; padding-bottom: 10px; }
      .galeri-track { display: inline-flex; gap: 15px; padding: 0 15px; }
      .galeri-track img { width: 300px; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s; }
      .galeri-track img:hover { transform: scale(1.03); }

      .testimoni-card { background: #ffffff; border-left: 5px solid #f39c12; border-radius: 10px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); padding: 30px; max-width: 350px; text-align: left; }
    </style>
    
    @stack('styles')
</head>

<body class="font-sans antialiased">
    @if(app()->environment('production'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRKQN4BR"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @include('components.navbar')

    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-2 px-2 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main> 
        @yield('content') 
    </main>
    

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 100, duration: 800 });

        document.querySelectorAll('.nav-link-custom').forEach(link => {
            if (link.hasAttribute('data-bs-toggle') || link.classList.contains('dropdown-toggle')) { return; }
            const currentPath = window.location.pathname.replace(/\//g, ""); 
            const linkPath = new URL(link.href).pathname.replace(/\//g, ""); 
            if (linkPath === currentPath) { link.classList.add('active'); }
        });

        const nav = document.getElementById('desktopNav');
        if(nav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) { nav.classList.add('navbar-scrolled'); } 
                else { nav.classList.remove('navbar-scrolled'); }
            });
        }

        const galeriCarousel = document.querySelector('.galeri-carousel');
        if (galeriCarousel) {
            const scrollSpeed = 50; 
            let scrollInterval;
            function autoScroll() {
                galeriCarousel.scrollLeft += 1;
                if (galeriCarousel.scrollLeft >= (galeriCarousel.scrollWidth - galeriCarousel.clientWidth)) {
                    galeriCarousel.scrollLeft = 0;
                }
            }
            scrollInterval = setInterval(autoScroll, scrollSpeed);
            galeriCarousel.addEventListener('mouseenter', () => clearInterval(scrollInterval));
            galeriCarousel.addEventListener('mouseleave', () => scrollInterval = setInterval(autoScroll, scrollSpeed));
        }
    </script>
    @stack('scripts')
</body>
</html>
