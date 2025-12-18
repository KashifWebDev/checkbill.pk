@extends('layouts.app')

@section('title', 'Your CheckBill.pk Dashboard')
@section('meta_description', 'Personal dashboard for your saved electricity, gas and internet bills on CheckBill.pk.')
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-12 animate-fade-in-up">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900 mb-3">
                        Welcome back, {{ $user->name }}
                    </h1>
                    <p class="text-lg text-slate-600">
                        Your bills at a glance. Check any saved meter with one click.
                    </p>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                    <iconify-icon icon="lucide:plus" width="16"></iconify-icon>
                    Add New Bill
                </a>
            </div>
        </div>

        @if ($savedBills->isEmpty())
            <!-- Empty State -->
            <div class="max-w-2xl mx-auto text-center mb-16 animate-fade-in-up animate-delay-100">
                <div class="bg-white rounded-3xl shadow-xl border-2 border-dashed border-slate-200 p-12">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-700 text-white flex items-center justify-center mb-6 mx-auto shadow-lg">
                        <iconify-icon icon="lucide:file-plus" width="32"></iconify-icon>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-3">No meters saved yet</h2>
                    <p class="text-slate-600 mb-6 max-w-md mx-auto">
                        The first time you check a bill and save it, it will appear here as a card with a one-click "Check now" button.
                    </p>
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-slate-900 to-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                        <iconify-icon icon="lucide:search" width="16"></iconify-icon>
                        Check Your First Bill
                    </a>
                </div>
            </div>
        @else
            <!-- Saved Bills Grid -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">Your Saved Bills</h2>
                    <span class="text-sm text-slate-500">{{ $savedBills->count() }} {{ $savedBills->count() === 1 ? 'meter' : 'meters' }} saved</span>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($savedBills as $bill)
                        <div class="dashboard-card bg-white rounded-2xl p-6 border-2 border-slate-100 hover:border-green-300 hover:shadow-xl transition-all">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-10 h-10 rounded-xl {{ $bill->type === 'electricity' ? 'bg-orange-100' : ($bill->type === 'gas' ? 'bg-red-100' : 'bg-blue-100') }} flex items-center justify-center">
                                            <iconify-icon icon="lucide:{{ $bill->type === 'electricity' ? 'zap' : ($bill->type === 'gas' ? 'flame' : 'wifi') }}" width="18" class="{{ $bill->type === 'electricity' ? 'text-orange-600' : ($bill->type === 'gas' ? 'text-red-600' : 'text-blue-600') }}"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">{{ $bill->nickname ?: $bill->provider_name }}</p>
                                            <p class="text-xs text-slate-500">{{ ucfirst($bill->type) }} • {{ $bill->provider_name }}</p>
                                        </div>
                                    </div>
                                    <p class="text-[11px] text-slate-400 font-mono mt-2">Ref: {{ $bill->reference_number }}</p>
                                </div>
                            </div>
                            <div class="space-y-3 pt-4 border-t border-slate-100">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-500">Last checked</span>
                                    <span class="font-semibold text-slate-700">
                                        @if ($bill->last_checked_at)
                                            {{ $bill->last_checked_at->diffForHumans() }}
                                        @else
                                            Not checked yet
                                        @endif
                                    </span>
                                </div>
                                <a href="{{ route('bills.check', ['type' => $bill->type, 'provider' => $bill->provider_key, 'reference_number' => $bill->reference_number]) }}"
                                   class="block w-full text-center rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 px-4 py-3 text-xs font-semibold text-white hover:shadow-lg hover:scale-[1.02] transition-all">
                                    Check Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl p-6 border-2 border-emerald-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-lg">
                        <iconify-icon icon="lucide:sparkles" width="24"></iconify-icon>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Recognition & Routine</h3>
                </div>
                <p class="text-sm text-slate-700 leading-relaxed">
                    Each time you return, your dashboard remembers where you left off – which bills you checked and when. Think of this as your private "bill control centre".
                </p>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-blue-500 text-white flex items-center justify-center shadow-lg">
                        <iconify-icon icon="lucide:lightbulb" width="24"></iconify-icon>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Tip for Future You</h3>
                </div>
                <p class="text-sm text-slate-700 leading-relaxed">
                    Whenever you get a new connection (home, office, shop), save its reference number here once. From next month, checking the bill is a one-click habit instead of a small headache.
                </p>
            </div>
        </div>
    </div>
@endsection
