@extends('layouts.app')

@section('title', 'Your CheckBill.pk dashboard')
@section('meta_description', 'Personal dashboard for your saved electricity, gas and internet bills on CheckBill.pk.')
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 space-y-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Your bills at a glance</h1>
                    <p class="text-sm text-slate-500 mt-1">Welcome back, {{ $user->name }}. This is your quiet control panel for electricity, gas and internet bills.</p>
                </div>

                <div class="flex flex-col items-end gap-2">
                        <div class="rounded-2xl bg-slate-900 text-slate-50 px-4 py-3 text-xs max-w-xs">
                            <p class="font-semibold text-emerald-300">Tip</p>
                            <p class="mt-1 text-slate-100">Each meter you save here turns into a one‑click “Check now” button next month.</p>
                        </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    @if ($savedBills->isEmpty())
                        <div class="rounded-2xl bg-white border border-dashed border-slate-200 p-6 flex flex-col items-center justify-center text-center">
                            <div class="w-10 h-10 rounded-2xl bg-slate-900 text-white flex items-center justify-center mb-3">
                                <span class="text-[13px] font-bold">+</span>
                            </div>
                            <h2 class="text-sm font-semibold text-slate-900 mb-1">No meters saved yet</h2>
                            <p class="text-xs text-slate-500 mb-3">
                                The first time you search a bill and tap “Save to my dashboard”, it will appear here as a card with a one‑click
                                <span class="font-semibold">Check now</span> button.
                            </p>
                            <a href="{{ route('home') }}"
                               class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">
                                Check a bill now
                            </a>
                        </div>
                    @else
                        <div class="space-y-3">
                            <h2 class="text-xs font-semibold text-slate-900 uppercase tracking-wide">Your saved meters</h2>
                            <div class="grid sm:grid-cols-2 gap-3">
                                @foreach ($savedBills as $bill)
                                    <div class="rounded-2xl bg-white border border-slate-100 p-4 flex flex-col justify-between">
                                        <div class="mb-2">
                                            <p class="text-xs font-semibold text-slate-900">
                                                {{ $bill->nickname ?: $bill->provider_name.' meter' }}
                                            </p>
                                            <p class="text-[11px] text-slate-500">
                                                {{ ucfirst($bill->type) }} — {{ $bill->provider_name }}
                                            </p>
                                            <p class="mt-1 text-[10px] text-slate-400 font-mono">
                                                Ref: {{ $bill->reference_number }}
                                            </p>
                                        </div>
                                        <div class="flex items-center justify-between text-[11px] text-slate-500 mt-2">
                                            <span>
                                                @if ($bill->last_checked_at)
                                                    Last checked {{ $bill->last_checked_at->diffForHumans() }}
                                                @else
                                                    Not checked yet
                                                @endif
                                            </span>
                                            <a href="{{ route('bills.check', ['type' => $bill->type, 'provider' => $bill->provider_key, 'reference_number' => $bill->reference_number]) }}"
                                               class="inline-flex items-center gap-1 rounded-full bg-slate-900 px-3 py-1.5 text-[11px] font-semibold text-white hover:bg-slate-800">
                                                Check now
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="space-y-4">
                    <div class="rounded-2xl bg-white border border-slate-100 p-4 text-[11px] text-slate-700 space-y-2">
                        <h3 class="text-xs font-semibold text-slate-900 mb-1">Recognition & routine</h3>
                        <p>Each time you return, your dashboard will gently remember where you left off – which bills you checked and when.</p>
                        <p class="text-slate-500">Think of this as your private “bill control centre” instead of a noisy portal.</p>
                    </div>

                    <div class="rounded-2xl bg-emerald-50 border border-emerald-100 p-4 text-[11px] text-emerald-900">
                        <p class="font-semibold mb-1">Tip for future you</p>
                        <p>Whenever you get a new connection (home, office, shop), save its reference number here once. From next month, checking the bill is a one‑click habit instead of a small headache.</p>
                    </div>
                </div>
            </div>
        </div>
@endsection
