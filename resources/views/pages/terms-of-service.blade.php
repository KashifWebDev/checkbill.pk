@extends('layouts.app')

@section('title', 'Terms of Service | CheckBill.pk')
@section('meta_description', 'CheckBill.pk terms of service. Read our terms and conditions for using our utility bill checking platform in Pakistan.')
@section('canonical', config('app.url') . '/terms-of-service')

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
                'name' => 'Terms of Service',
                'item' => $baseUrl . '/terms-of-service',
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
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-900 mb-4">Terms of Service</h1>
        <p class="text-base text-slate-600">Last updated: {{ date('F j, Y') }}</p>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-6 md:p-10 space-y-8">
        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">1. Acceptance of Terms</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                By accessing and using CheckBill.pk ("the Website" or "the Service"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
            </p>
            <p class="text-base text-slate-700 leading-relaxed">
                These Terms of Service ("Terms") govern your access to and use of CheckBill.pk, a platform for checking utility bills online in Pakistan. By using our services, you agree to comply with and be bound by these Terms.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">2. Description of Service</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                CheckBill.pk provides a free online platform that allows users to:
            </p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700">
                <li>Check utility bills (electricity, gas, internet) by reference number</li>
                <li>Download duplicate bills from various Pakistani utility providers</li>
                <li>Save reference numbers for quick access in future</li>
                <li>Access educational content and guides about utility bills</li>
            </ul>
            <p class="text-base text-slate-700 leading-relaxed mt-4">
                We act as an intermediary service and do not directly provide utility services. We facilitate access to information from utility provider systems.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">3. User Accounts</h2>
            <h3 class="text-xl font-semibold text-slate-800 mb-3">3.1 Account Creation</h3>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                To use certain features of our service, you may be required to create an account. You agree to:
            </p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700 mb-4">
                <li>Provide accurate, current, and complete information during registration</li>
                <li>Maintain and promptly update your account information</li>
                <li>Maintain the security of your password and account</li>
                <li>Accept responsibility for all activities that occur under your account</li>
                <li>Notify us immediately of any unauthorized use of your account</li>
            </ul>

            <h3 class="text-xl font-semibold text-slate-800 mb-3">3.2 Account Termination</h3>
            <p class="text-base text-slate-700 leading-relaxed">
                We reserve the right to suspend or terminate your account at any time if you violate these Terms or engage in fraudulent, abusive, or illegal activity.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">4. Acceptable Use</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">You agree not to:</p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700">
                <li>Use the service for any illegal purpose or in violation of any laws</li>
                <li>Attempt to gain unauthorized access to our systems or other users' accounts</li>
                <li>Use automated systems (bots, scrapers) to access the service without permission</li>
                <li>Interfere with or disrupt the service or servers connected to the service</li>
                <li>Transmit any viruses, malware, or harmful code</li>
                <li>Impersonate any person or entity or misrepresent your affiliation with any entity</li>
                <li>Collect or store personal data about other users without their consent</li>
            </ul>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">5. Service Availability and Accuracy</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                While we strive to provide accurate and up-to-date information, we cannot guarantee:
            </p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700">
                <li>That the service will be available at all times without interruption</li>
                <li>The accuracy, completeness, or timeliness of bill information retrieved from third-party systems</li>
                <li>That all utility providers will be supported or accessible</li>
            </ul>
            <p class="text-base text-slate-700 leading-relaxed mt-4">
                Bill information is retrieved from utility provider systems, and we are not responsible for errors or delays in their systems. Always verify bill details with your utility provider before making payments.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">6. Intellectual Property</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                The Website and its original content, features, and functionality are owned by CheckBill.pk and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.
            </p>
            <p class="text-base text-slate-700 leading-relaxed">
                You may not reproduce, distribute, modify, create derivative works of, publicly display, or otherwise use our content without our express written permission.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">7. Limitation of Liability</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                CheckBill.pk is provided "as is" and "as available" without warranties of any kind, either express or implied. We do not warrant that:
            </p>
            <ul class="list-disc list-inside space-y-2 text-base text-slate-700 mb-4">
                <li>The service will meet your requirements or be available on an uninterrupted basis</li>
                <li>The results obtained from using the service will be accurate or reliable</li>
                <li>Any errors in the service will be corrected</li>
            </ul>
            <p class="text-base text-slate-700 leading-relaxed">
                To the maximum extent permitted by law, CheckBill.pk shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from your use of the service.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">8. Indemnification</h2>
            <p class="text-base text-slate-700 leading-relaxed">
                You agree to indemnify, defend, and hold harmless CheckBill.pk, its officers, directors, employees, and agents from and against any claims, liabilities, damages, losses, and expenses, including reasonable attorney's fees, arising out of or in any way connected with your access to or use of the service or your violation of these Terms.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">9. Third-Party Services</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                Our service may contain links to third-party websites or services that are not owned or controlled by CheckBill.pk. We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third-party websites or services.
            </p>
            <p class="text-base text-slate-700 leading-relaxed">
                You acknowledge and agree that CheckBill.pk shall not be responsible or liable for any damage or loss caused by or in connection with the use of any third-party content, goods, or services.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">10. Changes to Terms</h2>
            <p class="text-base text-slate-700 leading-relaxed">
                We reserve the right to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion. Your continued use of the service after any changes constitutes acceptance of the new Terms.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">11. Governing Law</h2>
            <p class="text-base text-slate-700 leading-relaxed">
                These Terms shall be governed by and construed in accordance with the laws of Pakistan, without regard to its conflict of law provisions. Any disputes arising under or in connection with these Terms shall be subject to the exclusive jurisdiction of the courts of Pakistan.
            </p>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">12. Contact Information</h2>
            <p class="text-base text-slate-700 leading-relaxed mb-4">
                If you have any questions about these Terms of Service, please contact us:
            </p>
            <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                <p class="text-base text-slate-700 mb-2"><strong>Email:</strong> <a href="mailto:legal@checkbill.pk" class="text-orange-600 hover:text-orange-700 underline">legal@checkbill.pk</a></p>
                <p class="text-base text-slate-700"><strong>Website:</strong> <a href="{{ route('pages.contact') }}" class="text-orange-600 hover:text-orange-700 underline">Contact Us</a></p>
            </div>
        </section>
    </div>
</div>
@endsection

