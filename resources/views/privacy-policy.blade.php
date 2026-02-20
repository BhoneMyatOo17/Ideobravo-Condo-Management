@extends('layouts.app')

@section('content')
  <main class="main relative">
    <!-- Hero section -->
    <section id="privacy-hero"
      class="relative overflow-hidden bg-primary text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] pb-20">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <h1
                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                Privacy Policy
              </h1>

              <p class="mx-auto mb-4 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Your privacy is important to us. This policy outlines how Ideo Condominiums collects, uses,
                and protects your personal information.
              </p>
              <p class="mx-auto text-sm text-primary-color/80">
                Last Updated: December 28, 2025
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Privacy Policy Content -->
    <section id="privacy-content" class="section-area">
      <div class="container">
        <div class="max-w-4xl mx-auto">

          <!-- Introduction -->
          <div class="scroll-revealed mb-12">
            <div class="p-8 rounded-xl bg-body-light-1 dark:bg-primary-dark-2 shadow-card-1 border-l-4 border-primary">
              <h2 class="text-2xl font-bold mb-4 text-body-light-12 dark:text-body-dark-12">Introduction</h2>
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                Ideo Condominiums ("we," "us," or "our") is committed to protecting the privacy and security
                of your personal information. This privacy policy page explains how we collect, use, disclose, and
                safeguard your information in compliance with:
              </p>
              <ul class="list-disc list-inside space-y-2 text-body-light-11 dark:text-body-dark-11 ml-4">
                <li><a class="hover:underline" href="https://pdpathailand.com/pdpa/index_eng.html"
                    target="_blank">Thailand's Personal Data Protection Act B.E. 2562 (2019) (PDPA)</a></li>
                <li><a class="hover:underline" href="https://gdpr-info.eu/" target="_blank">General Data Protection
                    Regulation (GDPR) where applicable</a></li>
                <li><a class="hover:underline"
                    href="https://library.siam-legal.com/condominium-act-b-e-2522-1979-as-amended-2008/"
                    target="_blank">Thailand Condominium Act B.E. 2522 (1979) and amendments</a></li>
              </ul>
            </div>
          </div>

          <!-- Data Controller -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">1. Data
              Controller
            </h2>
            <div class="p-6 border-l-4 border-teal-400 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                The data controller responsible for your personal information is:
              </p>
              <div class="bg-body-light-2 dark:bg-primary-dark-2 p-6 rounded-lg">
                <p class="text-body-light-12 dark:text-body-dark-12 font-semibold mb-2">Ideo Condominiums
                </p>
                <p class="text-body-light-11 dark:text-body-dark-11">Sukhumvit Road, Khlong Toei</p>
                <p class="text-body-light-11 dark:text-body-dark-11">Bangkok 10110, Thailand</p>
                <p class="text-body-light-11 dark:text-body-dark-11 mt-2">Email: privacy@ideo.co.th</p>
                <p class="text-body-light-11 dark:text-body-dark-11">Phone: +66 2 123 4567</p>
              </div>
            </div>
          </div>

          <!-- Information We Collect -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">2. Information We
              Collect</h2>
            <div class="space-y-6 ">
              <!-- Personal Identification -->
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <h3 class="text-xl font-semibold mb-4 text-primary">2.1 Personal Identification Information
                </h3>
                <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Full name, date of birth, and nationality</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>National ID card or passport number</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Contact information (phone number, email address, residential address)</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Emergency contact information</span>
                  </li>
                </ul>
              </div>

              <!-- Residence Information -->
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <h3 class="text-xl font-semibold mb-4 text-primary">2.2 Residence Information</h3>
                <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Unit number and property ownership details</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Move-in/move-out dates and lease agreements</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Vehicle registration information for parking management</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Access card and biometrics data for property access</span>
                  </li>
                </ul>
              </div>

              <!-- Financial Information -->
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <h3 class="text-xl font-semibold mb-4 text-primary">2.3 Financial Information</h3>
                <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Payment records and billing information</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Utility consumption data (electricity, water)</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Common area maintenance fees</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Bank account information and transaction records (Only related to condo)</span>
                  </li>
                </ul>
              </div>

              <!-- Technical Information -->
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <h3 class="text-xl font-semibold mb-4 text-primary">2.4 Technical and Usage Information</h3>
                <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>CCTV footage and access control logs for security purposes</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Parcel delivery and pickup information</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Facility booking and usage records</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Website and portal usage data (IP address, browser type, access times)</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Legal Basis for Processing -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">3. Legal Basis for
              Processing</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                Under Thailand's PDPA and GDPR, we process your personal data based on the following legal
                grounds:
              </p>
              <div class="space-y-4">
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-files text-primary text-lg"></i>
                  </div>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Contractual
                      Necessity</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Processing necessary for
                      the performance of your residence contract and juristic office management</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-certificate text-primary text-lg"></i>
                  </div>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Legal
                      Obligation</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Compliance with Thailand
                      Condominium Act and other applicable laws</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-protection text-primary text-lg"></i>
                  </div>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Legitimate
                      Interests</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Ensuring building
                      security, preventing fraud, and maintaining property standards</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-checkmark-circle text-primary text-lg"></i>
                  </div>
                  <div>
                    <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1 text-lg">Consent</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">For marketing
                      communications and optional services where you have provided explicit consent</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- How We Use Your Information -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">4. How We Use Your
              Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <div class="flex items-center gap-3 mb-4">
                  <i
                    class="lni lni-home w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary text-2xl"></i>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12">Residence
                    Management</h3>
                </div>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Managing your residence account,
                  access rights, and unit-related services</p>
              </div>

              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <div class="flex items-center gap-3 mb-4">
                  <i
                    class="lni lni-revenue w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary text-2xl"></i>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12">Billing & Payments</h3>
                </div>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Processing payments, generating
                  bills, and maintaining financial records</p>
              </div>

              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <div class="flex items-center gap-3 mb-4">
                  <i
                    class="lni lni-shield w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary text-2xl"></i>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12">Security
                  </h3>
                </div>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Monitoring building security,
                  controlling access, and ensuring resident safety</p>
              </div>

              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <div class="flex items-center gap-3 mb-4">
                  <i
                    class="lni lni-package w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary text-2xl"></i>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12">Parcel
                    Management</h3>
                </div>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Recording, storing, and
                  notifying residents about delivered packages</p>
              </div>

              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <div class="flex items-center gap-3 mb-4">
                  <i
                    class="lni lni-bullhorn w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary text-2xl"></i>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12">Communication
                  </h3>
                </div>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Sending important announcements,
                  maintenance notices, and emergency alerts</p>
              </div>

              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <div class="flex items-center gap-3 mb-4">
                  <i
                    class="lni lni-cog w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary text-2xl"></i>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12">Service
                    Improvement</h3>
                </div>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Analyzing usage patterns to
                  improve facilities and services</p>
              </div>
            </div>
          </div>

          <!-- Data Sharing -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">5. Data Sharing and
              Disclosure</h2>
            <div class="p-6 rounded-xl border-l-4 border-primary bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                We do not sell your personal information. We may share your data with:
              </p>
              <div class="space-y-4">
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Service
                    Providers</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Utilities companies,
                    maintenance contractors, and IT service providers under strict confidentiality
                    agreements</p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Legal Authorities
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">When required by Thai law or
                    court order, or to protect rights and safety</p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Juristic Office
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Condominium management office
                    as required by Thailand Condominium Act</p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Emergency Services
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Police, fire department, or
                    medical services in emergency situations</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Security -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">6. Data Security</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                We implement appropriate technical and organizational security measures to protect your
                personal data:
              </p>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4">
                  <i
                    class="lni lni-lock text-primary text-4xl mb-3 w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto"></i>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Encryption</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">SSL/TLS encryption for data in
                    transit</p>
                </div>
                <div class="text-center p-4">
                  <i
                    class="lni lni-keyword-research text-primary text-4xl mb-3 w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto"></i>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Access Control
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Restricted access to
                    authorized personnel only</p>
                </div>
                <div class="text-center p-4">
                  <i
                    class="lni lni-database text-primary text-4xl mb-3 w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto"></i>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Regular Backups
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Secure data backup and
                    disaster recovery procedures</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Retention -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">7. Data Retention</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                We retain your personal data for as long as necessary to fulfill the purposes outlined in this
                policy:
              </p>
              <div class="space-y-3">
                <div class="flex items-center gap-3">
                  <i class="lni lni-timer text-primary text-xl flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11"><strong>Active Residence:</strong>
                    Duration of your residence plus 1 year</span>
                </div>
                <div class="flex items-center gap-3">
                  <i class="lni lni-timer text-primary text-xl flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11"><strong>Financial Records:</strong>
                    10 years (as required by Thai accounting laws)</span>
                </div>
                <div class="flex items-center gap-3">
                  <i class="lni lni-timer text-primary text-xl flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11"><strong>CCTV Footage:</strong> 30
                    days (90 days for incident-related footage)</span>
                </div>
                <div class="flex items-center gap-3">
                  <i class="lni lni-timer text-primary text-xl flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11"><strong>Access Logs:</strong> 1
                    year for security purposes</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Your Rights -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">8. Your Rights</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2 border-l-4 border-primary">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                Under Thailand's PDPA and GDPR, you have the following rights regarding your personal data:
              </p>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3">
                  <i class="lni lni-eye text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Right to
                      Access</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Request a copy of your
                      personal data we hold</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-pencil text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Right to
                      Rectification</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Correct inaccurate or
                      incomplete information</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-ban text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Right to
                      Erasure</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Request deletion of your
                      data</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-ban text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Right to
                      Restrict Processing</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Limit how we use your
                      data in certain circumstances</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-share text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-body-light-12 text-lg dark:text-body-dark-12 mb-1">Right to Data
                      Portability</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Receive your data in a
                      structured format</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-close text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Right to Object
                    </h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Object to processing based
                      on legitimate interests</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-unlink text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Right to
                      Withdraw Consent</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Withdraw consent for
                      processing at any time</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-users text-primary text-xl mt-1 flex-shrink-0"></i>
                  <div>
                    <h4 class="font-semibold text-lg text-body-light-12 dark:text-body-dark-12 mb-1">Right to Lodge
                      a Complaint</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">File a complaint with the
                      supervisory authority</p>
                  </div>
                </div>
              </div>
              <div class="mt-6 p-4 bg-primary/10 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  <strong>To exercise your rights,</strong> please contact our Data Protection Officer at
                  <u class="cursor-pointer">privacy@ideo.co.th</u> or call +66 2 123 4567. We will respond to your request
                  within 3 working days.
                </p>
              </div>
            </div>
          </div>

          <!-- International Transfers -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">9. International Data
              Transfers</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                Your data is primarily stored and processed in Thailand. If we transfer data internationally,
                we ensure:
              </p>
              <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                <li class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>The destination country has adequate data protection laws</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Standard contractual clauses approved by Thai and EU authorities are in place</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Your explicit consent has been obtained where required</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Cookies -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">10. Cookies and
              Tracking Technologies</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                Our website uses cookies and similar technologies to improve your experience. We use:
              </p>
              <div class="space-y-3">
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">Essential Cookies
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Required for website
                    functionality and security</p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">Performance
                    Cookies</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Help us understand how you
                    use our website (with your consent)</p>
                </div>
              </div>
              <p class="text-body-light-11 dark:text-body-dark-11 mt-4 text-sm">
                You can manage cookie preferences through your browser settings.
              </p>
            </div>
          </div>

          <!-- Children's Privacy -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">11. Children's Privacy
            </h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11">
                Our services are not directed to individuals under 18 years of age. If we become aware that we
                have collected personal data from a child under 18 without parental consent, we will take
                steps to delete such information. Parents or guardians who believe we have collected
                information from their child should contact us immediately.
              </p>
            </div>
          </div>

          <!-- Updates to Policy -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">12. Updates to This
              Policy</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                We may update this Privacy Policy to reflect changes in our practices or
                legal requirements. We will:
              </p>
              <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                <li class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Post the updated policy on our website with a new "Last Updated" date</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Notify you via email or resident portal for material changes</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Obtain your consent where required by law</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">13. Contact Us</h2>
            <div
              class="p-8 rounded-xl bg-gradient-to-br from-primary/10 to-primary/5 border-l-4 border-primary shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                If you have questions, concerns, or requests regarding this Privacy Policy or our data
                practices, please contact:
              </p>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-3">Data Protection
                    Officer</h4>
                  <div class="space-y-2">
                    <p class="text-body-light-11 dark:text-body-dark-11 flex items-center gap-2">
                      <i class="lni lni-envelope text-primary"></i>
                      <a href="mailto:privacy@ideo.co.th" class="hover:text-primary">privacy@ideo.co.th</a>
                    </p>
                    <p class="text-body-light-11 dark:text-body-dark-11 flex items-center gap-2">
                      <i class="lni lni-phone text-primary"></i>
                      +66 2 123 4567
                    </p>
                  </div>
                </div>
                <div>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-3">Mailing Address
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11">
                    Data Protection Officer<br />
                    Ideo Condominiums<br />
                    Sukhumvit Road, Khlong Toei<br />
                    Bangkok 10110, Thailand
                  </p>
                </div>
              </div>
              <div class="mt-6 p-4 bg-white/50 dark:bg-black/20 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  <strong>Supervisory Authority:</strong> If you believe your data protection rights have
                  been violated, you may file a complaint with Thailand's Personal Data Protection
                  Committee (PDPC) at <a href="https://www.pdpc.or.th"
                    class="text-primary hover:underline">www.pdpc.or.th</a>
                </p>
              </div>
            </div>
          </div>

          <!-- Acknowledgment -->
          <div class="scroll-revealed">
            <div class="p-6 rounded-xl bg-primary/5 border border-primary/20">
              <p class="text-body-light-11 dark:text-body-dark-11 text-sm text-center">
                By using our services and continuing your residence at Ideo Condominiums, you acknowledge that
                you have read, understood, and agree to be bound by this Privacy Policy.
              </p>
            </div>
          </div>
          <!-- Back Button -->
          <div class="mt-8 text-center">
            <a href="{{ route('welcome') }}"
              class="inline-flex items-center justify-center gap-2 rounded-md bg-primary text-primary-color px-6 py-3 text-center text-base font-medium hover:bg-primary-light-10 hover:text-white dark:hover:bg-primary-dark-10">
              <i class="lni lni-arrow-left"></i>
              Back to Home
            </a>
          </div>
        </div>
      </div>
    </section>

  </main>
@endsection