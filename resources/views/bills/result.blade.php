@extends('layouts.app')

@section('title', $provider['name'].' duplicate bill result — CheckBill.pk')
@section('meta_description', 'Preview for '.$provider['name'].' duplicate bill lookup on CheckBill.pk. This page is not indexed by search engines.')
@section('canonical', isset($provider['slug']) && $provider['slug'] ? url('/'.$provider['slug']) : url()->previous())
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
        <h1 class="text-2xl font-bold text-slate-900 mb-4">
            {{ $provider['name'] }} duplicate bill lookup
        </h1>
        <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm mb-5">
            <dl class="text-sm text-slate-700 space-y-2">
                <div class="flex items-center justify-between">
                    <dt class="font-semibold text-slate-900">Provider</dt>
                    <dd>{{ $provider['name'] }} ({{ ucfirst($type) }})</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="font-semibold text-slate-900">Reference / consumer number</dt>
                    <dd class="font-mono">{{ $reference }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-2xl bg-slate-900 text-slate-50 p-5 space-y-2 mb-6">
            <p class="text-xs font-semibold text-emerald-300">Bill data placeholder</p>
            <p class="text-[12px] text-slate-100">
                Live bill amount, due date and “after due date” charges will appear here once integrations with
                {{ $provider['name'] }} are enabled. For now, use this page to confirm that your reference number is saved
                correctly and to set up your future dashboard.
            </p>
        </div>

        @auth
            <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm mb-6">
                <h2 class="text-sm font-semibold text-slate-900 mb-2">Save this bill to your dashboard</h2>
                <p class="text-[12px] text-slate-600 mb-3">
                    Saving turns this {{ $provider['name'] }} connection into a tile inside your dashboard. Next month you
                    will only need to click “Check now” instead of typing the reference number again.
                </p>
                <form action="{{ route('bills.check') }}" method="GET" class="space-y-3">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="provider" value="{{ $providerKey }}">
                    <input type="hidden" name="reference_number" value="{{ $rawReference }}">
                    <input type="hidden" name="save" value="1">

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1" for="nickname">
                            Give this connection a short name
                        </label>
                        <input type="text" id="nickname" name="nickname"
                               placeholder="e.g. Home ground floor, Parents house, Office"
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/20">
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-slate-900 text-white text-sm font-semibold py-3 shadow-sm hover:bg-slate-800 transition">
                        Save to my dashboard and remember this number
                    </button>
                </form>
            </div>
        @else
            <div class="rounded-2xl bg-white border border-slate-100 p-5 shadow-sm mb-6">
                <h2 class="text-sm font-semibold text-slate-900 mb-2">Save this number for next time</h2>
                <p class="text-[12px] text-slate-600 mb-3">
                    Right now you checked this {{ $provider['name'] }} bill as a guest. Next month you will have to type the
                    reference number again. If you create a free account, CheckBill.pk can remember this number for you and
                    show it inside a calm dashboard.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('register') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white hover:bg-slate-800 transition">
                        Create free account to save this bill
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full border border-slate-200 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        I already have an account
                    </a>
                </div>
            </div>
        @endauth

        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900">
            <iconify-icon icon="lucide:arrow-left" width="14"></iconify-icon>
            Back to bill page
        </a>
    </div>
@endsection


