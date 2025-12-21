<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Models\Blog;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// SEO hub pages
Route::get('/electricity-bill-online', [PageController::class, 'electricityHub'])->name('hubs.electricity');
Route::get('/gas-bill-online', [PageController::class, 'gasHub'])->name('hubs.gas');
Route::get('/internet-bill-online', [PageController::class, 'internetHub'])->name('hubs.internet');

// Provider pages (electricity, gas, internet)
Route::get('/iesco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'iesco-bill-online')->name('providers.iesco');
Route::get('/lesco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'lesco-bill-online')->name('providers.lesco');
Route::get('/mepco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'mepco-bill-online')->name('providers.mepco');
Route::get('/fesco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'fesco-bill-online')->name('providers.fesco');
Route::get('/pesco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'pesco-bill-online')->name('providers.pesco');
Route::get('/gepco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'gepco-bill-online')->name('providers.gepco');
Route::get('/hesco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'hesco-bill-online')->name('providers.hesco');
Route::get('/sepco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'sepco-bill-online')->name('providers.sepco');
Route::get('/qesco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'qesco-bill-online')->name('providers.qesco');
Route::get('/tesco-bill-online', [PageController::class, 'provider'])->defaults('slug', 'tesco-bill-online')->name('providers.tesco');
Route::get('/k-electric-bill-online', [PageController::class, 'provider'])->defaults('slug', 'k-electric-bill-online')->name('providers.kelectric');

Route::get('/sngpl-bill-online', [PageController::class, 'provider'])->defaults('slug', 'sngpl-bill-online')->name('providers.sngpl');
Route::get('/ssgc-bill-online', [PageController::class, 'provider'])->defaults('slug', 'ssgc-bill-online')->name('providers.ssgc');

Route::get('/ptcl-bill-online', [PageController::class, 'provider'])->defaults('slug', 'ptcl-bill-online')->name('providers.ptcl');
Route::get('/nayatel-bill-online', [PageController::class, 'provider'])->defaults('slug', 'nayatel-bill-online')->name('providers.nayatel');
Route::get('/stormfiber-bill-online', [PageController::class, 'provider'])->defaults('slug', 'stormfiber-bill-online')->name('providers.stormfiber');

// Unified bill lookup
Route::get('/check-duplicate-bill', [BillController::class, 'check'])->name('bills.check');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Bill management routes
Route::middleware('auth')->group(function () {
    Route::put('/dashboard/bills/{savedBill}', [BillController::class, 'update'])->name('bills.update');
    Route::delete('/dashboard/bills/{savedBill}', [BillController::class, 'destroy'])->name('bills.destroy');
});

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::post('/blog/subscribe', [BlogController::class, 'subscribe'])->name('blogs.subscribe');

// Robots.txt
Route::get('/robots.txt', function () {
    $baseUrl = config('app.url');
    $content = "User-agent: *\n";
    $content .= "Disallow: /check-duplicate-bill\n";
    $content .= "Disallow: /register\n";
    $content .= "Disallow: /login\n";
    $content .= "Disallow: /dashboard\n";
    $content .= "Allow: /\n";
    $content .= "Sitemap: {$baseUrl}/sitemap.xml\n";
    
    return response($content, 200)->header('Content-Type', 'text/plain');
});

// Sitemap
Route::get('/sitemap.xml', function () {
    $baseUrl = config('app.url');
    $allProviders = config('providers.providers');
    
    $urls = [];
    
    // Homepage - highest priority
    $urls[] = [
        'loc' => $baseUrl . '/',
        'priority' => '1.0',
        'changefreq' => 'weekly',
        'lastmod' => now()->toAtomString()
    ];
    
    // Hub pages - high priority for category pages
    $urls[] = [
        'loc' => $baseUrl . '/electricity-bill-online',
        'priority' => '0.95',
        'changefreq' => 'weekly',
        'lastmod' => now()->toAtomString()
    ];
    $urls[] = [
        'loc' => $baseUrl . '/gas-bill-online',
        'priority' => '0.95',
        'changefreq' => 'weekly',
        'lastmod' => now()->toAtomString()
    ];
    $urls[] = [
        'loc' => $baseUrl . '/internet-bill-online',
        'priority' => '0.95',
        'changefreq' => 'weekly',
        'lastmod' => now()->toAtomString()
    ];
    
    // Blog index page - high priority for content hub
    $urls[] = [
        'loc' => $baseUrl . '/blog',
        'priority' => '0.9',
        'changefreq' => 'daily',
        'lastmod' => now()->toAtomString()
    ];
    
    // Add all provider pages - high priority for main service pages
    foreach ($allProviders as $provider) {
        $urls[] = [
            'loc' => $baseUrl . '/' . $provider['slug'],
            'priority' => '0.85',
            'changefreq' => 'weekly',
            'lastmod' => now()->toAtomString()
        ];
    }
    
    // Add all blog posts from database - dynamic content with lastmod
    $blogs = Blog::whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->orderBy('published_at', 'desc')
        ->get();
    
    foreach ($blogs as $blog) {
        // Higher priority for guide posts (they're more evergreen)
        $isGuide = in_array($blog->category, ['Guides', 'Tools']);
        $priority = $isGuide ? '0.8' : '0.75';
        
        $urls[] = [
            'loc' => $baseUrl . '/blog/' . $blog->slug,
            'priority' => $priority,
            'changefreq' => $isGuide ? 'monthly' : 'weekly',
            'lastmod' => $blog->updated_at ? $blog->updated_at->toAtomString() : $blog->published_at->toAtomString()
        ];
    }

    $xml = view('sitemap', ['urls' => $urls]);

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

