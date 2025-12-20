<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($urls as $url)
        <url>
            <loc>{{ is_array($url) ? $url['loc'] : $url }}</loc>
            @if(isset($url['priority']))
            <priority>{{ $url['priority'] }}</priority>
            @endif
            @if(isset($url['changefreq']))
            <changefreq>{{ $url['changefreq'] }}</changefreq>
            @endif
        </url>
    @endforeach
</urlset>


