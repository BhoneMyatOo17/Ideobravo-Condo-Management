@extends('layouts.app')

@section('content')
  <main class="main relative">
    <!-- Hero section -->
    <section id="terms-hero"
      class="relative overflow-hidden bg-primary text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] pb-20">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <h1
                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                Terms of Service
              </h1>

              <p class="mx-auto mb-4 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Please read these terms carefully before using the IdeoBravo management system.
              </p>
              <p class="mx-auto text-sm text-primary-color/80">
                Last Updated: December 1, 2025
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Terms Content -->
    <section id="terms-content" class="section-area">
      <div class="container">
        <div class="max-w-4xl mx-auto">

          <!-- Introduction -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">1. Introduction</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                Welcome to IdeoBravo. These Terms of Service ("Terms") govern your access to and use of the IdeoBravo
                platform, including our website, mobile applications, and related services (collectively, the "Services").
                By accessing or using our Services, you agree to be bound by these Terms.
              </p>
              <p class="text-body-light-11 dark:text-body-dark-11">
                If you do not agree to these Terms, please do not use our Services. IdeoBravo is operated by Ideo
                Condominiums and is designed to facilitate condominium management, billing, parcel tracking, and
                resident communications.
              </p>
            </div>
          </div>

          <!-- Eligibility -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">2. Eligibility</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                To use IdeoBravo, you must be:
              </p>
              <div class="space-y-3">
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">A registered resident of an Ideo condominium
                    property</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">An authorized staff member of Ideo
                    management</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">At least 18 years of age</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Capable of forming a binding contract under
                    applicable law</span>
                </div>
              </div>
              <div class="mt-4 p-4 bg-primary/10 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  By creating an account, you represent and warrant that you meet these eligibility requirements.
                </p>
              </div>
            </div>
          </div>

          <!-- Account Registration -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">3. Account Registration and
              Security</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                When you create an account with IdeoBravo, you must provide accurate, complete, and current information.
                You are responsible for:
              </p>
              <div class="space-y-3">
                <div class="flex items-start gap-3">
                  <i class="lni lni-lock text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Maintaining the confidentiality of your account
                    credentials</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-user text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">All activities that occur under your
                    account</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-alarm text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Notifying us immediately of any unauthorized
                    access or security breaches</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-pencil text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Updating your account information to keep it
                    accurate and current</span>
                </div>
              </div>
              <div class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-500 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  <strong>Note:</strong> IdeoBravo reserves the right to suspend or terminate accounts that violate these
                  Terms or are inactive for extended periods.
                </p>
              </div>
            </div>
          </div>

          <!-- Acceptable Use -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">4. Acceptable Use Policy</h2>
            <div class="space-y-6">
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                  You agree to use IdeoBravo only for lawful purposes and in accordance with these Terms. You agree NOT
                  to:
                </p>
                <div class="space-y-2">
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span class="text-body-light-11 dark:text-body-dark-11">Use the Services in any way that violates
                      applicable local, national, or international law</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span class="text-body-light-11 dark:text-body-dark-11">Impersonate any person or entity, or falsely
                      state or misrepresent your affiliation</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span class="text-body-light-11 dark:text-body-dark-11">Engage in any conduct that restricts or
                      inhibits anyone's use of the Services</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span class="text-body-light-11 dark:text-body-dark-11">Attempt to gain unauthorized access to any
                      portion of the Services or other systems</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span class="text-body-light-11 dark:text-body-dark-11">Introduce viruses, malware, or any other
                      malicious code</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span class="text-body-light-11 dark:text-body-dark-11">Harass, abuse, or harm other residents or
                      staff members</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span class="text-body-light-11 dark:text-body-dark-11">Use automated systems to access the Services
                      without permission</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Billing and Payments -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">5. Billing and Payments</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                IdeoBravo facilitates the delivery and management of condominium-related bills, including but not limited
                to:
              </p>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="flex items-center gap-3 p-3 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <i class="lni lni-home text-primary text-xl"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11 text-sm">Monthly maintenance fees</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <i class="lni lni-drop text-primary text-xl"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11 text-sm">Utility bills (electricity,
                    water)</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <i class="lni lni-shield text-primary text-xl"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11 text-sm">Insurance premiums</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <i class="lni lni-information text-primary text-xl"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11 text-sm">Special assessments</span>
                </div>
              </div>

              <h3 class="text-lg font-semibold text-primary mb-4">By using our billing features, you acknowledge that:
              </h3>
              <div class="space-y-3">
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">All bills displayed on the platform are
                    accurate reflections of amounts owed</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">You are responsible for timely payment of all
                    charges</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Payment confirmations are subject to
                    verification by Ideo management</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Late payment fees may apply as per your
                    condominium agreement</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Privacy and Data -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">6. Privacy and Data Protection
            </h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                Your privacy is important to us. IdeoBravo collects, processes, and stores personal information in
                accordance with:
              </p>
              <div class="space-y-4">
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="lni lni-protection text-primary text-2xl"></i>
                  </div>
                  <div>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">Thailand's Personal Data
                      Protection Act (PDPA)</h5>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Compliance with Thai data protection
                      regulations</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="lni lni-world text-primary text-2xl"></i>
                  </div>
                  <div>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">General Data Protection
                      Regulation (GDPR)</h5>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">For EU residents and international
                      standards</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="lni lni-files text-primary text-2xl"></i>
                  </div>
                  <div>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">Our Privacy Policy</h5>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Detailed information available
                      separately</p>
                  </div>
                </div>
              </div>
              <div class="mt-6 p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  We implement appropriate security measures to protect your personal information. However, no method of
                  transmission over the internet is 100% secure. For detailed information about how we handle your data,
                  please review our Privacy Policy.
                </p>
              </div>
            </div>
          </div>

          <!-- Parcel Management -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">7. Parcel Management Services
            </h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                IdeoBravo provides parcel tracking and pickup confirmation services. You acknowledge that:
              </p>
              <div class="space-y-3">
                <div class="flex items-start gap-3">
                  <i class="lni lni-package text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Parcel notifications are provided as a
                    convenience service</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-alarm-clock text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">You are responsible for collecting your parcels
                    in a timely manner</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-id-card text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Proper identification may be required for
                    parcel pickup</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-shield text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Ideo is not liable for lost, damaged, or
                    stolen parcels once properly delivered to the building</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-folder text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Unclaimed parcels may be subject to storage
                    fees or disposal after a specified period</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Intellectual Property -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">8. Intellectual Property
              Rights</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                  <i class="lni lni-files text-primary text-2xl"></i>
                </div>
                <div>
                  <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                    The IdeoBravo platform, including its original content, features, and functionality, is owned by
                    Ideo Condominiums and is protected by international copyright, trademark, and other intellectual
                    property laws.
                  </p>
                  <p class="text-body-light-11 dark:text-body-dark-11">
                    You may not copy, modify, distribute, sell, or lease any part of our Services without express written
                    permission from Ideo Condominiums.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Limitation of Liability -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">9. Limitation of Liability
            </h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2 border-l-4 border-amber-500">
              <div class="flex items-start gap-4 mb-4">
                <i class="lni lni-warning text-amber-500 text-3xl flex-shrink-0"></i>
                <div>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Important Disclaimer
                  </h3>
                  <p class="text-body-light-11 dark:text-body-dark-11">
                    To the maximum extent permitted by law, Ideo Condominiums shall not be liable for:
                  </p>
                </div>
              </div>

              <div class="space-y-3 ml-12">
                <div class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-amber-500 text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Any indirect, incidental, special, or
                    consequential damages</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-amber-500 text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Loss of profits, data, or goodwill</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-amber-500 text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Service interruptions or technical
                    failures</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-amber-500 text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Unauthorized access to your account due to your
                    negligence</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-amber-500 text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Third-party services or payment
                    processors</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Changes to Terms -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">10. Changes to Terms</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                We reserve the right to modify these Terms at any time. When we make changes, we will:
              </p>
              <div class="space-y-3">
                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-calendar text-primary text-sm"></i>
                  </div>
                  <span class="text-body-light-11 dark:text-body-dark-11">Update the "Last Updated" date at the top of
                    this page</span>
                </div>
                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-envelope text-primary text-sm"></i>
                  </div>
                  <span class="text-body-light-11 dark:text-body-dark-11">Notify you through the platform or via
                    email</span>
                </div>
                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-timer text-primary text-sm"></i>
                  </div>
                  <span class="text-body-light-11 dark:text-body-dark-11">Provide at least 30 days' notice for material
                    changes</span>
                </div>
              </div>
              <div class="mt-6 p-4 bg-primary/10 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  Your continued use of the Services after changes take effect constitutes acceptance of the revised
                  Terms.
                </p>
              </div>
            </div>
          </div>

          <!-- Termination -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">11. Termination</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                We may terminate or suspend your account and access to the Services immediately, without prior notice, if
                you:
              </p>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <div class="flex items-center gap-3 mb-2">
                    <i class="lni lni-close text-red-500 text-xl"></i>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12">Policy Breach</h5>
                  </div>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Breach these Terms of Service</p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <div class="flex items-center gap-3 mb-2">
                    <i class="lni lni-warning text-red-500 text-xl"></i>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12">Illegal Activity</h5>
                  </div>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Engage in fraudulent or illegal
                    activities</p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <div class="flex items-center gap-3 mb-2">
                    <i class="lni lni-home text-red-500 text-xl"></i>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12">Non-Residence</h5>
                  </div>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Are no longer a resident of an Ideo
                    property</p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <div class="flex items-center gap-3 mb-2">
                    <i class="lni lni-ban text-red-500 text-xl"></i>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12">Account Deletion</h5>
                  </div>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Request account deletion</p>
                </div>
              </div>
              <div class="mt-4 p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  Upon termination, your right to use the Services will immediately cease. All provisions of these Terms
                  that by their nature should survive termination shall survive.
                </p>
              </div>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">12. Contact Information</h2>
            <div
              class="p-8 rounded-xl bg-gradient-to-br from-primary/10 to-primary/5 border-l-4 border-primary shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                If you have any questions about these Terms of Service, please contact us:
              </p>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-3">Support Team</h4>
                  <div class="space-y-2">
                    <p class="text-body-light-11 dark:text-body-dark-11 flex items-center gap-2">
                      <i class="lni lni-envelope text-primary"></i>
                      <a href="mailto:support@ideobravo.com" class="hover:text-primary">support@ideobravo.com</a>
                    </p>
                    <p class="text-body-light-11 dark:text-body-dark-11 flex items-center gap-2">
                      <i class="lni lni-phone text-primary"></i>
                      +66 (0) 2-123-4567
                  </div>
                </div>
                <div>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-3">Office Location</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11">
                    Ideo Condominiums Management Office<br />
                    Sukhumvit Road, Bangkok<br />
                    Kingdom of Thailand
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Agreement -->
          <div class="scroll-revealed">
            <div class="p-6 rounded-xl bg-primary/5 border border-primary/20">
              <div class="flex items-start gap-4">
                <i class="lni lni-checkmark-circle text-primary text-2xl flex-shrink-0"></i>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  <strong>By using IdeoBravo, you acknowledge that you have read, understood, and agree to be bound by
                    these Terms of Service.</strong> If you do not agree with any part of these terms, you must
                  discontinue use of the platform immediately.
                </p>
              </div>
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