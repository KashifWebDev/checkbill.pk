@extends('layouts.app')

@php
    $providerKey = 'iesco';
    $allProviders = config('providers.providers');
    $provider = $allProviders[$providerKey];
    
    $baseUrl = config('app.url');
    $canonicalUrl = $baseUrl . '/' . $provider['slug'];
    
    $title = $provider['name'] . ' Bill Online 2025, Check and Download Duplicate ' . $provider['utility_type_label'] . ' Bill by Reference Number';
    $metaDescription = 'Check your ' . $provider['name'] . ' ' . strtolower($provider['utility_type_label']) . ' bill online by reference number. Download duplicate bill PDF, view due date, avoid late payment surcharge, and save your bill for one click checking next month.';
    
    $isElectricity = $provider['type'] === 'electricity';
    $badgeClasses = 'border-orange-200 bg-orange-50/80 text-orange-700';
    $iconColor = 'text-orange-500';
    $textColor = 'text-orange-600 hover:text-orange-700';
    $focusRing = 'focus:ring-orange-500/30 focus:border-orange-500';
    $buttonGradient = 'from-orange-600 to-amber-600';
    $gradientText = 'from-orange-600 via-amber-600 to-yellow-600';
    $stepBg = 'from-orange-500 to-amber-600';
    $ctaBorder = 'border-orange-400/30';
    $ctaButton = 'bg-orange-500 hover:bg-orange-400';
    $checkboxColor = 'text-orange-600 focus:ring-orange-500 accent-orange-600';
    
    // Get related providers for cross-linking
    $relatedProviders = [];
    foreach ($provider['related_providers'] as $relatedKey) {
        if (isset($allProviders[$relatedKey])) {
            $relatedProviders[] = $allProviders[$relatedKey];
        }
    }
    
    // Build FAQ schema
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'How can I check my IESCO bill online?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'To check your IESCO bill online, select IESCO as the provider on CheckBill.pk, enter your 14 digit reference number from the top right of your bill and click Check duplicate bill.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Where can I find my IESCO reference number?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Your IESCO reference number is printed in the top section of your physical bill, usually labelled as Reference No or Consumer No. It is a 14 digit number often grouped with dashes.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Can I pay my IESCO bill online?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Yes. You can pay your IESCO bill through internet banking, mobile wallets like Easypaisa and JazzCash or through your bank\'s mobile app by entering the reference number.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'What happens if I pay my IESCO bill after the due date?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'If you pay your IESCO bill after the due date, a late payment surcharge is added and the amount payable increases. CheckBill.pk helps you see due dates early so you can avoid this fee.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Is CheckBill.pk an official IESCO website?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'CheckBill.pk is not an official IESCO website. It is a companion tool that helps you manage IESCO and other Pakistani utility bills from one dashboard using official data sources.',
                ],
            ],
        ],
    ];
    
    // Build breadcrumb schema
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $baseUrl . '/',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $provider['hub_name'],
                'item' => $baseUrl . $provider['hub_url'],
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $provider['name'] . ' Bill Online',
                'item' => $canonicalUrl,
            ],
        ],
    ];
@endphp

@section('title', $title)
@section('meta_description', $metaDescription)
@section('canonical', $canonicalUrl)
@section('robots', 'index,follow')

@push('schema')
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12 animate-fade-in-up">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-20 h-20 rounded-2xl bg-white border-2 border-slate-200 flex items-center justify-center p-4 shadow-lg">
                    <img src="{{ asset($provider['image_path']) }}" 
                         alt="{{ $provider['name'] }} {{ strtolower($provider['utility_type_label']) }} bill online, {{ $provider['full_name'] }}" 
                         width="80" 
                         height="80"
                         class="w-full h-full object-contain" 
                         loading="eager">
                </div>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full border {{ $badgeClasses }} backdrop-blur-sm px-4 py-1.5 text-xs font-semibold mb-6 uppercase tracking-wide">
                <iconify-icon icon="lucide:zap" width="14"></iconify-icon>
                {{ $provider['utility_type_label'] }} Provider
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                {{ $provider['name'] }}<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $gradientText }}">{{ strtolower($provider['utility_type_label']) }} bill online</span>
            </h1>
            <p class="text-lg sm:text-xl text-slate-600 mb-4 max-w-2xl mx-auto leading-relaxed">
                Check your {{ $provider['full_name'] }} {{ strtolower($provider['utility_type_label']) }} bill online instantly. Save your reference number once, check every month with one click.
            </p>
        </div>

        <!-- Quick Check Card -->
        <div class="max-w-2xl mx-auto mb-12 md:mb-16 animate-fade-in-up animate-delay-100">
            <div class="bg-white rounded-2xl md:rounded-3xl shadow-2xl border border-slate-100 p-4 sm:p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <iconify-icon icon="lucide:search" width="20" class="{{ $iconColor }}"></iconify-icon>
                    Check Your {{ $provider['name'] }} Bill
                </h2>
                <form action="{{ route('bills.check') }}" method="GET" class="space-y-5">
                    <input type="hidden" name="type" value="{{ $provider['type'] }}">
                    <input type="hidden" name="provider" value="{{ $provider['key'] }}">

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Reference Number</label>
                            <a href="/find-reference-number" class="text-[11px] font-medium {{ $textColor }} hover:underline flex items-center gap-1">
                                <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                Where to find?
                            </a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 group-focus-within:text-orange-500 transition-colors"></iconify-icon>
                            </div>
                            <input type="text" name="reference_number" placeholder="Enter the number printed on your bill" required
                                   class="block w-full bg-slate-50 hover:bg-slate-100 border-2 border-slate-200 rounded-xl py-4 pl-12 pr-4 text-base sm:text-sm font-semibold text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:outline-none focus:ring-2 {{ $focusRing }} transition-all min-h-[48px]">
                        </div>
                        <p class="mt-2 text-xs text-slate-500 flex items-center gap-1">
                            <iconify-icon icon="lucide:info" width="12"></iconify-icon>
                            Typically found near the top of your {{ $provider['full_name'] }} bill, labelled as Reference No, Consumer No or Account ID.
                        </p>
                    </div>

                    @guest
                        <div class="flex items-center gap-2 opacity-60">
                            <input type="checkbox" class="w-4 h-4 rounded border-slate-300 {{ $checkboxColor }} cursor-not-allowed" disabled>
                            <label class="text-xs text-slate-600 select-none">Save this bill for quick access next month</label>
                        </div>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-xs font-semibold {{ $textColor }} group">
                            <iconify-icon icon="lucide:arrow-right" width="12" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                            Create free account to save bills & get email reminders
                        </a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="save-bill" name="save_bill" class="w-4 h-4 rounded border-slate-300 {{ $checkboxColor }} cursor-pointer">
                            <label for="save-bill" class="text-xs text-slate-600 select-none cursor-pointer">Save this bill to my dashboard</label>
                        </div>
                    @endauth

                    <button type="submit" class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r {{ $buttonGradient }} py-4 text-sm font-bold text-white shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-200 active:scale-[0.98] group min-h-[48px]">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Check My {{ $provider['name'] }} Bill
                            <iconify-icon icon="lucide:arrow-right" width="18" class="group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </span>
                    </button>
                </form>
            </div>
            
            <!-- Save This Bill Card -->
            @guest
            <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl p-6 border-2 border-emerald-200 mt-6">
                <h3 class="text-lg font-bold text-slate-900 mb-2 flex items-center gap-2">
                    <iconify-icon icon="lucide:save" width="20" class="text-emerald-600"></iconify-icon>
                    Save this bill for next month
                </h3>
                <p class="text-sm text-slate-700 mb-3">Create a free account and never type this reference number again. Check your IESCO bill every month with one click from your dashboard.</p>
                <p class="text-xs text-slate-600 mb-4 flex items-center gap-1">
                    <iconify-icon icon="lucide:shield-check" width="14" class="text-emerald-600"></iconify-icon>
                    <span>100% free forever • No spam • No credit card required</span>
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('register') }}" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all min-h-[48px]">
                        <iconify-icon icon="lucide:user-plus" width="16"></iconify-icon>
                        Create free account
                    </a>
                    <a href="{{ route('login') }}" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl border-2 border-emerald-200 px-5 py-3 text-sm font-semibold text-emerald-700 hover:bg-emerald-50 transition min-h-[48px]">
                        <iconify-icon icon="lucide:log-in" width="16"></iconify-icon>
                        Login
                    </a>
                </div>
            </div>
            @else
            <div class="bg-gradient-to-br from-slate-50 to-white rounded-2xl p-6 border-2 border-slate-200 mt-6">
                <h3 class="text-lg font-bold text-slate-900 mb-2 flex items-center gap-2">
                    <iconify-icon icon="lucide:save" width="20" class="text-green-600"></iconify-icon>
                    Save to dashboard
                </h3>
                <p class="text-sm text-slate-600 mb-4">Give this connection a nickname and save it for one-click checking next month.</p>
                <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                    <input type="hidden" name="type" value="{{ $provider['type'] }}">
                    <input type="hidden" name="provider" value="{{ $provider['key'] }}">
                    <input type="hidden" name="save" value="1">
                    <div>
                        <input type="text" name="nickname" placeholder="e.g. Home, Office, Parents house" 
                               class="w-full rounded-xl border-2 border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all">
                    </div>
                    <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl transition-all">
                        Save to Dashboard
                    </button>
                </form>
            </div>
            @endguest
        </div>

        <!-- Content Sections -->
        <div class="max-w-4xl mx-auto space-y-12 mb-16">
            <!-- How to check IESCO bill online -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">How to check IESCO bill online</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    To check your IESCO electricity bill online, select IESCO, enter your 14 digit reference number, and click Check duplicate bill. You will see the bill amount, due date, and billing month. If you want faster access next month, save your bill in your dashboard so you can check with one click.
                </p>
            </section>

            <!-- How to download duplicate IESCO bill -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">How to download duplicate IESCO bill</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    If you need a duplicate IESCO bill for payment or record keeping, use the bill lookup form and then download the duplicate bill PDF. A duplicate bill is useful when the original copy is missing or when you need to share the bill with a tenant, employer, or accountant.
                </p>
                <p class="text-sm text-slate-600">
                    Learn more in our guide: <a href="/how-to-download-duplicate-bill" class="font-semibold text-orange-600 hover:text-orange-700 underline">How to download duplicate bill</a>
                </p>
            </section>

            <!-- Where to find IESCO reference number -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">Where to find IESCO reference number</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    Your reference number is printed on the top area of your previous IESCO bill. It is usually labelled Reference No. If you are not sure, open the guide on <a href="/find-reference-number" class="font-semibold text-orange-600 hover:text-orange-700 underline">how to find reference number on utility bills</a> and follow the highlighted examples.
                </p>
            </section>

            <!-- IESCO coverage area -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">IESCO coverage area</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    IESCO generally serves {{ implode(', ', $provider['coverage_area']) }}. If your bill is from another region such as Lahore or Multan, use the <a href="/lesco-bill-online" class="font-semibold text-orange-600 hover:text-orange-700 underline">LESCO bill page</a> or <a href="/mepco-bill-online" class="font-semibold text-orange-600 hover:text-orange-700 underline">MEPCO page</a> instead.
                </p>
            </section>

            <!-- IESCO vs other electricity companies -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">IESCO vs other electricity companies</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    IESCO serves the Islamabad and Rawalpindi region. If you live in Lahore, you'll need <a href="/lesco-bill-online" class="font-semibold text-orange-600 hover:text-orange-700 underline">LESCO duplicate bill</a>. For Multan region, check <a href="/mepco-bill-online" class="font-semibold text-orange-600 hover:text-orange-700 underline">MEPCO electricity bill online</a>. Karachi residents use <a href="/k-electric-bill-online" class="font-semibold text-orange-600 hover:text-orange-700 underline">K Electric bill online</a>.
                </p>
            </section>

            <!-- IESCO due date and late payment surcharge -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">IESCO due date and late payment surcharge</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    Your bill shows a due date and an amount payable within due date. If you pay after the due date, late payment surcharge may apply. Checking your due date early helps you avoid extra charges and prevents service issues.
                </p>
                <p class="text-sm text-slate-600">
                    Learn more: <a href="/how-to-pay-electricity-bill-online-pakistan" class="font-semibold text-orange-600 hover:text-orange-700 underline">How to pay electricity bill online in Pakistan</a>
                </p>
            </section>

            <!-- Understanding your electricity bill -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6">Understanding your electricity bill</h2>
                <div class="space-y-3">
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-units">
                            <span class="font-semibold text-slate-900">Units and meter reading</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-units">
                            Units drive your electricity bill cost and depend on your consumption. The meter reading shows how many units you've used since the last bill. Higher consumption means more units and a higher bill amount.
                        </div>
                    </div>
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-taxes">
                            <span class="font-semibold text-slate-900">Taxes and adjustments</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-taxes">
                            Your bill includes fuel adjustment charges and taxes. These are government-mandated charges that vary based on fuel costs and tax rates. They are added to your base electricity charges.
                        </div>
                    </div>
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-due-date">
                            <span class="font-semibold text-slate-900">Within due date vs after due date</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-due-date">
                            The "within due date" amount is what you pay if you pay on time. The "after due date" amount includes late payment surcharge. Paying early helps you avoid the extra charges.
                        </div>
                    </div>
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-peak">
                            <span class="font-semibold text-slate-900">Peak hours</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-peak">
                            Some electricity providers charge different rates during peak hours (usually evening hours when demand is highest). Check your bill to see if peak hour charges apply to your connection.
                        </div>
                    </div>
                </div>
            </section>

            <!-- IESCO bill online kaise check karein -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">IESCO bill online kaise check karein</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    IESCO bill online check karne ke liye IESCO select karein, apna reference number enter karein aur Check duplicate bill button par click karein. Aap ko bill amount, due date aur billing month nazar aa jaye ga. Agar reference number yaad nahi to purane bill ke top area par Reference No dekhein. IESCO duplicate bill download bhi isi tarah ho jata hai. Bohat log search karte hain iesco bil online check, iesco duplicate bill download, aur iesco bill reference number kahan hota hai. IESCO bill check by reference number se aap apna bill amount aur due date dekh sakte hain. IESCO bill due date kaise check karein? Bill check karne ke baad due date aap ko bill details mein dikhai dega.
                </p>
            </section>
        </div>

        @if(count($relatedProviders) > 0)
        <!-- Related Providers Section -->
        <div class="max-w-6xl mx-auto mb-16">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">Other {{ $provider['utility_type_label'] }} Providers</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Check bills from other {{ strtolower($provider['utility_type_label']) }} companies across Pakistan</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($relatedProviders as $related)
                <a href="/{{ $related['slug'] }}" class="group bg-white rounded-2xl p-5 border-2 border-slate-100 hover:border-orange-300 hover:shadow-xl transition-all duration-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center p-3 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                            <img src="{{ asset($related['image_path']) }}" 
                                 alt="{{ $related['name'] }} {{ strtolower($related['utility_type_label']) }} bill online" 
                                 width="64" 
                                 height="64"
                                 class="w-full h-full object-contain" 
                                 loading="lazy">
                        </div>
                        <h3 class="text-base font-bold text-slate-900 mb-1">{{ $related['name'] }}</h3>
                        <p class="text-xs text-slate-500 mb-2 line-clamp-2">{{ $related['full_name'] }}</p>
                        <p class="text-[10px] font-semibold text-orange-600">{{ implode(', ', array_slice($related['coverage_area'], 0, 2)) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Internal Links Section -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="bg-slate-50 rounded-2xl p-6 border-2 border-slate-200">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Helpful guides</h3>
                <div class="grid sm:grid-cols-2 gap-3 text-sm">
                    <a href="/find-reference-number" class="text-orange-600 hover:text-orange-700 font-medium hover:underline">How to find reference number</a>
                    <a href="/how-to-download-duplicate-bill" class="text-orange-600 hover:text-orange-700 font-medium hover:underline">How to download duplicate bill</a>
                    <a href="/how-to-pay-electricity-bill-online-pakistan" class="text-orange-600 hover:text-orange-700 font-medium hover:underline">How to pay electricity bill online</a>
                    <a href="/electricity-bill-calculator-pakistan" class="text-orange-600 hover:text-orange-700 font-medium hover:underline">Electricity bill calculator</a>
                    <a href="{{ $provider['hub_url'] }}" class="text-orange-600 hover:text-orange-700 font-medium hover:underline">All {{ strtolower($provider['utility_type_label']) }} providers</a>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        @guest
        <div class="max-w-4xl mx-auto text-center mb-12">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 md:p-12 border-2 {{ $ctaBorder }} shadow-2xl">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4">Save this {{ $provider['name'] }} meter for next month</h2>
                <p class="text-base sm:text-lg text-slate-300 mb-6 max-w-xl mx-auto">
                    Create a free account to save your reference number and check bills every month with one click. Never miss a due date again.
                </p>
                <p class="text-xs text-slate-400 mb-6">100% free forever • No spam • No credit card required</p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-3 rounded-full {{ $ctaButton }} px-6 md:px-8 py-3 md:py-4 text-sm md:text-base font-bold text-white transition shadow-xl hover:scale-105 min-h-[48px]">
                    <iconify-icon icon="lucide:user-plus" width="20"></iconify-icon>
                    Create Your Free Account
                </a>
            </div>
        </div>
        @endguest
    </div>
@endsection

@section('scripts')
<script>
    // Accordion functionality
    document.querySelectorAll('.accordion-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.accordion;
            const content = document.getElementById(targetId);
            const icon = button.querySelector('.accordion-icon');
            
            const isHidden = content.classList.contains('hidden');
            
            // Close all accordions
            document.querySelectorAll('.accordion-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.accordion-icon').forEach(ic => {
                ic.style.transform = 'rotate(0deg)';
            });
            
            if (isHidden) {
                content.classList.remove('hidden');
                if (icon) icon.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>
@endsection
