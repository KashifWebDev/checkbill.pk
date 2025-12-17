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

    public function provider(Request $request, string $slug)
    {
        // Map provider slugs to metadata used by the generic provider view.
        $providers = [
            // Electricity
            'iesco-bill-online' => [
                'type' => 'electricity',
                'key' => 'iesco',
                'name' => 'IESCO',
            ],
            'lesco-bill-online' => [
                'type' => 'electricity',
                'key' => 'lesco',
                'name' => 'LESCO',
            ],
            'mepco-bill-online' => [
                'type' => 'electricity',
                'key' => 'mepco',
                'name' => 'MEPCO',
            ],
            'fesco-bill-online' => [
                'type' => 'electricity',
                'key' => 'fesco',
                'name' => 'FESCO',
            ],
            'pesco-bill-online' => [
                'type' => 'electricity',
                'key' => 'pesco',
                'name' => 'PESCO',
            ],
            'gepco-bill-online' => [
                'type' => 'electricity',
                'key' => 'gepco',
                'name' => 'GEPCO',
            ],
            'hesco-bill-online' => [
                'type' => 'electricity',
                'key' => 'hesco',
                'name' => 'HESCO',
            ],
            'sepco-bill-online' => [
                'type' => 'electricity',
                'key' => 'sepco',
                'name' => 'SEPCO',
            ],
            'qesco-bill-online' => [
                'type' => 'electricity',
                'key' => 'qesco',
                'name' => 'QESCO',
            ],
            'tesco-bill-online' => [
                'type' => 'electricity',
                'key' => 'tesco',
                'name' => 'TESCO',
            ],
            'k-electric-bill-online' => [
                'type' => 'electricity',
                'key' => 'ke',
                'name' => 'K-Electric',
            ],
        
            // Gas
            'sngpl-bill-online' => [
                'type' => 'gas',
                'key' => 'sngpl',
                'name' => 'SNGPL',
            ],
            'ssgc-bill-online' => [
                'type' => 'gas',
                'key' => 'ssgc',
                'name' => 'SSGC',
            ],
        
            // Internet
            'ptcl-bill-online' => [
                'type' => 'internet',
                'key' => 'ptcl',
                'name' => 'PTCL',
            ],
            'nayatel-bill-online' => [
                'type' => 'internet',
                'key' => 'nayatel',
                'name' => 'Nayatel',
            ],
            'stormfiber-bill-online' => [
                'type' => 'internet',
                'key' => 'stormfiber',
                'name' => 'StormFiber',
            ],
        ];
        

        abort_unless(isset($providers[$slug]), 404);

        $provider = $providers[$slug];

        // Use a dedicated provider view if it exists (e.g. providers.iesco),
        // otherwise fall back to the generic provider template so all routes work.
        $candidateView = 'providers.' . Str::before($slug, '-bill-online');
        $viewName = view()->exists($candidateView) ? $candidateView : 'providers.generic';

        return view($viewName, [
            'provider' => $provider,
            'slug' => $slug,
        ]);
    }
}


