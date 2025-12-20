<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function electricityHub()
    {
        return view('hubs.electricity');
    }

    public function gasHub()
    {
        return view('hubs.gas');
    }

    public function internetHub()
    {
        return view('hubs.internet');
    }

    public function provider(Request $request)
    {
        // Get slug from route defaults or request path
        $slug = $request->route()->defaults['slug'] ?? ltrim($request->path(), '/');
        
        // Load provider from config
        $allProviders = config('providers.providers');
        $provider = collect($allProviders)->firstWhere('slug', $slug);

        abort_unless($provider, 404);

        // Use a dedicated provider view if it exists (e.g. providers.iesco),
        // otherwise fall back to the generic provider template so all routes work.
        $candidateView = 'providers.' . $provider['key'];
        $viewName = view()->exists($candidateView) ? $candidateView : 'providers.generic';

        return view($viewName, [
            'provider' => $provider,
            'slug' => $slug,
        ]);
    }
}


