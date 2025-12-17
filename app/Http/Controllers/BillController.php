<?php

namespace App\Http\Controllers;

use App\Models\SavedBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    protected array $providers = [
        'iesco' => ['type' => 'electricity', 'name' => 'IESCO', 'slug' => 'iesco-bill-online'],
        'lesco' => ['type' => 'electricity', 'name' => 'LESCO', 'slug' => 'lesco-bill-online'],
        'ke' => ['type' => 'electricity', 'name' => 'K-Electric', 'slug' => 'k-electric-bill-online'],
        'sngpl' => ['type' => 'gas', 'name' => 'SNGPL', 'slug' => 'sngpl-bill-online'],
        // other providers can be added here gradually
    ];

    public function check(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'string'],
            'provider' => ['required', 'string'],
            'reference_number' => ['required', 'string', 'max:50'],
        ]);

        $providerKey = strtolower($data['provider']);
        $provider = $this->providers[$providerKey] ?? [
            'type' => $data['type'],
            'name' => strtoupper($providerKey),
            'slug' => null,
        ];

        $maskedReference = $this->maskReference($data['reference_number']);

        $savedBill = null;
        if (Auth::check() && $request->boolean('save')) {
            $savedBill = SavedBill::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'provider_key' => $providerKey,
                    'reference_number' => $data['reference_number'],
                ],
                [
                    'type' => $provider['type'],
                    'provider_name' => $provider['name'],
                    'nickname' => $request->input('nickname'),
                    'last_checked_at' => now(),
                ],
            );
        }

        return view('bills.result', [
            'provider' => $provider,
            'providerKey' => $providerKey,
            'reference' => $maskedReference,
            'rawReference' => $data['reference_number'],
            'type' => $provider['type'],
            'savedBill' => $savedBill,
        ]);
    }

    protected function maskReference(string $reference): string
    {
        $len = strlen($reference);
        if ($len <= 4) {
            return str_repeat('•', max(0, $len - 2)) . substr($reference, -2);
        }

        return substr($reference, 0, 2) . str_repeat('•', $len - 4) . substr($reference, -2);
    }
}


