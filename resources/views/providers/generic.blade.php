@extends('layouts.app')

@php
    $providerKey = $provider['key'];
    $allProviders = config('providers.providers');

    $baseUrl = config('app.url');
    $canonicalUrl = $baseUrl . '/' . $provider['slug'];

    $title = $provider['name'] . ' Bill Online 2025, Check and Download Duplicate ' . $provider['utility_type_label'] . ' Bill by Reference Number';
    $metaDescription = 'Check your ' . $provider['name'] . ' ' . strtolower($provider['utility_type_label']) . ' bill online by reference number. Download duplicate bill PDF, view due date, avoid late payment surcharge, and save your bill for one click checking next month.';

    $isElectricity = $provider['type'] === 'electricity';
    $isGas = $provider['type'] === 'gas';
    $isInternet = $provider['type'] === 'internet';

    $badgeClasses = $isElectricity ? 'border-orange-200 bg-orange-50/80 text-orange-700' : ($isGas ? 'border-red-200 bg-red-50/80 text-red-700' : 'border-blue-200 bg-blue-50/80 text-blue-700');
    $iconColor = $isElectricity ? 'text-orange-500' : ($isGas ? 'text-red-500' : 'text-blue-500');
    $textColor = $isElectricity ? 'text-orange-600 hover:text-orange-700' : ($isGas ? 'text-red-600 hover:text-red-700' : 'text-blue-600 hover:text-blue-700');
    $focusRing = $isElectricity ? 'focus:ring-orange-500/30 focus:border-orange-500' : ($isGas ? 'focus:ring-red-500/30 focus:border-red-500' : 'focus:ring-blue-500/30 focus:border-blue-500');
    $buttonGradient = $isElectricity ? 'from-orange-600 to-amber-600' : ($isGas ? 'from-red-600 to-rose-600' : 'from-blue-600 to-indigo-600');
    $gradientText = $isElectricity ? 'from-orange-600 via-amber-600 to-yellow-600' : ($isGas ? 'from-red-600 via-rose-600 to-pink-600' : 'from-blue-600 via-indigo-600 to-purple-600');
    $stepBg = $isElectricity ? 'from-orange-500 to-amber-600' : ($isGas ? 'from-red-500 to-rose-600' : 'from-blue-500 to-indigo-600');
    $ctaBorder = $isElectricity ? 'border-orange-400/30' : ($isGas ? 'border-red-400/30' : 'border-blue-400/30');
    $ctaButton = $isElectricity ? 'bg-orange-500 hover:bg-orange-400' : ($isGas ? 'bg-red-500 hover:bg-red-400' : 'bg-blue-500 hover:bg-blue-400');
    $checkboxColor = $isElectricity ? 'text-orange-600 focus:ring-orange-500 accent-orange-600' : ($isGas ? 'text-red-600 focus:ring-red-500 accent-red-600' : 'text-blue-600 focus:ring-blue-500 accent-blue-600');

    // Get related providers for cross-linking
    $relatedProviders = [];
    if (isset($provider['related_providers'])) {
        foreach ($provider['related_providers'] as $relatedKey) {
            if (isset($allProviders[$relatedKey])) {
                $relatedProviders[] = $allProviders[$relatedKey];
            }
        }
    }

    // Utility type specific guides
    $payGuideUrl = $isElectricity ? '/blog/how-to-pay-electricity-bill-online-pakistan' : ($isGas ? '/blog/how-to-pay-gas-bill-online-pakistan' : '#');
    $calculatorUrl = $isElectricity ? '/blog/electricity-bill-calculator-pakistan' : ($isGas ? '/blog/gas-bill-calculator-pakistan' : '#');
@endphp

@section('title', $title)
@section('meta_description', $metaDescription)
@section('canonical', $canonicalUrl)
@section('robots', 'index,follow')

@push('schema')
@php
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'How can I check my ' . $provider['name'] . ' bill online?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'To check your ' . $provider['name'] . ' ' . strtolower($provider['utility_type_label']) . ' bill online, select ' . $provider['name'] . ' as the provider on CheckBill.pk, enter your reference number and click Check duplicate bill. You will see the bill amount, due date, and billing month.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Where can I find my ' . $provider['name'] . ' reference number?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Your ' . $provider['name'] . ' reference number is printed in the top section of your physical bill, usually labelled as Reference No or Consumer No. It is typically a 14 digit number often grouped with dashes.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Can I pay my ' . $provider['name'] . ' bill online?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Yes. You can pay your ' . $provider['name'] . ' bill through internet banking, mobile wallets like Easypaisa and JazzCash or through your bank\'s mobile app by entering the reference number.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'What happens if I pay my ' . $provider['name'] . ' bill after the due date?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'If you pay your ' . $provider['name'] . ' bill after the due date, a late payment surcharge is added and the amount payable increases. CheckBill.pk helps you see due dates early so you can avoid this fee.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'Is CheckBill.pk an official ' . $provider['name'] . ' website?',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'CheckBill.pk is not an official ' . $provider['name'] . ' website. It is a companion tool that helps you manage ' . $provider['name'] . ' and other Pakistani utility bills from one dashboard using official data sources.',
                ],
            ],
        ],
    ];

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
                <iconify-icon icon="lucide:{{ $isElectricity ? 'zap' : ($isGas ? 'flame' : 'wifi') }}" width="14"></iconify-icon>
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
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Reference / Consumer Number</label>
                            <a href="/blog/find-reference-number" class="text-[11px] font-medium {{ $textColor }} hover:underline flex items-center gap-1">
                                <iconify-icon icon="lucide:help-circle" width="12"></iconify-icon>
                                Where to find?
                            </a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <iconify-icon icon="lucide:hash" width="18" class="text-slate-400 {{ $isElectricity ? 'group-focus-within:text-orange-500' : ($isGas ? 'group-focus-within:text-red-500' : 'group-focus-within:text-blue-500') }} transition-colors"></iconify-icon>
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
                <p class="text-sm text-slate-700 mb-3">Create a free account and never type this reference number again. Check your {{ $provider['name'] }} bill every month with one click from your dashboard.</p>
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
            <!-- How to check bill online -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">How to check {{ $provider['name'] }} bill online</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    To check your {{ $provider['name'] }} {{ strtolower($provider['utility_type_label']) }} bill online, select {{ $provider['name'] }}, enter your reference number, and click Check duplicate bill. You will see the bill amount, due date, and billing month. If you want faster access next month, save your bill in your dashboard so you can check with one click.
                </p>
            </section>

            <!-- How to download duplicate bill -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">How to download duplicate {{ $provider['name'] }} bill</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    If you need a duplicate {{ $provider['name'] }} bill for payment or record keeping, use the bill lookup form and then download the duplicate bill PDF. A duplicate bill is useful when the original copy is missing or when you need to share the bill with a tenant, employer, or accountant.
                </p>
                <p class="text-sm text-slate-600">
                    Learn more in our guide: <a href="/blog/how-to-download-duplicate-bill" class="font-semibold {{ $textColor }} underline">How to download duplicate bill</a>
                </p>
            </section>

            <!-- Where to find reference number -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">Where to find {{ $provider['name'] }} reference number</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    Your reference number is printed on the top area of your previous {{ $provider['name'] }} bill. It is usually labelled Reference No. If you are not sure, open the guide on <a href="/blog/find-reference-number" class="font-semibold {{ $textColor }} underline">how to find reference number on utility bills</a> and follow the highlighted examples.
                </p>
            </section>

            <!-- Coverage area -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">{{ $provider['name'] }} coverage area</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    {{ $provider['name'] }} generally serves {{ implode(', ', $provider['coverage_area']) }}. @if(count($relatedProviders) > 0)If your bill is from another region, check other providers like @foreach($relatedProviders as $index => $related)@if($index > 0), @endif<a href="/{{ $related['slug'] }}" class="font-semibold {{ $textColor }} underline">{{ $related['name'] }} {{ strtolower($related['utility_type_label']) }} bill</a>@endforeach.@endif
                </p>
            </section>

            @if(count($relatedProviders) > 0)
            <!-- Provider comparison -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">{{ $provider['name'] }} vs other {{ strtolower($provider['utility_type_label']) }} companies</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    {{ $provider['name'] }} serves the {{ implode(', ', array_slice($provider['coverage_area'], 0, 2)) }} region. @foreach($relatedProviders as $index => $related)@if($index === 0)If you live in another area, you might need <a href="/{{ $related['slug'] }}" class="font-semibold {{ $textColor }} underline">{{ $related['name'] }} duplicate bill</a>.@elseif($index === 1) For {{ $related['coverage_area'][0] ?? 'other regions' }}, check <a href="/{{ $related['slug'] }}" class="font-semibold {{ $textColor }} underline">{{ $related['name'] }} {{ strtolower($related['utility_type_label']) }} bill online</a>.@endif @endforeach
                </p>
            </section>
            @endif

            <!-- Due date and late payment -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">{{ $provider['name'] }} due date and late payment surcharge</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    Your bill shows a due date and an amount payable within due date. If you pay after the due date, late payment surcharge may apply. Checking your due date early helps you avoid extra charges and prevents service issues.
                </p>
                @if($payGuideUrl !== '#')
                <p class="text-sm text-slate-600">
                    Learn more: <a href="{{ $payGuideUrl }}" class="font-semibold {{ $textColor }} underline">How to pay {{ strtolower($provider['utility_type_label']) }} bill online in Pakistan</a>
                </p>
                @endif
            </section>

            @if($isElectricity)
            <!-- Understanding your electricity bill -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6">Understanding your electricity bill</h2>
                <div class="space-y-3">
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-units-{{ $providerKey }}">
                            <span class="font-semibold text-slate-900">Units and meter reading</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-units-{{ $providerKey }}">
                            Units drive your electricity bill cost and depend on your consumption. The meter reading shows how many units you've used since the last bill. Higher consumption means more units and a higher bill amount.
                        </div>
                    </div>
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-taxes-{{ $providerKey }}">
                            <span class="font-semibold text-slate-900">Taxes and adjustments</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-taxes-{{ $providerKey }}">
                            Your bill includes fuel adjustment charges and taxes. These are government-mandated charges that vary based on fuel costs and tax rates. They are added to your base electricity charges.
                        </div>
                    </div>
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-due-date-{{ $providerKey }}">
                            <span class="font-semibold text-slate-900">Within due date vs after due date</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-due-date-{{ $providerKey }}">
                            The "within due date" amount is what you pay if you pay on time. The "after due date" amount includes late payment surcharge. Paying early helps you avoid the extra charges.
                        </div>
                    </div>
                    <div class="border-2 border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 hover:bg-slate-100 text-left accordion-toggle transition-colors" data-accordion="bill-peak-{{ $providerKey }}">
                            <span class="font-semibold text-slate-900">Peak hours</span>
                            <iconify-icon icon="lucide:chevron-down" width="20" class="text-slate-400 accordion-icon transition-transform"></iconify-icon>
                        </button>
                        <div class="px-5 pb-4 pt-2 accordion-content hidden text-sm text-slate-600 leading-relaxed" id="bill-peak-{{ $providerKey }}">
                            Some electricity providers charge different rates during peak hours (usually evening hours when demand is highest). Check your bill to see if peak hour charges apply to your connection.
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <!-- Roman Urdu section -->
            <section>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4">{{ $provider['name'] }} bill online kaise check karein</h2>
                <p class="text-base text-slate-700 leading-relaxed mb-4">
                    {{ $provider['name'] }} bill online check karne ke liye {{ $provider['name'] }} select karein, apna reference number enter karein aur Check duplicate bill button par click karein. Aap ko bill amount, due date aur billing month nazar aa jaye ga. Agar reference number yaad nahi to purane bill ke top area par Reference No dekhein. {{ $provider['name'] }} duplicate bill download bhi isi tarah ho jata hai. Bohat log search karte hain {{ strtolower($provider['name']) }} bil online check, {{ strtolower($provider['name']) }} duplicate bill download, aur {{ strtolower($provider['name']) }} bill reference number kahan hota hai. {{ $provider['name'] }} bill check by reference number se aap apna bill amount aur due date dekh sakte hain. {{ $provider['name'] }} bill due date kaise check karein? Bill check karne ke baad due date aap ko bill details mein dikhai dega.
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
                @php
                    $hoverBorderClass = $isElectricity ? 'hover:border-orange-300' : ($isGas ? 'hover:border-red-300' : 'hover:border-blue-300');
                    $textColorClass = $isElectricity ? 'text-orange-600' : ($isGas ? 'text-red-600' : 'text-blue-600');
                @endphp
                <a href="/{{ $related['slug'] }}" class="group bg-white rounded-2xl p-5 border-2 border-slate-100 {{ $hoverBorderClass }} hover:shadow-xl transition-all duration-200">
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
                        <p class="text-[10px] font-semibold {{ $textColorClass }}">{{ implode(', ', array_slice($related['coverage_area'], 0, 2)) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Related Blog Posts -->
        @if(isset($relatedBlogs) && $relatedBlogs->count() > 0)
        <div class="max-w-6xl mx-auto mb-16">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-3">Related Articles</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Expert tips and guides to help you manage your {{ strtolower($provider['utility_type_label']) }} bills better</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedBlogs as $blog)
                <a href="{{ route('blogs.show', $blog->slug) }}" class="group bg-white rounded-2xl border border-slate-100 p-2 hover:shadow-lg hover:shadow-slate-200/40 hover:-translate-y-1 transition-all duration-300 h-full flex flex-col">
                    <div class="aspect-[4/3] rounded-xl bg-gradient-to-br {{ $blog->gradient_from ?? 'from-orange-50' }} {{ $blog->gradient_to ?? 'to-orange-100' }} border border-orange-100 relative overflow-hidden flex items-center justify-center mb-4">
                        <div class="absolute inset-0 bg-[radial-gradient(#fdba74_1px,transparent_1px)] [background-size:16px_16px] opacity-20"></div>
                        <iconify-icon icon="{{ $blog->icon_name ?? 'lucide:file-text' }}" width="32" class="text-orange-500 group-hover:scale-110 transition-transform duration-300"></iconify-icon>
                    </div>
                    <div class="px-2 pb-2 flex-grow flex flex-col">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[10px] font-bold uppercase">{{ $blog->category }}</span>
                            <span class="text-[10px] text-slate-400">• {{ $blog->reading_time }} min read</span>
                        </div>
                        <h3 class="text-lg font-bold tracking-tight text-slate-900 mb-2 group-hover:text-orange-600 transition-colors">
                            {{ $blog->title }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4 line-clamp-2">
                            {{ $blog->excerpt }}
                        </p>
                        <div class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-[10px] font-medium text-slate-400">{{ $blog->published_at->format('M d, Y') }}</span>
                            <iconify-icon icon="lucide:arrow-up-right" width="16" class="text-slate-300 group-hover:text-orange-500 transition-colors"></iconify-icon>
                        </div>
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
                    <a href="/blog/find-reference-number" class="{{ $textColor }} font-medium hover:underline">How to find reference number</a>
                    <a href="/blog/how-to-download-duplicate-bill" class="{{ $textColor }} font-medium hover:underline">How to download duplicate bill</a>
                    @if($payGuideUrl !== '#')
                    <a href="{{ $payGuideUrl }}" class="{{ $textColor }} font-medium hover:underline">How to pay {{ strtolower($provider['utility_type_label']) }} bill online</a>
                    @endif
                    @if($calculatorUrl !== '#')
                    <a href="{{ $calculatorUrl }}" class="{{ $textColor }} font-medium hover:underline">{{ $provider['utility_type_label'] }} bill calculator</a>
                    @endif
                    <a href="{{ $provider['hub_url'] }}" class="{{ $textColor }} font-medium hover:underline">All {{ strtolower($provider['utility_type_label']) }} providers</a>
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
