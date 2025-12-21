@extends('layouts.app')

@section('title', 'Privacy Policy | CheckBill.pk')
@section('meta_description', 'CheckBill.pk privacy policy. Learn how we collect, use, and protect your personal information when you use our utility bill checking services in Pakistan.')
@section('canonical', config('app.url') . '/privacy-policy')

@php
    $baseUrl = config('app.url');
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $baseUrl . '/',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Privacy Policy',
                'item' => $baseUrl . '/privacy-policy',
            ],
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-8 md:mb-12">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-900 mb-4">Privacy Policy</h1>
        <p class="text-base text-slate-600">Last updated: {{ date('F j, Y') }}</p>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-6 md:p-10 space-y-8">
        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">1. Introduction</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                Welcome to CheckBill.pk. We are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website and services to check utility bills online in Pakistan.
            </p>
            <p class="text-base text-slate-700 leading-relaxed">
                By using CheckBill.pk, you agree to the collection and use of information in accordance with this policy. If you do not agree with our policies and practices, please do not use our services.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">2. Information We Collect</h2>
            <h3 class="text-xl font-semibold text-slate-800 mb-3">2.1 Information You Provide</h3>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700 mb-4">
                <li><strong>Account Information:</strong> When you create an account, we collect your name, email address, and password.</li>
                <li><strong>Bill Information:</strong> We store reference numbers, consumer numbers, and bill nicknames you save for quick access.</li>
                <li><strong>Contact Information:</strong> If you contact us, we may collect your name, email address, and message content.</li>
            </ul>

            <h3 class="text-xl font-semibold text-slate-800 mb-3">2.2 Automatically Collected Information</h3>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700">
                <li><strong>Usage Data:</strong> We collect information about how you access and use our website, including IP address, browser type, device information, and pages visited.</li>
                <li><strong>Cookies:</strong> We use cookies to remember your preferences and improve your experience. You can control cookies through your browser settings.</li>
            </ul>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">3. How We Use Your Information</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">We use the information we collect for the following purposes:</p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700">
                <li>To provide, maintain, and improve our bill checking services</li>
                <li>To process your bill lookups and save your reference numbers for future use</li>
                <li>To send you service-related notifications and updates</li>
                <li>To respond to your inquiries and provide customer support</li>
                <li>To analyze usage patterns and improve our website functionality</li>
                <li>To detect, prevent, and address technical issues and security threats</li>
                <li>To comply with legal obligations</li>
            </ul>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">4. Information Sharing and Disclosure</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:
            </p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700">
                <li><strong>Service Providers:</strong> We may share information with trusted third-party service providers who assist us in operating our website and conducting our business, subject to confidentiality agreements.</li>
                <li><strong>Legal Requirements:</strong> We may disclose information if required by law or in response to valid requests by public authorities.</li>
                <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred as part of that transaction.</li>
            </ul>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">5. Data Security</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee absolute security.
            </p>
            <p class="text-base text-slate-700 leading-relaxed">
                Your account password is encrypted and stored securely. We recommend using a strong, unique password and not sharing your account credentials with others.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">6. Your Rights and Choices</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">You have the following rights regarding your personal information:</p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700">
                <li><strong>Access:</strong> You can access and update your account information at any time through your dashboard.</li>
                <li><strong>Deletion:</strong> You can delete your saved bills and account at any time.</li>
                <li><strong>Cookies:</strong> You can control cookies through your browser settings, though this may affect website functionality.</li>
                <li><strong>Opt-out:</strong> You can unsubscribe from our newsletter or marketing communications at any time.</li>
            </ul>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">7. Third-Party Links</h2>
            <p class="text-base text-slate-700 leading-relaxed">
                Our website may contain links to third-party websites, including utility provider websites. We are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policies of any third-party sites you visit.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">8. Children's Privacy</h2>
            <p class="text-base text-slate-700 leading-relaxed">
                Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you believe we have collected information from a child, please contact us immediately.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">9. Changes to This Privacy Policy</h2>
            <p class="text-base text-slate-700 leading-relaxed">
                We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date. You are advised to review this Privacy Policy periodically for any changes.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">10. Contact Us</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                If you have any questions about this Privacy Policy or our data practices, please contact us:
            </p>
            <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                <p class="text-base text-slate-700 mb-2"><strong>Email:</strong> <a href="mailto:privacy@checkbill.pk" class="text-orange-600 hover:text-orange-700 underline">privacy@checkbill.pk</a></p>
                <p class="text-base text-slate-700"><strong>Website:</strong> <a href="{{ route('pages.contact') }}" class="text-orange-600 hover:text-orange-700 underline">Contact Us</a></p>
            </div>
        </section>
    </div>
</div>
@endsection

