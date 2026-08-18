<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Admin - {{ config('app.name', 'RS Baladhika Husada') }}</title>

    {{-- Tailwind & Alpine --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Manrope:wght@600;700&family=JetBrains+Mono:wght@500&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/dkt.png') }}?v={{ time() }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/dkt.png') }}?v={{ time() }}" type="image/png">
    
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'military-green': '#2c4c3b',
              'military-green-light': '#3a634d',
              'military-green-dark': '#1e3529',
              'gold': '#d4af37',
              'gold-light': '#f3e5ab',
              'gold-dark': '#aa8c2c',
            },
            fontFamily: {
              sans: ['Inter', 'sans-serif'],
              heading: ['Manrope', 'sans-serif'],
            }
          }
        }
      }
    </script>
        
    <!-- Author Attribution & SEO Metadata -->
    <meta name="author" content="Risang Putra Pradana">
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => config('app.name', 'RS Baladhika Husada'),
        'url' => config('app.url', 'http://localhost'),
        'author' => [
            '@type' => 'Person',
            'name' => 'Risang Putra Pradana',
            'email' => 'risangputra144@gmail.com',
            'jobTitle' => 'Full-stack Web Developer'
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
</head>
<body class="bg-[#E6F4EA] min-h-screen flex items-center justify-center font-sans antialiased relative overflow-hidden">
    
    {{-- Background Pattern/Decoration --}}
    <div class="absolute inset-0 z-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="currentColor" stroke-width="2" class="text-military-green-dark"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
        </svg>
    </div>

    <div class="absolute -top-32 -right-32 w-96 h-96 bg-military-green rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-gold rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

    <div class="w-full max-w-md z-10 px-4">
        <div class="bg-white/90 backdrop-blur-xl shadow-2xl rounded-3xl p-8 border border-white/20 transition-all duration-300 hover:shadow-military-green/10">
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-block transition-transform hover:scale-105">
                    <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Logo RS" class="w-48 mx-auto h-auto drop-shadow-md">
                </a>
                <div class="h-1 w-24 bg-gradient-to-r from-military-green to-gold mx-auto mt-6 rounded-full"></div>
            </div>
            
            {{ $slot }}
        </div>
        
        <div class="text-center mt-6 text-sm text-military-green-dark/70 font-medium">
            &copy; {{ date('Y') }} RS Tk. III Baladhika Husada
        </div>
    </div>

    @stack('scripts')   
</body>
</html>