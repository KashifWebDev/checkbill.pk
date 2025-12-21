@extends('layouts.app')

@section('title', $blog->meta_title ?: $blog->title . ' | CheckBill.pk Blog')
@section('meta_description', $blog->meta_description ?: $blog->excerpt)
@section('canonical', config('app.url') . '/blog/' . $blog->slug)
@section('robots', 'index,follow')

@php
    $baseUrl = config('app.url');
    $blogUrl = $baseUrl . '/blog/' . $blog->slug;
    $providerConfig = null;
    if ($blog->provider_key) {
        $allProviders = config('providers.providers');
        $providerConfig = $allProviders[$blog->provider_key] ?? null;
    }
    
    // Build breadcrumb schema
    $breadcrumbItems = [
        ['name' => 'Home', 'url' => $baseUrl . '/'],
        ['name' => 'Blog', 'url' => $baseUrl . '/blog'],
    ];
    if ($blog->category) {
        $breadcrumbItems[] = ['name' => $blog->category, 'url' => $baseUrl . '/blog'];
    }
    $breadcrumbItems[] = ['name' => $blog->title, 'url' => $blogUrl];
    
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_map(function($item, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }, $breadcrumbItems, array_keys($breadcrumbItems)),
    ];
    
    // Article schema
    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $blog->title,
        'description' => $blog->excerpt,
        'datePublished' => $blog->published_at->toIso8601String(),
        'dateModified' => $blog->updated_at->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => $blog->author_name ?: 'CheckBill.pk Team',
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'CheckBill.pk',
            'url' => $baseUrl,
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@push('styles')
<style>
    .blog-content {
        line-height: 1.75;
        color: #334155;
    }
    
    .blog-content p {
        margin-bottom: 1.5rem;
        font-size: 1rem;
        line-height: 1.75;
    }
    
    .blog-content .lead {
        font-size: 1.25rem;
        line-height: 1.75;
        font-weight: 500;
        color: #475569;
        margin-bottom: 2rem;
    }
    
    .blog-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        line-height: 1.3;
    }
    
    .blog-content h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    
    .blog-content h4 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    
    .blog-content ul,
    .blog-content ol {
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .blog-content ul li {
        margin-bottom: 0.5rem;
        list-style-type: disc;
    }
    
    .blog-content ol li {
        margin-bottom: 0.5rem;
        list-style-type: decimal;
    }
    
    .blog-content strong {
        font-weight: 700;
        color: #0f172a;
    }
    
    .blog-content table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
        background-color: white;
    }
    
    .blog-content table thead {
        background-color: #f1f5f9;
    }
    
    .blog-content table th {
        padding: 0.75rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        color: #0f172a;
        border-bottom: 2px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
    }
    
    .blog-content table th:last-child {
        border-right: none;
    }
    
    .blog-content table td {
        padding: 0.75rem;
        font-size: 0.875rem;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
    }
    
    .blog-content table td:last-child {
        border-right: none;
    }
    
    .blog-content table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .blog-content table tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .blog-content hr {
        border: none;
        border-top: 1px solid #e2e8f0;
        margin: 2.5rem 0;
    }
    
    .blog-content a {
        color: #3b82f6;
        text-decoration: underline;
    }
    
    .blog-content a:hover {
        color: #2563eb;
    }
    
    .blog-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #475569;
    }
</style>
@endpush

@section('content')
    <!-- Breadcrumbs (SEO Critical) -->
    <nav aria-label="Breadcrumb" class="max-w-4xl mx-auto mb-6 flex items-center gap-2 text-xs font-medium text-slate-500">
        <a href="{{ route('home') }}" class="hover:text-slate-900 hover:underline">Home</a>
        <iconify-icon icon="lucide:chevron-right" width="12" class="text-slate-300"></iconify-icon>
        <a href="{{ route('blogs.index') }}" class="hover:text-slate-900 hover:underline">Blog</a>
        @if($blog->category)
        <iconify-icon icon="lucide:chevron-right" width="12" class="text-slate-300"></iconify-icon>
        <span class="text-slate-500">{{ $blog->category }}</span>
        @endif
        <iconify-icon icon="lucide:chevron-right" width="12" class="text-slate-300"></iconify-icon>
        <span class="text-slate-900 truncate max-w-[150px] sm:max-w-none">{{ $blog->title }}</span>
    </nav>

    <!-- Article Header -->
    <header class="max-w-4xl mx-auto mb-10 text-center sm:text-left">
        <div class="inline-flex items-center gap-1.5 rounded-full border border-green-200 bg-green-50 px-3 py-1 text-[11px] font-semibold text-green-700 mb-6 uppercase tracking-wide">
            <iconify-icon icon="{{ $blog->icon_name ?? 'lucide:trending-down' }}" width="12"></iconify-icon>
            {{ $blog->category }}
        </div>
        
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-6 leading-[1.15]">
            {{ $blog->title }}
        </h1>
        
        <div class="flex flex-wrap items-center gap-6 text-sm text-slate-500 sm:justify-start justify-center">
            @if($blog->author_name)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-xs ring-2 ring-white shadow-lg">
                    {{ strtoupper(substr($blog->author_name, 0, 2)) }}
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-bold text-slate-900 leading-none">{{ $blog->author_name }}</span>
                    @if($blog->author_role)
                    <span class="text-[10px] mt-0.5">{{ $blog->author_role }}</span>
                    @endif
                </div>
            </div>
            <div class="h-4 w-px bg-slate-200 hidden sm:block"></div>
            @endif
            <div class="flex items-center gap-1.5">
                <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                <time datetime="{{ $blog->published_at->toIso8601String() }}">{{ $blog->published_at->format('F d, Y') }}</time>
            </div>
            <div class="flex items-center gap-1.5">
                <iconify-icon icon="lucide:clock" width="14"></iconify-icon>
                <span>{{ $blog->reading_time }} min read</span>
            </div>
        </div>
    </header>

    <!-- Featured Image Area -->
    <figure class="max-w-4xl mx-auto mb-12 rounded-3xl overflow-hidden border border-slate-200 shadow-xl shadow-slate-200/50 bg-slate-50">
        <div class="w-full aspect-[21/9] relative bg-gradient-to-br {{ $blog->gradient_from ?? 'from-emerald-50' }} {{ $blog->gradient_to ?? 'to-green-100' }} flex items-center justify-center overflow-hidden border border-emerald-100">
            <!-- Abstract Pattern Decoration -->
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white opacity-30 blur-3xl rounded-full"></div>
            
            <div class="relative z-10 text-center text-slate-900 p-6">
                 <iconify-icon icon="{{ $blog->icon_name ?? 'lucide:zap-off' }}" width="64" class="mb-4 text-slate-900"></iconify-icon>
                 <p class="text-lg font-medium tracking-wide text-slate-900">{{ strtoupper($blog->category) }}</p>
            </div>
        </div>
        @if($blog->featured_image_alt)
        <figcaption class="px-4 py-2 bg-white text-[10px] text-slate-400 text-center border-t border-slate-100">
            {{ $blog->featured_image_alt }}
        </figcaption>
        @endif
    </figure>

    <!-- Main Content Grid -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left Column: Article Body -->
        <article class="lg:col-span-8 article-content">
            
            <div class="blog-content">
                {!! $blog->content !!}
            </div>

            @if($providerConfig)
            <div class="mt-8 mb-12">
                <a href="{{ config('app.url') . '/' . $providerConfig['slug'] }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 text-white group hover:shadow-lg hover:shadow-slate-900/20 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center">
                            <iconify-icon icon="lucide:calculator" width="20"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Check Your {{ $providerConfig['name'] }} Bill Online</h4>
                            <p class="text-xs text-slate-400">View and download your duplicate bill instantly.</p>
                        </div>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white text-slate-900 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
                    </div>
                </a>
            </div>
            @endif

            <hr class="border-slate-100 my-10">
            
            <!-- Share Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm font-semibold text-slate-900">Share this guide:</p>
                <div class="flex items-center gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($blogUrl) }}" target="_blank" class="w-9 h-9 rounded-full border border-slate-200 text-slate-500 hover:text-[#1877F2] hover:border-[#1877F2] hover:bg-blue-50 flex items-center justify-center transition-colors" aria-label="Share on Facebook">
                        <iconify-icon icon="lucide:facebook" width="16"></iconify-icon>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode($blogUrl) }}&text={{ urlencode($blog->title) }}" target="_blank" class="w-9 h-9 rounded-full border border-slate-200 text-slate-500 hover:text-[#1DA1F2] hover:border-[#1DA1F2] hover:bg-sky-50 flex items-center justify-center transition-colors" aria-label="Share on Twitter">
                        <iconify-icon icon="lucide:twitter" width="16"></iconify-icon>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . $blogUrl) }}" target="_blank" class="w-9 h-9 rounded-full border border-slate-200 text-slate-500 hover:text-[#25D366] hover:border-[#25D366] hover:bg-green-50 flex items-center justify-center transition-colors" aria-label="Share on Whatsapp">
                        <iconify-icon icon="lucide:message-circle" width="16"></iconify-icon>
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ $blogUrl }}'); alert('Link copied!');" class="w-9 h-9 rounded-full border border-slate-200 text-slate-500 hover:text-slate-900 hover:border-slate-900 hover:bg-slate-50 flex items-center justify-center transition-colors" aria-label="Copy Link">
                        <iconify-icon icon="lucide:link" width="16"></iconify-icon>
                    </button>
                </div>
            </div>

        </article>

        <!-- Right Column: Sidebar -->
        <aside class="lg:col-span-4">
            
            <!-- Fixed Sticky Container for Both Sections -->
            <div class="sticky top-24 space-y-8">
                
                <!-- Newsletter -->
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    @if(session('newsletter_success'))
                    <div class="mb-4 bg-emerald-50 border border-emerald-200 rounded-lg p-3 text-xs text-emerald-900">
                        {{ session('newsletter_success') }}
                    </div>
                    @endif
                    <h4 class="text-xs font-bold text-slate-900 mb-3">Newsletter</h4>
                    <p class="text-xs text-slate-500 mb-4">Get tariff updates before they hit the news.</p>
                    <form action="{{ route('blogs.subscribe') }}" method="POST" class="space-y-2">
                        @csrf
                        <input type="email" name="email" placeholder="Your email address" required class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 min-h-[48px]">
                        <button type="submit" class="w-full bg-slate-900 text-white text-xs font-bold py-2 rounded-lg hover:bg-slate-800 transition-colors min-h-[48px]">Subscribe</button>
                    </form>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-4">Related Articles</h3>
                    <div class="space-y-4">
                        @foreach($relatedPosts as $related)
                        <a href="{{ route('blogs.show', $related->slug) }}" class="block group">
                            <div class="flex gap-3">
                                <div class="w-20 h-16 rounded-lg bg-gradient-to-br {{ $related->gradient_from ?? 'from-orange-100' }} {{ $related->gradient_to ?? 'to-orange-200' }} flex-shrink-0 flex items-center justify-center text-orange-500">
                                     <iconify-icon icon="{{ $related->icon_name ?? 'lucide:file-text' }}" width="20"></iconify-icon>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-900 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $related->title }}</h4>
                                    <span class="text-[10px] text-slate-400 mt-1 block">{{ $related->published_at->format('M d') }} • {{ $related->reading_time }} min read</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
            </div>
        </aside>
    </div>
@endsection
