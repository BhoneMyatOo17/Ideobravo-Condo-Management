@extends('layouts.app')

@section('content')
  <main class="main relative">
    <!-- Hero section -->
    <section id="legal-hero"
      class="relative overflow-hidden bg-primary text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] pb-20">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <h1
                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                Legal Notice
              </h1>

              <p class="mx-auto mb-4 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Important legal information about Ideo Condominiums and the IdeoBravo management system.
              </p>
              <p class="mx-auto text-sm text-primary-color/80">
                Last Updated: November 28, 2025
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Legal Notice Content -->
    <section id="legal-content" class="section-area">
      <div class="container">
        <div class="max-w-4xl mx-auto">

          <!-- Company Information -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">1. Company Information
            </h2>
            <div class="p-8 rounded-xl bg-body-light-1 dark:bg-primary-dark-2 shadow-card-1">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h3 class="text-lg font-semibold text-primary mb-4">Legal Entity</h3>
                  <div class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                    <p><strong class="text-body-light-12 dark:text-body-dark-12">Company Name:</strong>
                      Ideo Condominiums Co., Ltd.</p>
                    <p><strong class="text-body-light-12 dark:text-body-dark-12">Registration
                        Number:</strong> 0105xxxxxxxxx</p>
                    <p><strong class="text-body-light-12 dark:text-body-dark-12">Tax ID:</strong>
                      0105xxxxxxxxx</p>
                    <p><strong class="text-body-light-12 dark:text-body-dark-12">Type:</strong> Limited
                      Company</p>
                  </div>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-primary mb-4">Registered Address</h3>
                  <div class="text-body-light-11 dark:text-body-dark-11">
                    <span></span>Sukhumvit Road, Khlong Toei</span>
                    <p>Bangkok 10110, Kingdom of Thailand</p>
                    <p><strong class="text-body-light-12 dark:text-body-dark-12">Phone:</strong>
                      +66 2 123 4567</p>
                    <p><strong class="text-body-light-12 dark:text-body-dark-12">Email:</strong>
                      legal@ideo.co.th</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Governing Law -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">2. Governing Law and
              Jurisdiction</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                This website and the IdeoBravo management system are governed by and construed in accordance
                with the laws of the Kingdom of Thailand, including but not limited to:
              </p>
              <div class="space-y-4">
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="lni lni-certificate text-primary text-2xl"></i>
                  </div>
                  <div>
                    <h5 class="font-semibold text-body-light-12 dark:text-body-dark-12 text-lg mb-1">Condominium
                      Act B.E. 2522 (1979)</h5>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Governs condominium
                      management, resident rights, and juristic office operations</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="lni lni-protection text-primary text-2xl"></i>
                  </div>
                  <div>
                    <h5 class="font-semibold text-body-light-12 text-lg dark:text-body-dark-12 mb-1">Personal Data
                      Protection Act B.E. 2562 (2019)</h5>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Regulates collection,
                      use, and protection of personal data</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="lni lni-laptop text-primary text-2xl"></i>
                  </div>
                  <div>
                    <h5 class="font-semibold text-body-light-12 text-lg dark:text-body-dark-12 mb-1">Computer
                      Crime Act B.E. 2550 (2007)</h5>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Addresses cybersecurity
                      and unauthorized access to computer systems</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="lni lni-files text-primary text-2xl"></i>
                  </div>
                  <div>
                    <h5 class="font-semibold text-body-light-12 text-lg dark:text-body-dark-12 mb-1">Electronic
                      Transactions Act B.E. 2544 (2001)</h5>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Governs electronic
                      documents and digital signatures</p>
                  </div>
                </div>
              </div>
              <div class="mt-6 p-4 bg-primary/10 rounded-lg">
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  <strong>Jurisdiction:</strong> Any disputes arising from the system shall be
                  subject to the jurisdiction of the courts of Bangkok, Thailand.
                </p>
              </div>
            </div>
          </div>

          <!-- Intellectual Property -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">3. Intellectual
              Property Rights</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <h3 class="text-lg font-semibold text-primary mb-4">Copyright Notice</h3>
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                © 2025 Ideo Condominiums Co., Ltd. All rights reserved.
              </p>
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                All content on this website and the IdeoBravo system, including but not limited to text,
                graphics, logos, icons, images, audio clips, digital downloads, data compilations, and
                software, is the property of Ideo Condominiums or its content suppliers and is protected by
                Thai and international copyright laws.
              </p>

              <h3 class="text-lg font-semibold text-primary mb-4 mt-6">Trademarks</h3>
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                The following are trademarks or registered trademarks of Ideo Condominiums:
              </p>
              <ul class="list-disc list-inside space-y-2 text-body-light-11 dark:text-body-dark-11 ml-4">
                <li>"Ideo" brand name and logo</li>
                <li>"IdeoBravo" management system name and logo</li>
                <li>All related service marks and trade dress</li>
              </ul>

              <div class="mt-6 p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Usage Restrictions
                </h4>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  You may not reproduce, duplicate, copy, sell, resell, or exploit any portion of this
                  website or system without express written permission from Ideo Condominiums. Unauthorized
                  use may result in legal action and liability for damages.
                </p>
              </div>
            </div>
          </div>

          <!-- System Usage Terms -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">4. IdeoBravo System
              Usage Terms</h2>
            <div class="space-y-6">
              <!-- Account Access -->
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <h3 class="text-xl font-semibold text-primary mb-4">4.1 Account Access and Security</h3>
                <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Access to the IdeoBravo system is restricted to registered residents and
                      authorized staff only</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>You are responsible for maintaining the confidentiality of your login
                      credentials</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Sharing of accounts is strictly prohibited and may result in account
                      suspension</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>You must notify us immediately of any unauthorized use of your account</span>
                  </li>
                </ul>
              </div>

              <!-- Acceptable Use -->
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <h3 class="text-xl font-semibold text-primary mb-4">4.2 Acceptable Use Policy</h3>
                <p class="text-body-light-11 dark:text-body-dark-11 mb-4">You agree NOT to:</p>
                <div class="space-y-2 text-body-light-11 dark:text-body-dark-11">
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span>Use the system for any unlawful purpose or in violation of any applicable
                      laws</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span>Attempt to gain unauthorized access to any part of the system</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span>Interfere with or disrupt the system or servers</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span>Upload or transmit viruses, malware, or harmful code</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span>Scrape, data mine, or use automated tools without permission</span>
                  </div>
                  <div class="flex items-start gap-3">
                    <i class="lni lni-close text-red-500 text-lg mt-1 flex-shrink-0"></i>
                    <span>Harass, abuse, or harm other residents or staff</span>
                  </div>
                </div>
              </div>

              <!-- Service Availability -->
              <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
                <h3 class="text-xl font-semibold text-primary mb-4">4.3 Service Availability</h3>
                <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                  While we strive to maintain continuous system availability, we do not guarantee
                  uninterrupted access. The system may be unavailable due to:
                </p>
                <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11 ml-4">
                  <li class="flex items-start gap-3">
                    <i class="lni lni-cog text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Scheduled maintenance and updates</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-bolt text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Emergency repairs or technical issues</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-cloud-network text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Internet service provider or hosting issues</span>
                  </li>
                  <li class="flex items-start gap-3">
                    <i class="lni lni-thunder text-primary text-lg mt-1 flex-shrink-0"></i>
                    <span>Force majeure events beyond our control</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Limitation of Liability -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">5. Limitation of
              Liability</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2 border-l-4 border-amber-500">
              <div class="flex items-start gap-4 mb-4">
                <i class="lni lni-warning text-amber-500 text-3xl flex-shrink-0"></i>
                <div>
                  <h3 class="text-lg font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Important
                    Disclaimer</h3>
                  <p class="text-body-light-11 dark:text-body-dark-11">
                    The IdeoBravo system is provided "as is" without warranties of any kind, either express
                    or implied.
                  </p>
                </div>
              </div>

              <div class="space-y-4 mt-6">
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">No Warranty</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                    We do not warrant that the system will be error-free, secure, or available at all
                    times. We make no guarantees regarding the accuracy or completeness of information
                    provided through the system.
                  </p>
                </div>

                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Limited Liability
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                    To the maximum extent permitted by Thai law, Ideo Condominiums shall not be liable for
                    any indirect, incidental, special, consequential, or punitive damages resulting from
                    your use of or inability to use the system, including but not limited to loss of data,
                    loss of profits, or business interruption.
                  </p>
                </div>

                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Maximum Liability
                  </h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                    Our total liability to you for any claims arising from use of the system shall not
                    exceed the amount of common area fees paid by you in the three months preceding the
                    claim.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Indemnification -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">6. Indemnification</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                You agree to indemnify, defend, and hold harmless Ideo Condominiums, its officers, directors,
                employees, agents, and affiliates from and against any claims, liabilities, damages, losses,
                and expenses, including reasonable legal fees, arising out of or in any way connected with:
              </p>
              <ul class="space-y-2 text-body-light-11 dark:text-body-dark-11 ml-4">
                <li class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Your access to or use of the IdeoBravo system</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Your violation of these legal terms</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Your violation of any third-party rights</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-arrow-right text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Any content you submit through the system</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Electronic Communications -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">7. Electronic
              Communications</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                In accordance with Thailand's Electronic Transactions Act B.E. 2544 (2001):
              </p>
              <div class="space-y-4">
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-checkmark text-primary text-lg"></i>
                  </div>
                  <div>
                    <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">Consent to
                      Electronic Communications</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">By using the IdeoBravo
                      system, you consent to receive communications from us electronically, including
                      emails, system notifications, and portal messages.</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-checkmark text-primary text-lg"></i>
                  </div>
                  <div>
                    <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">Legal Effect
                    </h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Electronic communications
                      and digital signatures through the system have the same legal effect as paper
                      documents under Thai law.</p>
                  </div>
                </div>
                <div class="flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="lni lni-checkmark text-primary text-lg"></i>
                  </div>
                  <div>
                    <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-1">Digital Bills
                      and Records</h4>
                    <p class="text-body-light-11 dark:text-body-dark-11 text-sm">Digital bills, payment
                      confirmations, and other records generated by the system are legally valid
                      documents.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Third-Party Links -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">8. Third-Party Links
              and Services</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                The IdeoBravo system may contain links to third-party websites or services (such as payment
                gateways, utility providers, or delivery services). Please note:
              </p>
              <ul class="space-y-3 text-body-light-11 dark:text-body-dark-11">
                <li class="flex items-start gap-3">
                  <i class="lni lni-link text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>We are not responsible for the content, privacy policies, or practices of
                    third-party websites</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-link text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>Links are provided for convenience only and do not imply endorsement</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-link text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>You access third-party services at your own risk</span>
                </li>
                <li class="flex items-start gap-3">
                  <i class="lni lni-link text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span>We recommend reviewing the terms and privacy policies of any third-party
                    services</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Termination -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">9. Account Termination
            </h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <h3 class="text-lg font-semibold text-primary mb-4">Termination Rights</h3>
              <div class="space-y-4">
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">By Resident</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                    Your account will be automatically deactivated upon termination of your residence.
                    You may request early deactivation by contacting the juristic office.
                  </p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">By Ideo
                    Condominiums</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                    We reserve the right to suspend or terminate your account immediately if you violate
                    these terms, engage in fraudulent activity, or pose a security risk to the system or
                    other residents.
                  </p>
                </div>
                <div class="p-4 bg-body-light-2 dark:bg-primary-dark-2 rounded-lg">
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-2">Effect of
                    Termination</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                    Upon termination, you will lose access to the system and your account data may be
                    archived or deleted in accordance with our data retention policy. Outstanding
                    financial obligations remain due.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Modifications -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">10. Modifications to
              Terms</h2>
            <div class="p-6 rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-4">
                Ideo Condominiums reserves the right to modify these legal terms at any time. When we make
                changes:
              </p>
              <div class="space-y-3">
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">We will update the "Last Updated"
                    date at the top of this page</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Material changes will be notified
                    via email or system notification</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">Continued use of the system after
                    modifications constitutes acceptance</span>
                </div>
                <div class="flex items-start gap-3">
                  <i class="lni lni-checkmark-circle text-primary text-lg mt-1 flex-shrink-0"></i>
                  <span class="text-body-light-11 dark:text-body-dark-11">You should review this page
                    periodically for updates</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="scroll-revealed mb-12">
            <h2 class="text-2xl font-bold mb-6 text-body-light-12 dark:text-body-dark-12">11. Contact Information
            </h2>
            <div
              class="p-8 rounded-xl bg-gradient-to-br from-primary/10 to-primary/5 border-l-4 border-primary shadow-card-2">
              <p class="text-body-light-11 dark:text-body-dark-11 mb-6">
                For questions, concerns, or legal inquiries regarding these terms or the IdeoBravo system,
                please contact:
              </p>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-3">Legal Department
                  </h4>
                  <div class="space-y-2">
                    <p class="text-body-light-11 dark:text-body-dark-11 flex items-center gap-2">
                      <i class="lni lni-envelope text-primary"></i>
                      <a href="mailto:legal@ideo.co.th" class="hover:text-primary">legal@ideo.co.th</a>
                    </p>
                    <p class="text-body-light-11 dark:text-body-dark-11 flex items-center gap-2">
                      <i class="lni lni-phone text-primary"></i>
                      +66 2 123 4567 (ext. 101)
                    </p>
                  </div>
                </div>
                <div>
                  <h4 class="font-semibold text-body-light-12 dark:text-body-dark-12 mb-3">Office Hours</h4>
                  <p class="text-body-light-11 dark:text-body-dark-11">
                    Monday - Friday: 9:00 AM - 6:00 PM<br />
                    Saturday: 9:00 AM - 1:00 PM<br />
                    Sunday & Public Holidays: Closed
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Acknowledgment -->
          <div class="scroll-revealed">
            <div class="p-6 rounded-xl bg-primary/5 border border-primary/20">
              <div class="flex items-start gap-4">
                <i class="lni lni-checkmark-circle text-primary text-2xl flex-shrink-0"></i>
                <p class="text-body-light-11 dark:text-body-dark-11 text-sm">
                  <strong>Important:</strong> By accessing and using the IdeoBravo system, you acknowledge
                  that you have read, understood, and agree to be bound by these legal terms. If you do not
                  agree with any part of these terms, you must not use the system. For Thai residents,
                  these terms shall be interpreted in accordance with Thai law in case of any translation
                  discrepancies.
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