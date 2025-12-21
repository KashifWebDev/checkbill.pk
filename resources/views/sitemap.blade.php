<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    @foreach ($urls as $url)
        <url>
            <loc>{{ is_array($url) ? htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') : htmlspecialchars($url, ENT_XML1, 'UTF-8') }}</loc>
            @if(isset($url['lastmod']))
            <lastmod>{{ $url['lastmod'] }}</lastmod>
            @endif
            @if(isset($url['changefreq']))
            <changefreq>{{ $url['changefreq'] }}</changefreq>
            @endif
            @if(isset($url['priority']))
            <priority>{{ $url['priority'] }}</priority>
            @endif
        </url>
    @endforeach
</urlset>


