
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ampera Aldo Catering</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght:400;500;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- Background Music -->
    <audio id="userBgm" loop>
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
    </audio>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-maroon': '#A60C14',
                        'accent-gold': '#FFD700',
                        'bg-light': '#F9F9F9'
                    }
                }
            }
        }
    </script>

    <!-- Extra Animations -->
    <style>
        body { 
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .font-playfair { font-family: 'Playfair Display', serif; }

        .fade-up { opacity: 0; transform: translateY(20px); transition: all .8s ease; }
        .fade-left { opacity: 0; transform: translateX(-20px); transition: all .8s ease; }
        .fade-right { opacity: 0; transform: translateX(20px); transition: all .8s ease; }
        .reveal { opacity: 1 !important; transform: translate(0) !important; }

        .card-hover {
            transition: all .35s ease;
        }
        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,.18);
        }

        .parallax-hero {
            background: linear-gradient(135deg, rgba(166,12,20,0.85), rgba(130,0,10,0.85)),
                        url("https://images.unsplash.com/photo-1546069901-ba9599a7e63c");
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        .glow-gold { box-shadow: 0 0 15px rgba(255,215,0,0.6); }
    </style>
</head>


<body class="bg-bg-light">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    <main>
        @auth
            {{-- HERO SECTION --}}
            <section class="parallax-hero py-24 text-white text-center fade-up">
                <h1 class="font-playfair text-5xl md:text-6xl font-bold mb-4 animate-pulse">
                    Selamat Datang, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-xl text-accent-gold">
                    Pilih dashboard yang ingin Anda akses
                </p>
            </section>

            {{-- DASHBOARD ADMIN / USER --}}
            <section class="max-w-7xl mx-auto px-4 py-16 space-y-10">

                @if(Auth::user()->role === 'admin')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- Card 1 --}}
                        <div class="card-hover fade-left bg-white rounded-2xl shadow-lg overflow-hidden border-t-4 border-primary-maroon">
                            <div class="p-8">
                                <div class="flex items-center justify-center h-24 bg-gradient-to-r from-primary-maroon to-red-800 rounded-xl mb-6">
                                    <i class="fas fa-chart-line text-5xl text-white"></i>
                                </div>
                                <h2 class="font-playfair text-3xl font-bold mb-4">Dashboard Admin</h2>
                                <p class="text-gray-600 mb-6">Kelola seluruh data operasional catering Anda.</p>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="block w-full bg-primary-maroon text-white py-3 rounded-lg hover:bg-red-800 transition font-bold text-center glow-gold">
                                   <i class="fas fa-arrow-right"></i> Buka Dashboard
                                </a>
                            </div>
                        </div>

                        {{-- Card Fitur --}}
                        <div class="fade-right bg-gradient-to-br from-accent-gold to-yellow-500 text-gray-900 p-8 rounded-2xl shadow-lg">
                            <h3 class="font-playfair text-2xl font-bold mb-4">
                                <i class="fas fa-lightbulb mr-2"></i> Fitur Admin
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-center gap-2"><i class="fas fa-check text-primary-maroon"></i> Manajemen Pesanan</li>
                                <li class="flex items-center gap-2"><i class="fas fa-check text-primary-maroon"></i> Kelola Menu</li>
                                <li class="flex items-center gap-2"><i class="fas fa-check text-primary-maroon"></i> Catering & Paket</li>
                                <li class="flex items-center gap-2"><i class="fas fa-check text-primary-maroon"></i> Pengguna Sistem</li>
                            </ul>
                        </div>

                    </div>

                @else

                    {{-- USER DASHBOARD --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                        @php
                            $items = [
                                ['icon'=>'fa-utensils','title'=>'Lihat Menu','color'=>'blue','route'=>'pelanggan.menu'],
                                ['icon'=>'fa-birthday-cake','title'=>'Catering','color'=>'purple','route'=>'pelanggan.catering'],
                                ['icon'=>'fa-shopping-cart','title'=>'Keranjang','color'=>'orange','route'=>'pelanggan.keranjang'],
                                ['icon'=>'fa-user-circle','title'=>'Profil Saya','color'=>'pink','route'=>'pelanggan.profile'],
                            ];
                        @endphp

                        @foreach($items as $i)
                        <div class="card-hover fade-up bg-white rounded-2xl shadow-lg overflow-hidden border-t-4 border-{{ $i['color'] }}-500">
                            <div class="p-8">
                                <div class="flex items-center justify-center h-24 bg-gradient-to-r from-{{ $i['color'] }}-500 to-{{ $i['color'] }}-600 rounded-xl mb-6">
                                    <i class="fas {{ $i['icon'] }} text-5xl text-white"></i>
                                </div>
                                <h2 class="font-playfair text-3xl font-bold mb-4">{{ $i['title'] }}</h2>
                                <a href="{{ route($i['route']) }}"
                                   class="w-full block bg-{{ $i['color'] }}-500 hover:bg-{{ $i['color'] }}-600 text-white py-3 rounded-lg font-bold text-center transition">
                                   <i class="fas fa-arrow-right"></i> Buka
                                </a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                @endif
            </section>

            {{-- ABOUT SECTION --}}
            <section class="bg-gray-100 py-16 fade-up">
                <div class="max-w-7xl mx-auto text-center px-4">
                    <h2 class="font-playfair text-4xl font-bold mb-12">Tentang Ampera Aldo</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-8 rounded-xl shadow-lg fade-left">
                            <i class="fas fa-star text-4xl text-accent-gold mb-3"></i>
                            <h3 class="font-bold text-xl mb-2">Kualitas Terbaik</h3>
                            <p class="text-gray-600">Bahan pilihan, rasa premium.</p>
                        </div>

                        <div class="bg-white p-8 rounded-xl shadow-lg fade-up">
                            <i class="fas fa-truck text-4xl text-primary-maroon mb-3"></i>
                            <h3 class="font-bold text-xl mb-2">Pengiriman Cepat</h3>
                            <p class="text-gray-600">Pesanan tepat waktu sampai ke tangan Anda.</p>
                        </div>

                        <div class="bg-white p-8 rounded-xl shadow-lg fade-right">
                            <i class="fas fa-headset text-4xl text-blue-500 mb-3"></i>
                            <h3 class="font-bold text-xl mb-2">Layanan Premium</h3>
                            <p class="text-gray-600">Tim kami siap 24/7.</p>
                        </div>
                    </div>
                </div>
            </section>

        @else
            {{-- LOGIN HERO --}}
            <section class="parallax-hero py-24 text-center fade-up">
                <h1 class="font-playfair text-6xl text-white font-bold">Ampera Aldo Catering</h1>
                <p class="text-accent-gold text-2xl mt-3">Layanan Catering & Menu Terbaik</p>

                <div class="flex justify-center gap-4 mt-10">
                    <a href="{{ route('login') }}" class="px-6 py-3 rounded-lg bg-accent-gold text-primary-maroon font-bold hover:scale-105 transition">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 rounded-lg bg-white text-primary-maroon font-bold hover:scale-105 transition">
                        <i class="fas fa-user-plus"></i> Daftar
                    </a>
                </div>
            </section>
        @endauth
    </main>

    {{-- FOOTER --}}
    <footer class="bg-primary-maroon text-white py-10 mt-20 relative">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- Brand -->
        <div>
            <h2 class="text-2xl font-playfair font-bold text-accent-gold mb-3">Ampera Aldo</h2>
            <p class="text-sm text-gray-200 leading-relaxed">
                Menciptakan cita rasa khas Nusantara dengan sentuhan modern.
                Nikmati pengalaman kuliner terbaik bersama kami.
            </p>
        </div>

        <!-- Navigation -->
        <div>
            <h3 class="text-lg font-semibold text-accent-gold mb-3">Navigasi</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="hover:text-accent-gold transition">Dashboard</a></li>
                <li><a href="{{ route('pelanggan.menu') }}" class="hover:text-accent-gold transition">Menu</a></li>
                <li><a href="{{ route('pelanggan.catering') }}" class="hover:text-accent-gold transition">Catering</a></li>
                <li><a href="{{ route('pelanggan.profile') }}" class="hover:text-accent-gold transition">Profil</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-lg font-semibold text-accent-gold mb-3">Kontak Kami</h3>
            <ul class="space-y-2 text-gray-200">
                <li class="flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-accent-gold"></i>
                    Jl. Rowo Sari, Rumbai Pekanbaru.
                </li>
                <li class="flex items-center gap-2">
                    <i class="fas fa-phone text-accent-gold"></i>
                    +62 822-8725-2172
                </li>
                <li class="flex items-center gap-2">
                    <i class="fas fa-envelope text-accent-gold"></i>
                    info@ampera-aldo.com
                </li>
            </ul>
        </div>

    </div>

    <div class="text-center text-sm text-gray-300 mt-10 border-t border-accent-gold/30 pt-4">
        &copy; 2024 Ampera Aldo. Semua Hak Dilindungi.
    </div>
</footer>

    {{-- SCROLL REVEAL SCRIPT --}}
    <script>
        const observer = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('reveal');
            });
        });

        document.querySelectorAll('.fade-up, .fade-left, .fade-right')
                .forEach(el => observer.observe(el));
    </script>

</body>      
</html>
