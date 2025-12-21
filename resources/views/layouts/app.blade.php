<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/img/favicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'CheckBill.pk - Instant Duplicate Bill Checker')</title>
    <meta name="description" content="@yield('meta_description', 'Check electricity, gas and internet bills in Pakistan on CheckBill.pk. IESCO, LESCO, KE, SNGPL. Official duplicate bill source with smart reminders.')">
    <meta name="robots" content="@yield('robots', 'index,follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    @stack('schema')

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Smooth Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }
        .animate-delay-100 { animation-delay: 0.1s; }
        .animate-delay-200 { animation-delay: 0.2s; }
        .animate-delay-300 { animation-delay: 0.3s; }
        .animate-delay-400 { animation-delay: 0.4s; }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-pulse-slow {
            animation: pulse 2s ease-in-out infinite;
        }

        /* Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 25%, #f0f9ff 50%, #fef3c7 75%, #f0fdf4 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Custom Dropdown */
        .custom-select-options {
            display: none;
            max-height: 320px;
            overflow-y: auto;
        }
        .custom-select.active .custom-select-options {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }

        .tab-btn-active {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            color: #0f172a;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08), 0 1px 2px rgba(15, 23, 42, 0.04);
        }

        .tab-btn-inactive {
            color: #64748b;
            transition: all 0.2s;
        }
        .tab-btn-inactive:hover {
            color: #0f172a;
            background: rgba(255, 255, 255, 0.5);
        }

        /* Workflow Animation */
        .workflow-step {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }
        .workflow-step.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Dashboard Preview Animation */
        .dashboard-card {
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        /* Glow Effect */
        .glow-green {
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
        }

        /* Number Counter Animation */
        .counter {
            display: inline-block;
        }

        /* Mobile Menu Animation */
        #mobile-menu {
            transition: all 0.3s ease-in-out;
        }
        #mobile-menu.hidden {
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
        }
        #mobile-menu:not(.hidden) {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    @yield('styles')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TVQQV6Z822"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-TVQQV6Z822');
    </script>

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "uoltb12nho");
    </script>

</head>

<body class="@yield('body_class', 'gradient-bg text-slate-700 antialiased relative min-h-screen flex flex-col')">
    <!-- Navbar -->
    <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200/60 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <img src="{{ asset('storage/img/logo.png') }}"
                     alt="CheckBill.pk logo"
                     class="h-10 sm:h-12 md:h-[50px] w-auto max-w-[160px] sm:max-w-[200px]">
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('hubs.electricity') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Electricity</a>
                <a href="{{ route('hubs.gas') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Gas</a>
                <a href="{{ route('hubs.internet') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Internet</a>
            </nav>

            <!-- Desktop Auth Buttons -->
            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-5 py-2 text-xs font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                        <iconify-icon icon="lucide:user-plus" width="14"></iconify-icon>
                        Create account
                    </a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-5 py-2 text-xs font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                        <iconify-icon icon="lucide:layout-dashboard" width="14"></iconify-icon>
                        Dashboard
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button type="button" id="mobile-menu-button" class="md:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors" aria-label="Toggle menu">
                <iconify-icon icon="lucide:menu" width="24" id="menu-icon"></iconify-icon>
                <iconify-icon icon="lucide:x" width="24" id="close-icon" class="hidden"></iconify-icon>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden fixed inset-x-0 top-16 bg-white border-b border-slate-200 shadow-lg max-h-[calc(100vh-4rem)] overflow-y-auto">
            <nav class="px-4 py-4 space-y-1">
                <a href="{{ route('hubs.electricity') }}" class="flex items-center px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50 transition-colors">Electricity</a>
                <a href="{{ route('hubs.gas') }}" class="flex items-center px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50 transition-colors">Gas</a>
                <a href="{{ route('hubs.internet') }}" class="flex items-center px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50 transition-colors">Internet</a>

                <div class="border-t border-slate-200 my-2"></div>

                @guest
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                        <iconify-icon icon="lucide:log-in" width="20" class="mr-3 flex-shrink-0"></iconify-icon>
                        <span>Sign in</span>
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center px-4 py-3 rounded-lg text-base font-semibold text-white bg-gradient-to-r from-slate-900 to-slate-800 shadow-lg">
                        <iconify-icon icon="lucide:user-plus" width="20" class="mr-3 flex-shrink-0"></iconify-icon>
                        <span>Create account</span>
                    </a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg text-base font-semibold text-white bg-gradient-to-r from-slate-900 to-slate-800 shadow-lg">
                        <iconify-icon icon="lucide:layout-dashboard" width="20" class="mr-3 flex-shrink-0"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-grow @yield('main_class', 'pt-20 md:pt-24 pb-12 md:pb-16 px-4 sm:px-6 relative overflow-hidden')">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t-2 border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-10">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 mb-6 md:mb-8">
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="h-10 overflow-hidden">
                            <img src="{{ asset('storage/img/logo.png') }}"
                                 alt="CheckBill.pk logo"
                                 class="w-full h-full object-contain"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="hidden w-full h-full bg-gradient-to-br from-slate-900 to-slate-700 rounded-xl items-center justify-center text-white">
                                <iconify-icon icon="lucide:zap" width="20" class="text-green-400"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600">The fastest way to check and manage your utility bills in Pakistan.</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('hubs.electricity') }}" class="text-slate-600 hover:text-slate-900 transition">Electricity Bills</a></li>
                        <li><a href="{{ route('hubs.gas') }}" class="text-slate-600 hover:text-slate-900 transition">Gas Bills</a></li>
                        <li><a href="{{ route('hubs.internet') }}" class="text-slate-600 hover:text-slate-900 transition">Internet Bills</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Support</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('pages.privacy') }}" class="text-slate-600 hover:text-slate-900 transition">Privacy Policy</a></li>
                        <li><a href="{{ route('pages.terms') }}" class="text-slate-600 hover:text-slate-900 transition">Terms of Service</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="text-slate-600 hover:text-slate-900 transition">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-200 text-center">
                <p class="text-xs text-slate-400">© {{ date('Y') }} CheckBill.pk. Made with ❤️ in Pakistan.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });

            // Close menu when clicking on a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            });

            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
