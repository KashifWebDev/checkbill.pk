@extends('layouts.app')

@section('title', 'CheckBill.pk 2025 - Instant Duplicate Bill Checker for Pakistan')
@section('meta_description', 'Check electricity, gas and internet bills online in Pakistan by reference number. IESCO, LESCO, KE, SNGPL, SSGC, PTCL. Download duplicate bills, save meters, get reminders. 100% free.')
@section('canonical', config('app.url') . '/')

@php
    $baseUrl = config('app.url');
    $allProviders = config('providers.providers');
    $providers = collect($allProviders)
        ->map(function ($provider) {
            $routeName = 'providers.' . ($provider['key'] === 'ke' ? 'kelectric' : $provider['key']);
            return [
                'key' => $provider['key'],
                'label' => $provider['name'],
                'name' => $provider['full_name'],
                'type' => $provider['type'],
                'route' => route($routeName),
                'tagline' => implode(', ', array_slice($provider['coverage_area'], 0, 2)),
                'logo' => asset($provider['image_path']),
            ];
        })
        ->values()
        ->toArray();
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => $baseUrl . '/',
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        [
            '@type' => 'Question',
            'name' => 'Is CheckBill.pk really free?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Yes, completely free. Checking bills, saving reference numbers, and getting reminders costs nothing. No hidden charges, no premium tiers.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Is the bill data official and accurate?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'We fetch duplicate bill data directly from the same official provider systems used by LESCO, IESCO, K-Electric, SNGPL, and other companies. The bills are identical to what you\'d get from their official websites.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Is my data safe and private?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'We only use your email to send bill reminders. We never share your data with third parties, and you can delete your account and all saved bills anytime from your dashboard.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Do I need to create an account to check bills?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'No, you can check bills without an account. However, creating a free account lets you save reference numbers, get email reminders, and access your bill history from one dashboard.',
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')

        <!-- Hero Section -->
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12 animate-fade-in-up">
                <!-- Trust Badge -->
                <div class="inline-flex items-center gap-2 rounded-full border border-green-200 bg-green-50/80 backdrop-blur-sm px-4 py-1.5 text-xs font-semibold text-green-700 mb-6 uppercase tracking-wide">
                    <iconify-icon icon="lucide:shield-check" width="14"></iconify-icon>
                    Official Provider Data • 100% Free
                </div>

                <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                    Stop searching.<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600">Start checking.</span>
                </h1>

                <p class="text-lg sm:text-xl text-slate-600 mb-4 max-w-2xl mx-auto leading-relaxed">
                    Your electricity, gas, and internet bills in one place. Check duplicate bills instantly, get reminders, and never miss a due date.
                </p>
                <p class="text-sm text-slate-500 mb-8 max-w-xl mx-auto">
                    ہر مہینے بل ڈھونڈنے کی پریشانی ختم کریں – ایک ہی جگہ سے گھر، دفتر اور گیس کے سب بل چیک کریں
                </p>
            </div>

            <!-- Main Bill Checker Card -->
            <div id="app" class="max-w-2xl mx-auto mb-16 animate-fade-in-up animate-delay-100">
                <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 z-10">
                    <!-- Tab Switcher -->
                    <div class="flex p-1.5 bg-slate-50 rounded-2xl mb-6 border border-slate-100">
                        <button type="button" data-bill-tab="electricity" id="tab-electricity" class="flex-1 py-3 text-sm tab-btn-active transition-all flex items-center justify-center gap-2">
                            <iconify-icon icon="lucide:zap" width="16" class="text-orange-500"></iconify-icon>
                            Electricity
                        </button>
                        <button type="button" data-bill-tab="gas" id="tab-gas" class="flex-1 py-3 text-sm tab-btn-inactive transition-all flex items-center justify-center gap-2">
                            <iconify-icon icon="lucide:flame" width="16"></iconify-icon>
                            Gas
                        </button>
                        <button type="button" data-bill-tab="internet" id="tab-internet" class="flex-1 py-3 text-sm tab-btn-inactive transition-all flex items-center justify-center gap-2">
                            <iconify-icon icon="lucide:wifi" width="16"></iconify-icon>
                            Internet
                        </button>
                    </div>

                    <form action="{{ route('bills.check') }}" method="GET" class="space-y-5">
                        <!-- Provider Dropdown -->
                        <div class="relative z-50">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Select Provider</label>
                            <input type="hidden" name="provider" id="provider-input" required>
                            <input type="hidden" name="type" id="bill-type-input" value="electricity">

                            <div class="custom-select relative">
                                <button type="button" onclick="this.parentElement.classList.toggle('active')" class="w-full text-left bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl px-4 py-4 flex items-center justify-between transition-all focus:ring-2 focus:ring-green-500/30 focus:border-green-500 group">
                                    <span id="selected-text" class="flex items-center gap-3 text-sm font-medium text-slate-500">
                                        <span class="w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center">
                                            <iconify-icon icon="lucide:search" width="14" class="text-slate-400"></iconify-icon>
                                        </span>
                                        Search for your provider (e.g., LESCO, IESCO, SNGPL)
                                    </span>
                                    <iconify-icon icon="lucide:chevron-down" width="18" class="text-slate-400 group-focus:text-green-600 transition-colors"></iconify-icon>
                                </button>

                                <div class="custom-select-options absolute top-full left-0 right-0 mt-2 bg-white border-2 border-slate-100 rounded-2xl shadow-2xl py-3 z-50 max-h-[400px] overflow-y-auto">
                                    @php
                                        $groups = ['electricity' => 'Electricity Providers', 'gas' => 'Gas Providers', 'internet' => 'Internet Providers'];
                                    @endphp

                                    @foreach ($groups as $type => $heading)
                                        @php $outerLoop = $loop; @endphp
                                        <div class="px-4 py-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider sticky top-0 bg-white border-b border-slate-100">{{ $heading }}</div>

                                        @foreach ($providers as $provider)
                                            @if ($provider['type'] === $type)
                                                <div
                                                    data-provider-type="{{ $provider['type'] }}"
                                                    data-provider-key="{{ $provider['key'] }}"
                                                    data-provider-name="{{ $provider['label'] }}"
                                                    data-provider-logo="{{ $provider['logo'] }}"
                                                    class="px-4 py-3 mx-2 rounded-xl hover:bg-slate-50 cursor-pointer flex items-center justify-between group transition-colors"
                                                    onclick="selectProvider(this)">
                                                    <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center p-2 shadow-sm">
                                                        <img src="{{ $provider['logo'] }}" 
                                                             alt="{{ $provider['label'] }} {{ strtolower($provider['type']) }} bill online, {{ $provider['name'] }}" 
                                                             width="40" 
                                                             height="40"
                                                             class="w-full h-full object-contain" 
                                                             loading="lazy">
                                                    </div>
                                                        <div>
                                                            <div class="text-sm font-semibold text-slate-900">{{ $provider['label'] }}</div>
                                                            <div class="text-[11px] text-slate-500">{{ $provider['name'] }}</div>
                                                        </div>
                                                    </div>
                                                    <span class="text-[10px] font-semibold uppercase text-slate-400 px-2 py-1 rounded-full bg-slate-100">{{ ucfirst($provider['type']) }}</span>
                                                </div>
                                            @endif
                                        @endforeach

                                        @if (!$outerLoop->last)
                                            <div class="border-t border-slate-100 my-2"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Reference Number Input -->
                        <div class="relative z-10">
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Reference Number</label>
                                <a href="/find-reference-number" class="text-[11px] font-medium text-green-600 hover:text-green-700 hover:underline flex items-center gap-1">
                                    <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                    Where to find?
                                </a>
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 group-focus-within:text-green-500 transition-colors"></iconify-icon>
                                </div>
                                <input type="tel" name="reference_number" placeholder="Enter your 14-digit reference number" class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all">
                            </div>
                        </div>

                        <!-- Save Bill Toggle -->
                        <div class="flex flex-col gap-2">
                            @guest
                                <div class="flex items-center gap-2 opacity-60">
                                    <input type="checkbox" id="save-bill" class="w-4 h-4 rounded border-slate-300 text-green-600 cursor-not-allowed" disabled>
                                    <label for="save-bill" class="text-xs text-slate-600 select-none">Save this bill for quick access next month</label>
                                </div>
                                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-green-700 hover:text-green-800 group">
                                    <iconify-icon icon="lucide:arrow-right" width="12" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                                    Create free account to save bills & get email reminders
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
                        <button type="submit" class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 py-4 text-sm font-bold text-white shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                Check My Bill Now
                                <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                            </span>
                        </button>
                    </form>

                    <!-- Social Proof -->
                    <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-center gap-4">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-gradient-to-br from-blue-400 to-blue-600"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-gradient-to-br from-green-400 to-green-600"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-[10px] text-white font-bold">+2k</div>
                        </div>
                        <p class="text-xs font-medium text-slate-600">
                            Used by <span class="text-slate-900 font-bold">10,000+</span> people this month
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works - Animated Workflow -->
        <div class="max-w-6xl mx-auto mb-20">
            <div class="text-center mb-12 animate-fade-in-up animate-delay-200">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">How it works</h2>
                <p class="text-slate-600 max-w-xl mx-auto">Three simple steps to check any bill in Pakistan</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <!-- Step 1 -->
                <div class="workflow-step active bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-200 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Select Your Provider</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Choose from 16+ electricity, gas, and internet providers across Pakistan</p>
                    <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <iconify-icon icon="lucide:clock" width="14"></iconify-icon>
                        <span>5 seconds</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="workflow-step active bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-200 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Enter Reference Number</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Type your 14-digit reference number from your previous bill</p>
                    <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <iconify-icon icon="lucide:clock" width="14"></iconify-icon>
                        <span>10 seconds</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="workflow-step active bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-200 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Get Your Bill</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">View, download PDF, or save to your dashboard for next month</p>
                    <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <iconify-icon icon="lucide:clock" width="14"></iconify-icon>
                        <span>Instant</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Dashboard Preview -->
        <div class="max-w-6xl mx-auto mb-20">
            <div class="text-center mb-12 animate-fade-in-up animate-delay-300">
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-200 px-4 py-1.5 text-xs font-semibold text-emerald-700 mb-4">
                    <iconify-icon icon="lucide:sparkles" width="14"></iconify-icon>
                    Free Account Feature
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Your bills, organized</h2>
                <p class="text-slate-600 max-w-xl mx-auto">Save once, check monthly with one click. Never search for reference numbers again.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl border-2 border-slate-100 p-8 overflow-hidden">
                <!-- Dashboard Header -->
                <div class="flex items-center justify-between mb-6 pb-6 border-b border-slate-100">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Your Dashboard</h3>
                        <p class="text-sm text-slate-500 mt-1">All your bills in one place</p>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 border border-green-200">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse-slow"></span>
                        <span class="text-xs font-semibold text-green-700">Live</span>
                    </div>
                </div>

                <!-- Animated Bill Cards -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Card 1 - Home LESCO -->
                    <div class="dashboard-card bg-gradient-to-br from-slate-50 to-white rounded-2xl p-5 border-2 border-slate-100">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center">
                                        <iconify-icon icon="lucide:zap" width="16" class="text-orange-600"></iconify-icon>
                                    </div>
                                    <span class="text-xs font-semibold text-slate-900">Home</span>
                                </div>
                                <p class="text-sm font-bold text-slate-900">LESCO</p>
                                <p class="text-[11px] text-slate-500 mt-1">Ref: 12345678901234</p>
                            </div>
                        </div>
                        <div class="space-y-2 mt-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-500">Last checked</span>
                                <span class="font-semibold text-slate-700">2 days ago</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-500">Status</span>
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-[10px]">Paid</span>
                            </div>
                            <button class="w-full mt-3 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-slate-800 transition">
                                Check Now
                            </button>
                        </div>
                    </div>

                    <!-- Card 2 - Office IESCO -->
                    <div class="dashboard-card bg-gradient-to-br from-slate-50 to-white rounded-2xl p-5 border-2 border-amber-200">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <iconify-icon icon="lucide:zap" width="16" class="text-blue-600"></iconify-icon>
                                    </div>
                                    <span class="text-xs font-semibold text-slate-900">Office</span>
                                </div>
                                <p class="text-sm font-bold text-slate-900">IESCO</p>
                                <p class="text-[11px] text-slate-500 mt-1">Ref: 98765432109876</p>
                            </div>
                        </div>
                        <div class="space-y-2 mt-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-500">Due date</span>
                                <span class="font-semibold text-amber-700">In 3 days</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-500">Status</span>
                                <span class="px-2 py-1 rounded-full bg-amber-100 text-amber-700 font-semibold text-[10px]">Due Soon</span>
                            </div>
                            <button class="w-full mt-3 py-2 rounded-xl bg-amber-600 text-white text-xs font-semibold hover:bg-amber-700 transition">
                                Check Now
                            </button>
                        </div>
                    </div>

                    <!-- Card 3 - Gas SNGPL -->
                    <div class="dashboard-card bg-gradient-to-br from-slate-50 to-white rounded-2xl p-5 border-2 border-slate-100">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                                        <iconify-icon icon="lucide:flame" width="16" class="text-red-600"></iconify-icon>
                                    </div>
                                    <span class="text-xs font-semibold text-slate-900">Gas</span>
                                </div>
                                <p class="text-sm font-bold text-slate-900">SNGPL</p>
                                <p class="text-[11px] text-slate-500 mt-1">Ref: 55556666777788</p>
                            </div>
                        </div>
                        <div class="space-y-2 mt-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-500">Last checked</span>
                                <span class="font-semibold text-slate-700">1 week ago</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-500">Status</span>
                                <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700 font-semibold text-[10px]">Pending</span>
                            </div>
                            <button class="w-full mt-3 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-slate-800 transition">
                                Check Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CTA Below Dashboard -->
                <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                    <p class="text-sm text-slate-600 mb-4">Save your reference numbers once, check bills every month with one click</p>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                            <iconify-icon icon="lucide:user-plus" width="16"></iconify-icon>
                            Create Free Account
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                            <iconify-icon icon="lucide:layout-dashboard" width="16"></iconify-icon>
                            Go to Dashboard
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Key Features -->
        <div class="max-w-6xl mx-auto mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Everything you need</h2>
                <p class="text-slate-600 max-w-xl mx-auto">Features that make bill management effortless</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-200 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:file-text" width="24"></iconify-icon>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Print-Ready PDFs</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Download high-quality duplicate bills accepted at all banks, EasyPaisa, and JazzCash counters.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-200 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 text-white flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:bell" width="24"></iconify-icon>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Smart Reminders</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Get email reminders before due dates. Never pay late fees again.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-200 hover:shadow-xl transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 text-white flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:history" width="24"></iconify-icon>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Bill History</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">All your saved bills in one dashboard. Check any bill with a single click.</p>
                </div>
            </div>
        </div>

        <!-- Problem vs Solution -->
        <div class="max-w-6xl mx-auto mb-20">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Without CheckBill.pk -->
                <div class="bg-white rounded-3xl p-8 border-2 border-rose-100 shadow-lg">
                    <div class="inline-flex items-center gap-2 rounded-full bg-rose-50 px-4 py-2 mb-6">
                        <iconify-icon icon="lucide:x-circle" width="18" class="text-rose-600"></iconify-icon>
                        <span class="text-sm font-semibold text-rose-700">The Old Way</span>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex gap-3 items-start">
                            <span class="mt-1 w-2 h-2 rounded-full bg-rose-400 flex-shrink-0"></span>
                            <span class="text-sm text-slate-700">Search Google every month, open different websites, type reference numbers from scratch</span>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="mt-1 w-2 h-2 rounded-full bg-rose-400 flex-shrink-0"></span>
                            <span class="text-sm text-slate-700">Forget due dates, pay in a rush, get hit with late payment charges</span>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="mt-1 w-2 h-2 rounded-full bg-rose-400 flex-shrink-0"></span>
                            <span class="text-sm text-slate-700">No single place to manage home, office, and shop bills together</span>
                        </li>
                    </ul>
                </div>

                <!-- With CheckBill.pk -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 border-2 border-emerald-400 shadow-2xl text-white">
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-4 py-2 mb-6 border border-emerald-400/30">
                        <iconify-icon icon="lucide:check-circle-2" width="18" class="text-emerald-400"></iconify-icon>
                        <span class="text-sm font-semibold text-emerald-300">With CheckBill.pk</span>
                    </div>
                    <ul class="space-y-4 mb-6">
                        <li class="flex gap-3 items-start">
                            <span class="mt-1 w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0"></span>
                            <span class="text-sm text-slate-100">Save reference numbers once – check bills every month with one click from your dashboard</span>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="mt-1 w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0"></span>
                            <span class="text-sm text-slate-100">Get email reminders before due dates. Never worry about late fees again</span>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="mt-1 w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0"></span>
                            <span class="text-sm text-slate-100">One clean dashboard for all your electricity, gas, and internet bills</span>
                        </li>
                    </ul>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-900 hover:bg-emerald-400 transition shadow-lg">
                            Start Free Today
                            <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Supported Providers -->
        <div class="max-w-6xl mx-auto mb-20">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-200 px-3 py-1 mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse-slow"></span>
                        <span class="text-xs font-semibold text-emerald-700">{{ count($providers) }} Providers Live</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-2">All major providers supported</h2>
                    <p class="text-slate-600">Electricity, gas, and internet providers across Pakistan</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($providers as $provider)
                    <a href="{{ $provider['route'] }}" class="group p-5 rounded-2xl bg-white border-2 border-slate-100 hover:border-green-300 hover:shadow-xl transition-all duration-200">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center p-3 shadow-sm group-hover:scale-110 transition-transform">
                                <img src="{{ $provider['logo'] }}" 
                                     alt="{{ $provider['label'] }} {{ strtolower($provider['type']) }} bill online, {{ $provider['name'] }}" 
                                     width="56" 
                                     height="56"
                                     class="w-full h-full object-contain" 
                                     loading="lazy">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ $provider['label'] }}</p>
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-semibold uppercase flex-shrink-0">{{ $provider['type'] }}</span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-snug line-clamp-2">{{ $provider['name'] }}</p>
                                <p class="text-[10px] text-emerald-600 font-semibold mt-1">{{ $provider['tagline'] }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="bg-white rounded-3xl border-2 border-slate-100 p-8 shadow-xl">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">Common questions</h2>
                    <p class="text-sm text-slate-500">Everything you need to know about CheckBill.pk</p>
                </div>
                <div class="space-y-3" id="faq-accordion">
                    <!-- Q1 -->
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden hover:border-slate-200 transition-colors">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left faq-toggle transition-colors" data-faq-id="faq-1">
                            <span class="font-semibold text-slate-900">Is CheckBill.pk really free?</span>
                            <span class="ml-3 text-slate-400 faq-icon text-xl">+</span>
                        </button>
                        <div class="px-5 pb-4 pt-2 faq-content text-sm text-slate-600" id="faq-1">
                            Yes, completely free. Checking bills, saving reference numbers, and getting reminders costs nothing. No hidden charges, no premium tiers.
                        </div>
                    </div>
                    <!-- Q2 -->
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden hover:border-slate-200 transition-colors">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left faq-toggle transition-colors" data-faq-id="faq-2">
                            <span class="font-semibold text-slate-900">Is the bill data official and accurate?</span>
                            <span class="ml-3 text-slate-400 faq-icon text-xl">+</span>
                        </button>
                        <div class="px-5 pb-4 pt-2 faq-content hidden text-sm text-slate-600" id="faq-2">
                            We fetch duplicate bill data directly from the same official provider systems used by LESCO, IESCO, K-Electric, SNGPL, and other companies. The bills are identical to what you'd get from their official websites.
                        </div>
                    </div>
                    <!-- Q3 -->
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden hover:border-slate-200 transition-colors">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left faq-toggle transition-colors" data-faq-id="faq-3">
                            <span class="font-semibold text-slate-900">Is my data safe and private?</span>
                            <span class="ml-3 text-slate-400 faq-icon text-xl">+</span>
                        </button>
                        <div class="px-5 pb-4 pt-2 faq-content hidden text-sm text-slate-600" id="faq-3">
                            We only use your email to send bill reminders. We never share your data with third parties, and you can delete your account and all saved bills anytime from your dashboard.
                        </div>
                    </div>
                    <!-- Q4 -->
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden hover:border-slate-200 transition-colors">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left faq-toggle transition-colors" data-faq-id="faq-4">
                            <span class="font-semibold text-slate-900">Do I need to create an account to check bills?</span>
                            <span class="ml-3 text-slate-400 faq-icon text-xl">+</span>
                        </button>
                        <div class="px-5 pb-4 pt-2 faq-content hidden text-sm text-slate-600" id="faq-4">
                            No, you can check bills without an account. However, creating a free account lets you save reference numbers, get email reminders, and access your bill history from one dashboard.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final CTA -->
        <div class="max-w-4xl mx-auto text-center mb-12">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-12 border-2 border-emerald-400/30 shadow-2xl">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Ready to simplify your bill management?</h2>
                <p class="text-lg text-slate-300 mb-8 max-w-xl mx-auto">
                    Join thousands of Pakistanis who check their bills faster and never miss a due date
                </p>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-3 rounded-full bg-emerald-500 px-8 py-4 text-base font-bold text-slate-900 hover:bg-emerald-400 transition shadow-xl hover:scale-105">
                        <iconify-icon icon="lucide:user-plus" width="20"></iconify-icon>
                        Create Your Free Account
                    </a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3 rounded-full bg-emerald-500 px-8 py-4 text-base font-bold text-slate-900 hover:bg-emerald-400 transition shadow-xl hover:scale-105">
                        <iconify-icon icon="lucide:layout-dashboard" width="20"></iconify-icon>
                        Go to Dashboard
                    </a>
                @endauth
            </div>
        </div>
@endsection

@section('scripts')
    <script>
        // Provider selection
        function selectProvider(optionElement) {
            const providerKey = optionElement.dataset.providerKey;
            const name = optionElement.dataset.providerName;
            const type = optionElement.dataset.providerType;
            const logo = optionElement.dataset.providerLogo;
            const typeLabel = type.charAt(0).toUpperCase() + type.slice(1);

            document.getElementById('provider-input').value = providerKey;
            document.getElementById('bill-type-input').value = type;

            const trigger = document.getElementById('selected-text');
            trigger.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center p-1.5 shadow-sm">
                        <img src="${logo}" alt="${name} ${typeLabel.toLowerCase()} bill online" width="32" height="32" class="w-full h-full object-contain" />
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="text-slate-900 font-semibold">${name}</span>
                        <span class="text-[10px] text-slate-500 uppercase">${typeLabel}</span>
                    </div>
                </div>
            `;
            trigger.className = "flex items-center gap-3 text-sm text-slate-900";

            document.querySelector('.custom-select').classList.remove('active');
        }

        // Tab switcher
        const billTypeInput = document.getElementById('bill-type-input');
        const tabButtons = document.querySelectorAll('[data-bill-tab]');
        const selectedText = document.getElementById('selected-text');
        const providerInput = document.getElementById('provider-input');
        const defaultSelectedMarkup = selectedText ? selectedText.innerHTML : '';

        function setActiveTab(type) {
            billTypeInput.value = type;

            tabButtons.forEach((btn) => {
                if (btn.dataset.billTab === type) {
                    btn.classList.add('tab-btn-active');
                    btn.classList.remove('tab-btn-inactive');
                } else {
                    btn.classList.remove('tab-btn-active');
                    btn.classList.add('tab-btn-inactive');
                }
            });

            const providerOptions = document.querySelectorAll('[data-provider-type]');
            providerOptions.forEach((option) => {
                const providerType = option.getAttribute('data-provider-type');
                option.style.display = providerType === type ? 'flex' : 'none';
            });

            if (providerInput && providerInput.value) {
                const selectedOption = document.querySelector(`[data-provider-key="${providerInput.value}"]`);
                if (!selectedOption || selectedOption.getAttribute('data-provider-type') !== type) {
                    providerInput.value = '';
                    if (selectedText) {
                        selectedText.innerHTML = defaultSelectedMarkup;
                        selectedText.className = 'flex items-center gap-3 text-sm font-medium text-slate-500';
                    }
                }
            }
        }

        tabButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                setActiveTab(btn.dataset.billTab);
            });
        });

        setActiveTab('electricity');

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            const select = document.querySelector('.custom-select');
            if (select && !select.contains(e.target)) {
                select.classList.remove('active');
            }
        });

        // FAQ accordion
        document.querySelectorAll('.faq-toggle').forEach((btn) => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-faq-id');
                const content = document.getElementById(id);
                const icon = btn.querySelector('.faq-icon');

                const isHidden = content.classList.contains('hidden');

                document.querySelectorAll('.faq-content').forEach((el) => el.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach((ic) => ic.textContent = '+');

                if (isHidden) {
                    content.classList.remove('hidden');
                    if (icon) icon.textContent = '−';
                }
            });
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.workflow-step').forEach(el => observer.observe(el));
    </script>
@endsection
