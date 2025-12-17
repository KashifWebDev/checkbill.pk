<html lang="en" class="scroll-smooth"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckBill.pk - Instant Duplicate Bill Checker</title>
    <meta name="description" content="Check electricity and gas bills in Pakistan on CheckBill.pk. IESCO, LESCO, KE, SNGPL. Official duplicate bill source with smart reminders.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        /* Smooth Fade In Animation */
        .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; opacity: 0; transform: translateY(20px); }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Dropdown Styles */
        .custom-select-options {
            display: none;
            max-height: 280px;
            overflow-y: auto;
        }
        .custom-select.active .custom-select-options {
            display: block;
            animation: fadeIn 0.15s ease-out;
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

        /* Premium Mesh Gradient */
        .premium-mesh {
            background-color: #ffffff;
            background-image:
                radial-gradient(at 0% 0%, hsla(145, 63%, 95%, 1) 0, transparent 50%),
                radial-gradient(at 50% 0%, hsla(210, 100%, 96%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(145, 63%, 95%, 1) 0, transparent 50%);
        }

        .tab-btn-active {
            background-color: #ffffff;
            color: #0f172a;
            font-weight: 700;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.12);
            border-radius: 0.75rem;
        }

        .tab-btn-inactive {
            color: #64748b;
            border-radius: 0.75rem;
        }
    </style>
</head>
<body class="premium-mesh text-slate-600 antialiased selection:bg-green-500/20 selection:text-green-700 relative min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200/60">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="relative w-9 h-9 bg-slate-900 rounded-xl flex items-center justify-center text-white shadow-xl shadow-slate-900/10 group-hover:rotate-3 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-tr from-green-500/20 to-transparent rounded-xl"></div>
                    <iconify-icon icon="lucide:zap" width="18" class="text-green-400" stroke-width="2"></iconify-icon>
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-bold tracking-tight text-slate-900 leading-none">CheckBill.pk</span>
                    <span class="text-[10px] font-medium text-slate-500 uppercase tracking-wider mt-0.5">Pakistan Bill Checker</span>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-6">
                <a href="#" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Electricity</a>
                <a href="#" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Gas</a>
                <a href="#" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Internet</a>
            </div>

            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-500 p-1">
                    <iconify-icon icon="lucide:menu" width="22"></iconify-icon>
                </button>
                @guest
                    <a href="{{ route('login') }}" class="hidden md:inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="hidden md:inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-xs font-semibold text-white shadow-lg shadow-slate-900/10 hover:bg-slate-800 hover:scale-105 transition-all duration-300">
                        <iconify-icon icon="lucide:user-plus" width="14"></iconify-icon>
                        Create free account
                    </a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="hidden md:inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-xs font-semibold text-white shadow-lg shadow-slate-900/10 hover:bg-slate-800 hover:scale-105 transition-all duration-300">
                        <iconify-icon icon="lucide:layout-dashboard" width="14"></iconify-icon>
                        Open dashboard
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow pt-32 pb-20 px-4 sm:px-6 relative overflow-hidden">

        <!-- Background Elements -->
        <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-green-200/20 blur-[100px] rounded-full -z-10 pointer-events-none"></div>

        <div class="max-w-2xl mx-auto text-center animate-fade-up">
            <!-- Trust Badge -->
            <div class="inline-flex items-center gap-1.5 rounded-full border border-green-200 bg-green-50/50 backdrop-blur-sm px-3 py-1 text-[11px] font-semibold text-green-700 mb-8 uppercase tracking-wide cursor-pointer hover:bg-green-100/50 transition-colors">
                <iconify-icon icon="lucide:shield-check" width="12"></iconify-icon>
                Verified Provider Data 2024
            </div>

            <h1 class="text-4xl sm:text-6xl font-bold tracking-tight text-slate-900 mb-6 leading-[1.1]">
                Check your bill <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600">before it arrives.</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-500 mb-3 max-w-lg mx-auto leading-relaxed">
                The fastest way to get your duplicate electricity or gas bill in Pakistan. Official data from LESCO, K-Electric, and SNGPL.
            </p>
            <p class="text-xs sm:text-sm text-slate-500 mb-10 max-w-lg mx-auto">
                ہر مہینے بل ڈھونڈنے کی ٹینشن ختم – ایک ہی جگہ سے گھر، دفتر اور گیس کے سب بل چیک کریں۔
            </p>
        </div>

        <!-- Premium Card Widget -->
        <div id="app" class="max-w-md mx-auto animate-fade-up delay-100">
            <div class="relative bg-white rounded-3xl shadow-[0_20px_60px_-10px_rgba(0,0,0,0.1)] border border-slate-100 p-2 z-10">

                <!-- Tab Switcher -->
                <div class="flex p-1 bg-slate-50 rounded-2xl mb-4 border border-slate-100/50">
                    <button type="button" data-bill-tab="electricity" id="tab-electricity" class="flex-1 py-2.5 text-xs tab-btn-active transition-all flex items-center justify-center gap-2">
                        <iconify-icon icon="lucide:zap" width="14" class="text-orange-500"></iconify-icon>
                        Electricity
                    </button>
                    <button type="button" data-bill-tab="gas" id="tab-gas" class="flex-1 py-2.5 text-xs tab-btn-inactive hover:text-slate-900 transition-all flex items-center justify-center gap-2">
                        <iconify-icon icon="lucide:flame" width="14"></iconify-icon>
                        Gas
                    </button>
                    <button type="button" data-bill-tab="internet" id="tab-internet" class="flex-1 py-2.5 text-xs tab-btn-inactive hover:text-slate-900 transition-all flex items-center justify-center gap-2">
                        <iconify-icon icon="lucide:wifi" width="14"></iconify-icon>
                        Internet
                    </button>
                </div>

                <form action="{{ route('bills.check') }}" method="GET" class="px-4 pb-4 pt-2">
                    <!-- Custom Dropdown Component -->
                    <div class="mb-5 relative z-50">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2 ml-1">Select Provider</label>

                        <!-- Hidden Input for Form Submission -->
                        <input type="hidden" name="provider" id="provider-input" required="">
                        <input type="hidden" name="type" id="bill-type-input" value="electricity">

                        <!-- Custom Select Trigger -->
                        <div class="custom-select relative">
                            <button type="button" onclick="this.parentElement.classList.toggle('active')" class="w-full text-left bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl px-4 py-3.5 flex items-center justify-between transition-all focus:ring-2 focus:ring-green-500/20 focus:border-green-500 group">
                                <span id="selected-text" class="flex items-center gap-3 text-sm font-medium text-slate-500">
                                    <span class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center">
                                        <iconify-icon icon="lucide:search" width="12" class="text-slate-400"></iconify-icon>
                                    </span>
                                    Search Company (e.g. LESCO)
                                </span>
                                <iconify-icon icon="lucide:chevron-down" width="16" class="text-slate-400 group-focus:text-green-600 transition-colors"></iconify-icon>
                            </button>

                            <!-- Custom Options List -->
                            <div class="custom-select-options absolute top-full left-0 right-0 mt-2 bg-white border border-slate-100 rounded-2xl shadow-xl py-2 z-50">
                                <div class="px-3 py-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Popular Companies</div>

                                <!-- Option: LESCO -->
                                <div data-provider-type="electricity" onclick="selectProvider('lesco', 'LESCO', 'LE', 'bg-orange-100 text-orange-600')" class="px-3 py-2.5 mx-2 rounded-xl hover:bg-slate-50 cursor-pointer flex items-center justify-between group transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-[10px] font-bold ring-2 ring-white">LE</div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900">LESCO</div>
                                            <div class="text-[10px] text-slate-500">Lahore Electric Supply</div>
                                        </div>
                                    </div>
                                    <iconify-icon icon="lucide:check" class="text-green-500 opacity-0 group-hover:opacity-100 transition-opacity" width="16"></iconify-icon>
                                </div>

                                <!-- Option: K-Electric -->
                                <div data-provider-type="electricity" onclick="selectProvider('ke', 'K-Electric', 'KE', 'bg-blue-100 text-blue-600')" class="px-3 py-2.5 mx-2 rounded-xl hover:bg-slate-50 cursor-pointer flex items-center justify-between group transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold ring-2 ring-white">KE</div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900">K-Electric</div>
                                            <div class="text-[10px] text-slate-500">Karachi Electric</div>
                                        </div>
                                    </div>
                                    <iconify-icon icon="lucide:check" class="text-green-500 opacity-0 group-hover:opacity-100 transition-opacity" width="16"></iconify-icon>
                                </div>

                                <!-- Option: IESCO -->
                                <div data-provider-type="electricity" onclick="selectProvider('iesco', 'IESCO', 'IE', 'bg-green-100 text-green-600')" class="px-3 py-2.5 mx-2 rounded-xl hover:bg-slate-50 cursor-pointer flex items-center justify-between group transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-[10px] font-bold ring-2 ring-white">IE</div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900">IESCO</div>
                                            <div class="text-[10px] text-slate-500">Islamabad Electric</div>
                                        </div>
                                    </div>
                                    <iconify-icon icon="lucide:check" class="text-green-500 opacity-0 group-hover:opacity-100 transition-opacity" width="16"></iconify-icon>
                                </div>

                                <div class="border-t border-slate-100 my-1"></div>
                                <div class="px-3 py-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Gas Providers</div>

                                <!-- Option: SNGPL -->
                                <div data-provider-type="gas" onclick="selectProvider('sngpl', 'SNGPL', 'SN', 'bg-indigo-100 text-indigo-600')" class="px-3 py-2.5 mx-2 rounded-xl hover:bg-slate-50 cursor-pointer flex items-center justify-between group transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-[10px] font-bold ring-2 ring-white">SN</div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900">SNGPL</div>
                                            <div class="text-[10px] text-slate-500">Sui Northern Gas</div>
                                        </div>
                                    </div>
                                    <iconify-icon icon="lucide:check" class="text-green-500 opacity-0 group-hover:opacity-100 transition-opacity" width="16"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reference Number Input -->
                    <div class="mb-6 relative z-10">
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Reference No</label>
                            <button type="button" class="text-[10px] font-medium text-green-600 hover:text-green-700 hover:underline flex items-center gap-1">
                                <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                Where to find?
                            </button>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                            </div>
                            <input type="tel" name="reference_number" placeholder="14 digit reference number" class="block w-full bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl py-3.5 pl-11 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all shadow-sm">
                        </div>
                    </div>

                    <!-- Remember Me Toggle -->
                    <div class="flex flex-col gap-1 mb-6 ml-1">
                        @guest
                            <div class="flex items-center gap-2 opacity-60">
                                <input type="checkbox" id="save-bill" class="w-4 h-4 rounded border-slate-300 text-green-600 cursor-not-allowed" disabled>
                                <label for="save-bill" class="text-xs text-slate-600 select-none">Save this bill for next time (requires free account)</label>
                            </div>
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-1 text-[11px] font-semibold text-green-700 hover:text-green-800">
                                <iconify-icon icon="lucide:user-plus" width="12"></iconify-icon>
                                Create a free account to unlock auto-saving & email reminders
                            </a>
                        @endguest

                        @auth
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="save-bill" name="save_bill" class="w-4 h-4 rounded border-slate-300 text-green-600 focus:ring-green-500 cursor-pointer accent-green-600">
                                <label for="save-bill" class="text-xs text-slate-600 select-none cursor-pointer">Save this bill to my dashboard</label>
                            </div>
                        @endauth
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full relative overflow-hidden rounded-xl bg-slate-900 py-4 text-sm font-bold text-white shadow-lg shadow-slate-900/20 hover:bg-slate-800 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 active:scale-[0.98]">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Check Duplicate Bill
                            <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
                        </span>
                    </button>
                </form>

                <!-- Social Proof / Footer of Card -->
                <div class="bg-slate-50 rounded-b-3xl border-t border-slate-100 p-4 flex items-center justify-center gap-4">
                    <div class="flex -space-x-2">
                        <div class="w-6 h-6 rounded-full border-2 border-white bg-slate-200"></div>
                        <div class="w-6 h-6 rounded-full border-2 border-white bg-slate-300"></div>
                        <div class="w-6 h-6 rounded-full border-2 border-white bg-slate-400 flex items-center justify-center text-[8px] text-white font-bold">+2k</div>
                    </div>
                    <p class="text-[10px] font-medium text-slate-500">Used by <span class="text-slate-900 font-bold">10,000+ Pakistanis</span> today</p>
                </div>
            </div>

            <!-- Trust / Signup Benefit Below Card -->
            <div class="mt-8 space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex items-center justify-center gap-2 p-3 rounded-xl bg-green-50 border border-green-100">
                        <iconify-icon icon="lucide:bell-ring" width="18" class="text-green-600"></iconify-icon>
                        <span class="text-xs font-semibold text-green-800">Get reminded before due date – avoid late fees</span>
                    </div>
                    <div class="p-3 rounded-xl bg-white border border-slate-100 shadow-sm space-y-3">
                        <div class="flex flex-col text-[11px] text-slate-500 gap-1">
                            <span class="font-semibold text-slate-800 text-[12px]">After you create a free account</span>
                            <span class="text-[10px] text-slate-500">Preview of your CheckBill.pk dashboard</span>
                        </div>
                        <div class="flex justify-start">
                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-semibold text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Live every month
                            </span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-[10px] text-slate-600">
                            <div class="rounded-xl bg-slate-50 border border-slate-100 p-3 space-y-1">
                                <p class="text-[11px] font-semibold text-slate-900">Home – LESCO</p>
                                <p class="text-slate-500">Next bill: 12 Jan</p>
                                <p class="text-emerald-600 font-semibold mt-1">Paid on time</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 border border-slate-100 p-3 space-y-1">
                                <p class="text-[11px] font-semibold text-slate-900">Office – IESCO</p>
                                <p class="text-slate-500">Next bill: 10 Jan</p>
                                <p class="text-amber-600 font-semibold mt-1">Due in 3 days</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 border border-slate-100 p-3 space-y-1">
                                <p class="text-[11px] font-semibold text-slate-900">Gas – SNGPL</p>
                                <p class="text-slate-500">Next bill: 18 Jan</p>
                                <p class="text-rose-600 font-semibold mt-1">Unpaid</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-xs font-semibold text-white shadow-md hover:bg-slate-800 transition">
                        See this dashboard every month with CheckBill.pk
                        <iconify-icon icon="lucide:user-plus" width="14"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Grid (Compact) -->
        <div class="max-w-4xl mx-auto mt-24">
            <h2 class="text-lg font-bold text-center text-slate-900 mb-10">Why use CheckBill.pk?</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-100 hover:shadow-lg hover:shadow-slate-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:printer" width="20"></iconify-icon>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Print Ready PDF</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">Download a high-quality PDF. Accepted at all banks, EasyPaisa, and JazzCash shops.</p>
                </div>
                <!-- Feature 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-100 hover:shadow-lg hover:shadow-slate-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:history" width="20"></iconify-icon>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Save History</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">We automatically save your reference numbers so you don't have to find old bills every month.</p>
                </div>
                <!-- Feature 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-100 hover:shadow-lg hover:shadow-slate-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:calculator" width="20"></iconify-icon>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Bill Calculator</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">Estimate your electricity bill based on units consumed before the official bill arrives.</p>
                </div>
            </div>
            <div class="mt-6 flex flex-col items-center gap-2 text-[11px] text-slate-500">
                <p class="flex flex-wrap items-center justify-center gap-2">
                    <span class="font-semibold text-slate-700">Works with major Pakistan providers:</span>
                    <span>LESCO</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span>IESCO</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span>K-Electric</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span>SNGPL</span>
                </p>
                <p class="text-[10px] text-slate-400">100% free – no CNIC required, just your bill reference number.</p>
            </div>
        </div>

        <!-- Before / After Comparison Strip -->
        <div class="max-w-5xl mx-auto mt-16">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="p-6 rounded-2xl bg-white border border-rose-100 shadow-sm">
                    <div class="inline-flex items-center gap-2 rounded-full bg-rose-50 px-3 py-1 mb-4">
                        <span class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-[11px] font-bold">✕</span>
                        <span class="text-[11px] font-semibold text-rose-700 uppercase tracking-wide">Without CheckBill.pk</span>
                    </div>
                    <ul class="space-y-3 text-xs text-slate-500">
                        <li class="flex gap-2">
                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-rose-300"></span>
                            <span>Every month you search Google again, open different sites, and type your reference number from scratch.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-rose-300"></span>
                            <span>You forget the due date, pay in a rush, and sometimes get hit with late payment surcharge.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-rose-300"></span>
                            <span>No single place to see all your home, office, and shop meters together.</span>
                        </li>
                    </ul>
                </div>

                <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 text-slate-50 shadow-lg shadow-slate-900/30">
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 mb-4">
                        <span class="w-5 h-5 rounded-full bg-emerald-400 text-emerald-900 flex items-center justify-center text-[11px] font-bold">✓</span>
                        <span class="text-[11px] font-semibold text-emerald-200 uppercase tracking-wide">With free CheckBill.pk account</span>
                    </div>
                    <ul class="space-y-3 text-xs text-slate-200">
                        <li class="flex gap-2">
                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                            <span>All your reference numbers saved once – every month you just open your dashboard and click “Check bill”.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                            <span>We email you before the due date so you never worry about late fees again.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                            <span>One clean dashboard for electricity, gas, and internet bills – for your home, office, and family.</span>
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="mt-5 inline-flex items-center gap-2 rounded-full bg-emerald-400 px-4 py-2 text-[11px] font-semibold text-slate-900 hover:bg-emerald-300 transition">
                        Create my free CheckBill.pk account
                        <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mini FAQ (Accordion) -->
        <div class="max-w-5xl mx-auto mt-16 mb-10">
            <div class="rounded-3xl bg-white/80 border border-slate-100 p-6 md:p-8 shadow-[0_16px_40px_-20px_rgba(15,23,42,0.35)]">
                <div class="mb-5">
                    <h2 class="text-base md:text-lg font-bold text-slate-900">Questions Pakistanis usually ask</h2>
                    <p class="text-xs text-slate-500 mt-1">Tap a question to see the answer.</p>
                </div>
                <div class="space-y-2 text-[11px] text-slate-600" id="faq-accordion">
                    <!-- Q1 -->
                    <div class="border border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 text-left faq-toggle" data-faq-id="faq-1">
                            <span class="font-semibold text-slate-900">Is CheckBill.pk free?</span>
                            <span class="ml-3 text-slate-400 faq-icon">−</span>
                        </button>
                        <div class="px-4 pb-3 pt-1 faq-content" id="faq-1">
                            <p>Yes. Checking bills and saving your meters is completely free. No hidden charges.</p>
                        </div>
                    </div>
                    <!-- Q2 -->
                    <div class="border border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 text-left faq-toggle" data-faq-id="faq-2">
                            <span class="font-semibold text-slate-900">Is the data official?</span>
                            <span class="ml-3 text-slate-400 faq-icon">+</span>
                        </button>
                        <div class="px-4 pb-3 pt-1 faq-content hidden" id="faq-2">
                            <p>We fetch your duplicate bill details from the same provider systems used by LESCO, IESCO, K-Electric and SNGPL.</p>
                        </div>
                    </div>
                    <!-- Q3 -->
                    <div class="border border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 text-left faq-toggle" data-faq-id="faq-3">
                            <span class="font-semibold text-slate-900">Is my email and data safe?</span>
                            <span class="ml-3 text-slate-400 faq-icon">+</span>
                        </button>
                        <div class="px-4 pb-3 pt-1 faq-content hidden" id="faq-3">
                            <p>We only use your email to send reminders. We never share your data, and you can delete your account anytime.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-400">© 2024 CheckBill.pk. Made with ❤️ in Pakistan.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-xs font-medium text-slate-500 hover:text-slate-900">Privacy Policy</a>
                <a href="#" class="text-xs font-medium text-slate-500 hover:text-slate-900">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Scripts for Custom Dropdown Logic -->
    <script>
        // Simple logic to handle the custom dropdown selection
        function selectProvider(value, name, initial, colorClass) {
            // Update Hidden Input
            document.getElementById('provider-input').value = value;

            // Update Visual Trigger
            const trigger = document.getElementById('selected-text');
            trigger.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold ${colorClass}">${initial}</div>
                    <span class="text-slate-900 font-semibold">${name}</span>
                </div>
            `;
            trigger.className = "flex items-center gap-3 text-sm text-slate-900";

            // Close Dropdown
            document.querySelector('.custom-select').classList.remove('active');
        }

        // Tab switcher logic (Electricity / Gas / Internet)
        const billTypeInput = document.getElementById('bill-type-input');
        const tabButtons = document.querySelectorAll('[data-bill-tab]');

        function setActiveTab(type) {
            if (billTypeInput) {
                billTypeInput.value = type;
            }

            tabButtons.forEach((btn) => {
                if (btn.dataset.billTab === type) {
                    btn.classList.add('tab-btn-active');
                    btn.classList.remove('tab-btn-inactive');
                } else {
                    btn.classList.remove('tab-btn-active');
                    btn.classList.add('tab-btn-inactive');
                }
            });

            // Show only relevant providers in dropdown
            const providerOptions = document.querySelectorAll('[data-provider-type]');
            providerOptions.forEach((option) => {
                const providerType = option.getAttribute('data-provider-type');
                // For now internet reuses electricity providers visually
                if (type === 'internet') {
                    option.style.display = providerType === 'electricity' ? 'flex' : 'none';
                } else {
                    option.style.display = providerType === type ? 'flex' : 'none';
                }
            });
        }

        tabButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                setActiveTab(btn.dataset.billTab);
            });
        });

        // Initialize default state
        setActiveTab('electricity');

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const select = document.querySelector('.custom-select');
            if (!select.contains(e.target)) {
                select.classList.remove('active');
            }
        });

        // Simple FAQ accordion
        document.querySelectorAll('.faq-toggle').forEach((btn) => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-faq-id');
                const content = document.getElementById(id);
                const icon = btn.querySelector('.faq-icon');

                const isHidden = content.classList.contains('hidden');

                // Close all
                document.querySelectorAll('.faq-content').forEach((el) => el.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach((ic) => ic.textContent = '+');

                // Open clicked one if it was hidden
                if (isHidden) {
                    content.classList.remove('hidden');
                    if (icon) icon.textContent = '−';
                }
            });
        });
    </script>

</body></html>
