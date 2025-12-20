<?php

namespace App\Http\Controllers;

use App\Models\SavedBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function check(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'string'],
            'provider' => ['required', 'string'],
            'reference_number' => ['required', 'string', 'max:50'],
        ]);

        $providerKey = strtolower($data['provider']);
        $allProviders = config('providers.providers');
        $providerConfig = $allProviders[$providerKey] ?? null;
        
        $provider = $providerConfig ? [
            'type' => $providerConfig['type'],
            'name' => $providerConfig['name'],
            'slug' => $providerConfig['slug'],
        ] : [
            'type' => $data['type'],
            'name' => strtoupper($providerKey),
            'slug' => null,
        ];

        $maskedReference = $this->maskReference($data['reference_number']);

        $savedBill = null;
        if (Auth::check()) {
            // Always update last_checked_at if bill exists, even if not saving new one
            $existingBill = SavedBill::where('user_id', $request->user()->id)
                ->where('provider_key', $providerKey)
                ->where('reference_number', $data['reference_number'])
                ->first();
            
            if ($existingBill) {
                $existingBill->update(['last_checked_at' => now()]);
                $savedBill = $existingBill;
            }
            
            // Save new bill if requested
            if ($request->boolean('save')) {
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


