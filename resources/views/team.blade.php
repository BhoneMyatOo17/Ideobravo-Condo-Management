@extends('layouts.app')

@section('content')
  <main class="main relative">
    <!-- Hero section -->
    <section id="team-hero"
      class="relative overflow-hidden bg-primary bg-rings text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] pb-20">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <h1
                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                Meet Our Expert Team
              </h1>

              <p class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Dedicated professionals committed to delivering exceptional service and maintaining the highest
                standards across all Ideo properties in Bangkok.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Leadership Team section -->
    <section id="leadership" class="section-area">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
          <h6 class="mb-2 block text-lg font-semibold text-primary">Leadership</h6>
          <h2 class="mb-6">Our Management Team</h2>
          <p>
            Experienced leaders driving innovation and excellence in condominium management across Bangkok's
            premier residential properties.
          </p>
        </div>

        <div class="row">
          <div class="scroll-revealed col-12 sm:col-6 md:col-4 lg:col-3">
            <figure
              class="group rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 px-5 pb-10 pt-12 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="relative z-10 mx-auto mb-5 h-[120px] w-[120px]">
                <img src="{{ asset('images/avatar/avatar-1.jpg') }}" alt="Team Member"
                  class="h-full w-full rounded-full object-cover" />
                <span
                  class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-red-500 opacity-0 group-hover:opacity-100"></span>
                <span
                  class="absolute top-0 right-0 -z-10 h-10 w-10 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100"></span>
              </div>
              <figcaption class="text-center block">
                <h4 class="mb-1 text-lg font-semibold text-body-light-12 dark:text-body-dark-12">
                  Somchai Tanaka
                </h4>
                <p class="mb-3 text-sm text-primary font-medium">
                  Chief Operating Officer
                </p>
                <p class="mb-5 text-xs text-body-light-11 dark:text-body-dark-11">
                  15+ years in property management, specializing in luxury residential operations and digital
                  transformation.
                </p>
                <div class="flex items-center justify-center gap-5">
                  <a href="javascript:void(0)" class="text-body-light-10 dark:text-body-dark-10 hover:text-primary">
                    <i class="lni lni-linkedin-original"></i>
                  </a>
                </div>
              </figcaption>
            </figure>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4 lg:col-3">
            <figure
              class="group rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 px-5 pb-10 pt-12 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="relative z-10 mx-auto mb-5 h-[120px] w-[120px]">
                <img src="{{ asset('images/avatar/avatar-2.jpg') }}" alt="Team Member"
                  class="h-full w-full rounded-full object-cover" />
                <span
                  class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-red-500 opacity-0 group-hover:opacity-100"></span>
                <span
                  class="absolute top-0 right-0 -z-10 h-10 w-10 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100"></span>
              </div>
              <figcaption class="text-center block">
                <h4 class="mb-1 text-lg font-semibold text-body-light-12 dark:text-body-dark-12">
                  Niran Patel
                </h4>
                <p class="mb-3 text-sm text-primary font-medium">
                  Head of Property Management
                </p>
                <p class="mb-5 text-xs text-body-light-11 dark:text-body-dark-11">
                  Expert in facility operations with comprehensive knowledge of Thai condominium regulations and best
                  practices.
                </p>
                <div class="flex items-center justify-center gap-5">
                  <a href="javascript:void(0)" class="text-body-light-10 dark:text-body-dark-10 hover:text-primary">
                    <i class="lni lni-linkedin-original"></i>
                  </a>
                </div>
              </figcaption>
            </figure>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4 lg:col-3">
            <figure
              class="group rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 px-5 pb-10 pt-12 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="relative z-10 mx-auto mb-5 h-[120px] w-[120px]">
                <img src="{{ asset('images/avatar/avatar-3.jpg') }}" alt="Team Member"
                  class="h-full w-full rounded-full object-cover" />
                <span
                  class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-red-500 opacity-0 group-hover:opacity-100"></span>
                <span
                  class="absolute top-0 right-0 -z-10 h-10 w-10 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100"></span>
              </div>
              <figcaption class="text-center block">
                <h4 class="mb-1 text-lg font-semibold text-body-light-12 dark:text-body-dark-12">
                  Apinya Wong
                </h4>
                <p class="mb-3 text-sm text-primary font-medium">
                  Resident Services Manager
                </p>
                <p class="mb-5 text-xs text-body-light-11 dark:text-body-dark-11">
                  Dedicated to resident satisfaction with multilingual support expertise and community engagement
                  leadership.
                </p>
                <div class="flex items-center justify-center gap-5">
                  <a href="javascript:void(0)" class="text-body-light-10 dark:text-body-dark-10 hover:text-primary">
                    <i class="lni lni-linkedin-original"></i>
                  </a>
                </div>
              </figcaption>
            </figure>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4 lg:col-3">
            <figure
              class="group rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 px-5 pb-10 pt-12 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="relative z-10 mx-auto mb-5 h-[120px] w-[120px]">
                <img src="{{ asset('images/avatar/avatar-4.jpg') }}" alt="Team Member"
                  class="h-full w-full rounded-full object-cover" />
                <span
                  class="absolute bottom-0 left-0 -z-10 h-10 w-10 rounded-full bg-red-500 opacity-0 group-hover:opacity-100"></span>
                <span
                  class="absolute top-0 right-0 -z-10 h-10 w-10 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100"></span>
              </div>
              <figcaption class="text-center block">
                <h4 class="mb-1 text-lg font-semibold text-body-light-12 dark:text-body-dark-12">
                  Michael Chen
                </h4>
                <p class="mb-3 text-sm text-primary font-medium">
                  Technology Director
                </p>
                <p class="mb-5 text-xs text-body-light-11 dark:text-body-dark-11">
                  Leading digital innovation in property management systems with focus on resident-centered technology
                  solutions.
                </p>
                <div class="flex items-center justify-center gap-5">
                  <a href="javascript:void(0)" class="text-body-light-10 dark:text-body-dark-10 hover:text-primary">
                    <i class="lni lni-linkedin-original"></i>
                  </a>
                </div>
              </figcaption>
            </figure>
          </div>
        </div>
      </div>
    </section>

    <!-- Department Heads section -->
    <section id="departments" class="section-area">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
          <h6 class="mb-2 block text-lg font-semibold text-primary">Department Leads</h6>
          <h2 class="mb-6">Specialized Excellence</h2>
          <p>
            Department heads ensuring operational excellence and superior service delivery across all Ideo properties.
          </p>
        </div>

        <div class="row">
          <div class="scroll-revealed col-12 sm:col-6 md:col-4">
            <div
              class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 p-6 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="flex items-start gap-4">
                <div
                  class="w-[60px] h-[60px] rounded-lg flex-shrink-0 flex items-center justify-center text-[24px]/none bg-primary text-primary-color">
                  <i class="lni lni-shield"></i>
                </div>
                <div>
                  <h4 class="text-lg font-semibold mb-1 text-body-light-12 dark:text-body-dark-12">
                    Prateep Kumar
                  </h4>
                  <p class="text-sm text-primary font-medium mb-2">Security Operations Manager</p>
                  <p class="text-sm text-body-light-11 dark:text-body-dark-11">
                    Oversees 24/7 security protocols, emergency response systems, and resident safety initiatives across
                    all properties.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4">
            <div
              class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 p-6 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="flex items-start gap-4">
                <div
                  class="w-[60px] h-[60px] rounded-lg flex-shrink-0 flex items-center justify-center text-[24px]/none bg-primary text-primary-color">
                  <i class="lni lni-cog"></i>
                </div>
                <div>
                  <h4 class="text-lg font-semibold mb-1 text-body-light-12 dark:text-body-dark-12">
                    Somboon Lee
                  </h4>
                  <p class="text-sm text-primary font-medium mb-2">Maintenance & Engineering Lead</p>
                  <p class="text-sm text-body-light-11 dark:text-body-dark-11">
                    Manages building systems, preventive maintenance programs, and technical upgrades ensuring optimal
                    facility performance.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4">
            <div
              class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 p-6 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="flex items-start gap-4">
                <div
                  class="w-[60px] h-[60px] rounded-lg flex-shrink-0 flex items-center justify-center text-[24px]/none bg-primary text-primary-color">
                  <i class="lni lni-files"></i>
                </div>
                <div>
                  <h4 class="text-lg font-semibold mb-1 text-body-light-12 dark:text-body-dark-12">
                    Ratana Singh
                  </h4>
                  <p class="text-sm text-primary font-medium mb-2">Finance & Billing Manager</p>
                  <p class="text-sm text-body-light-11 dark:text-body-dark-11">
                    Responsible for financial operations, billing systems, and transparent budget management for resident
                    satisfaction.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4">
            <div
              class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 p-6 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="flex items-start gap-4">
                <div
                  class="w-[60px] h-[60px] rounded-lg flex-shrink-0 flex items-center justify-center text-[24px]/none bg-primary text-primary-color">
                  <i class="lni lni-package"></i>
                </div>
                <div>
                  <h4 class="text-lg font-semibold mb-1 text-body-light-12 dark:text-body-dark-12">
                    Navin Park
                  </h4>
                  <p class="text-sm text-primary font-medium mb-2">Parcel Services Coordinator</p>
                  <p class="text-sm text-body-light-11 dark:text-body-dark-11">
                    Manages efficient parcel handling systems, ensuring secure storage and convenient pickup for all
                    residents.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4">
            <div
              class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 p-6 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="flex items-start gap-4">
                <div
                  class="w-[60px] h-[60px] rounded-lg flex-shrink-0 flex items-center justify-center text-[24px]/none bg-primary text-primary-color">
                  <i class="lni lni-bubble"></i>
                </div>
                <div>
                  <h4 class="text-lg font-semibold mb-1 text-body-light-12 dark:text-body-dark-12">
                    Lisa Martinez
                  </h4>
                  <p class="text-sm text-primary font-medium mb-2">Community Relations Manager</p>
                  <p class="text-sm text-body-light-11 dark:text-body-dark-11">
                    Facilitates resident engagement, organizes community events, and maintains positive relationships
                    throughout our properties.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 md:col-4">
            <div
              class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 p-6 shadow-card-2 hover:shadow-lg hover:-translate-y-1">
              <div class="flex items-start gap-4">
                <div
                  class="w-[60px] h-[60px] rounded-lg flex-shrink-0 flex items-center justify-center text-[24px]/none bg-primary text-primary-color">
                  <i class="lni lni-laptop"></i>
                </div>
                <div>
                  <h4 class="text-lg font-semibold mb-1 text-body-light-12 dark:text-body-dark-12">
                    David Thompson
                  </h4>
                  <p class="text-sm text-primary font-medium mb-2">IT Systems Administrator</p>
                  <p class="text-sm text-body-light-11 dark:text-body-dark-11">
                    Maintains digital infrastructure, resident portal systems, and ensures seamless technology integration
                    across properties.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Join Our Team CTA -->
    <section id="careers-cta" class="section-area !bg-primary !text-primary-color">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[650px] mx-auto">
          <div
            class="w-[80px] h-[80px] rounded-2xl mb-8 mx-auto flex items-center justify-center text-[40px]/none bg-primary-color text-primary">
            <i class="lni lni-users"></i>
          </div>
          <h2 class="mb-6 text-inherit">
            Join Our Growing Team
          </h2>
          <p class="mb-8">
            We're always looking for talented professionals passionate about property management and resident services.
            Be part of a team that's transforming condominium living in Bangkok.
          </p>
          <a href="{{ route('contact') }}"
            class="inline-block px-7 py-4 rounded-md bg-primary-color text-primary hover:bg-primary-light-5 dark:hover:bg-primary-light-5 focus:bg-primary-light-5 dark:focus:bg-primary-light-5 text-base font-medium shadow-lg"
            role="button">Explore Career Opportunities</a>
        </div>
      </div>
    </section>

  </main>
@endsection