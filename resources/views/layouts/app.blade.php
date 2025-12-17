<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CheckBill.pk')</title>
    <meta name="description" content="@yield('meta_description', 'Check electricity, gas and internet bills online in Pakistan with CheckBill.pk – fast duplicate bills, due dates and reminders.')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="robots" content="@yield('robots', 'index,follow')">
    @yield('jsonld')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-700 antialiased flex flex-col">
    <header class="bg-white/90 backdrop-blur border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-slate-900 text-white flex items-center justify-center shadow-sm">
                    <span class="text-[13px] font-bold">CB</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-bold tracking-tight text-slate-900 leading-none">CheckBill.pk</span>
                    <span class="text-[10px] font-medium text-slate-500 uppercase tracking-wider mt-0.5">Bill Companion</span>
                </div>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="{{ route('hubs.electricity') }}" class="font-medium text-slate-500 hover:text-slate-900">Electricity</a>
                <a href="{{ route('hubs.gas') }}" class="font-medium text-slate-500 hover:text-slate-900">Gas</a>
                <a href="{{ route('hubs.internet') }}" class="font-medium text-slate-500 hover:text-slate-900">Internet</a>
            </nav>
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                        <iconify-icon icon="lucide:user-plus" width="14"></iconify-icon>
                        Create free account
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                        <iconify-icon icon="lucide:layout-dashboard" width="14"></iconify-icon>
                        Your dashboard
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 mt-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-400">© {{ date('Y') }} CheckBill.pk. Made with ❤️ in Pakistan.</p>
            <div class="flex items-center gap-6 text-xs">
                <a href="{{ route('hubs.electricity') }}" class="text-slate-500 hover:text-slate-900">Electricity bills</a>
                <a href="{{ route('hubs.gas') }}" class="text-slate-500 hover:text-slate-900">Gas bills</a>
                <a href="{{ route('hubs.internet') }}" class="text-slate-500 hover:text-slate-900">Internet bills</a>
            </div>
        </div>
    </footer>
</body>
</html>


