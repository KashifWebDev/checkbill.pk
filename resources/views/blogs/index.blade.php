@extends('layouts.app')

@section('title', 'PakBills Blog | Energy Tips, Tariffs & Bill Savings in Pakistan')
@section('meta_description', 'Discover tips to lower your electricity bills, understand tariff changes, and manage your utility consumption effectively. Expert guides on LESCO, IESCO, K-Electric, SNGPL and more.')
@section('canonical', config('app.url') . '/blog')
@section('robots', 'index,follow')

@php
    $baseUrl = config('app.url');
@endphp

@push('schema')
@php
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
                'name' => 'Blog',
                'item' => $baseUrl . '/blog',
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
    <!-- Success Message for Newsletter -->
    @if(session('newsletter_success'))
    <div class="max-w-6xl mx-auto mb-6 bg-emerald-50 border-2 border-emerald-200 rounded-xl p-4 flex items-center gap-3 animate-fade-in-up">
        <iconify-icon icon="lucide:check-circle" width="20" class="text-emerald-600 flex-shrink-0"></iconify-icon>
        <p class="text-sm font-semibold text-emerald-900">{{ session('newsletter_success') }}</p>
    </div>
    @endif

    <!-- Hero Section -->
    <div class="max-w-3xl mx-auto text-center mb-16 animate-fade-up">
        <div class="inline-flex items-center gap-1.5 rounded-full border border-blue-200 bg-blue-50/50 backdrop-blur-sm px-3 py-1 text-[11px] font-semibold text-blue-700 mb-6 uppercase tracking-wide">
            <iconify-icon icon="lucide:sparkles" width="12"></iconify-icon>
            Fresh Content
        </div>
        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-slate-900 mb-6">
            Energy insights for the <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">modern consumer.</span>
        </h1>
        <p class="text-base sm:text-lg text-slate-500 leading-relaxed max-w-xl mx-auto">
            Discover tips to lower your electricity bills, understand tariff changes, and manage your utility consumption effectively.
        </p>
    </div>

    <!-- Category Filter (Visual Only) -->
    @if(count($categories) > 0)
    <div class="max-w-6xl mx-auto mb-10 overflow-x-auto pb-4 scrollbar-hide animate-fade-up delay-100">
        <div class="flex items-center justify-center gap-2 min-w-max">
            <button class="px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-semibold shadow-lg shadow-slate-900/20">All Posts</button>
            @foreach($categories as $category)
            <button class="px-4 py-2 rounded-full bg-white border border-slate-200 text-slate-600 text-xs font-semibold hover:border-slate-300 hover:bg-slate-50 transition-colors">{{ $category }}</button>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Featured Post -->
    @if($featuredPost)
    <div class="max-w-6xl mx-auto mb-12 animate-fade-up delay-200">
        <article class="relative bg-white rounded-3xl border border-slate-200 p-2 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 group overflow-hidden">
            <a href="{{ route('blogs.show', $featuredPost->slug) }}" class="block">
                <div class="grid md:grid-cols-2 gap-6 items-center">
                    <!-- Abstract Featured Image -->
                    <div class="h-64 md:h-80 w-full rounded-2xl bg-gradient-to-br {{ $featuredPost->gradient_from ?? 'from-green-50' }} {{ $featuredPost->gradient_to ?? 'to-emerald-100' }} border border-green-100 relative overflow-hidden flex items-center justify-center">
                        <div class="absolute inset-0 pattern-grid opacity-30"></div>
                        <div class="w-24 h-24 rounded-2xl bg-white shadow-xl flex items-center justify-center text-emerald-500 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                            <iconify-icon icon="{{ $featuredPost->icon_name ?? 'lucide:trending-down' }}" width="48" stroke-width="1.5"></iconify-icon>
                        </div>
                    </div>
                    
                    <div class="p-4 md:p-8 md:pr-12">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-2.5 py-1 rounded-lg bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider">Featured</span>
                            <span class="text-xs font-medium text-slate-400">{{ $featuredPost->published_at->format('M d, Y') }}</span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-900 mb-4 group-hover:text-green-600 transition-colors">
                            {{ $featuredPost->title }}
                        </h2>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ $featuredPost->excerpt }}
                        </p>
                        <div class="flex items-center justify-between">
                            @if($featuredPost->author_name)
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                    {{ strtoupper(substr($featuredPost->author_name, 0, 2)) }}
                                </div>
                                <span class="text-xs font-medium text-slate-900">{{ $featuredPost->author_name }}</span>
                            </div>
                            @else
                            <div></div>
                            @endif
                            <div class="inline-flex items-center gap-2 text-sm font-bold text-slate-900 group-hover:gap-3 transition-all">
                                Read Article <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </article>
    </div>
    @endif

    <!-- Blog Grid -->
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-up delay-300">
        @foreach($blogs->skip(1) as $blog)
        <article class="bg-white rounded-2xl border border-slate-100 p-2 hover:shadow-lg hover:shadow-slate-200/40 hover:-translate-y-1 transition-all duration-300 group h-full flex flex-col">
            <a href="{{ route('blogs.show', $blog->slug) }}" class="block h-full flex flex-col">
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
        </article>
        @endforeach

        <!-- Newsletter Card -->
        <div class="bg-slate-900 rounded-2xl p-6 h-full flex flex-col justify-center relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/20 blur-3xl rounded-full -translate-y-1/2 translate-x-1/2"></div>
            
            <div class="relative z-10">
                <iconify-icon icon="lucide:mail" width="24" class="text-green-400 mb-4"></iconify-icon>
                <h3 class="text-lg font-bold tracking-tight text-white mb-2">Get updates weekly</h3>
                <p class="text-xs text-slate-400 mb-6 leading-relaxed">Join 5,000+ subscribers getting tariff alerts directly in their inbox.</p>
                
                <form action="{{ route('blogs.subscribe') }}" method="POST" class="flex flex-col gap-2">
                    @csrf
                    <input type="email" name="email" placeholder="email@address.com" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white placeholder:text-slate-500 focus:outline-none focus:ring-1 focus:ring-green-500 min-h-[48px]">
                    <button type="submit" class="w-full bg-white text-slate-900 text-xs font-bold py-2 rounded-lg hover:bg-slate-100 transition-colors min-h-[48px]">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
@endsection
