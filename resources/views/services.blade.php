@extends('layouts.app')

@section('content')
  <main class="main relative">
    <!-- Hero section -->
    <section id="services-hero"
      class="relative overflow-hidden bg-primary bg-rings text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] pb-20">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <h1
                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                Resident Services & Facilities
              </h1>

              <p class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Experience premium living with our comprehensive range of services designed to make your life easier and
                more comfortable at Ideo condominiums.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Core Services section -->
    <section id="core-services" class="section-area">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
          <h6 class="mb-2 block text-lg font-semibold text-primary">
            Core Services
          </h6>
          <h2 class="mb-6">What We Offer</h2>
          <p>
            Our comprehensive services ensure your condominium living experience is seamless, secure, and enjoyable.
          </p>
        </div>

        <div class="row">
          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-shield"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  24/7 Security & Safety
                </h4>
                <p>
                  Round-the-clock security personnel, CCTV monitoring, biometric access control, and visitor management
                  system to ensure your safety and peace of mind.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-apartment"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Property Management
                </h4>
                <p>
                  Professional maintenance services, regular cleaning of common areas, building upkeep, and prompt
                  response to facility issues for optimal living conditions.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-package"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Parcel Management
                </h4>
                <p>
                  Secure package receiving and storage system with instant notifications, verification process, and
                  convenient pickup hours for all your deliveries.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-credit-cards"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Digital Billing System
                </h4>
                <p>
                  Paperless billing with online payment options, digital bill delivery, payment tracking, and
                  comprehensive billing history through our resident portal.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-car"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Parking Management
                </h4>
                <p>
                  Covered parking spaces with automated access, visitor parking allocation, electric vehicle charging
                  stations, and 24/7 surveillance for vehicle security.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-bubble"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Resident Communication
                </h4>
                <p>
                  Stay informed with our digital announcement system, maintenance notifications, community updates, and
                  direct communication channels with juristic office.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Premium Facilities section -->
    <section id="facilities" class="section-area">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
          <h6 class="mb-2 block text-lg font-semibold text-primary">
            Premium Facilities
          </h6>
          <h2 class="mb-6">World-Class Amenities</h2>
          <p>
            Enjoy access to state-of-the-art facilities designed to enhance your lifestyle and well-being.
          </p>
        </div>

        <div class="row">
          <!-- Photo needed: Fitness Center -->
          <div class="scroll-revealed col-12 md:col-6">
            <div class="rounded-xl overflow-hidden shadow-card-1 hover:shadow-lg bg-body-light-1 dark:bg-primary-dark-2">
              <div class="w-full aspect-[16/10] bg-body-light-3 dark:bg-body-dark-3 flex items-center justify-center">
                <!-- PHOTO NEEDED: fitness-center.jpg (gym equipment, modern fitness space) -->
                <img src="{{ asset('images/facilities/fitness-center.jpg') }}" alt="Fitness Center"
                  class="w-full h-full object-cover" />
              </div>
              <div class="p-6">
                <h4 class="text-[1.5rem]/tight font-semibold mb-4 text-body-light-12 dark:text-body-dark-12">
                  Fitness & Wellness
                </h4>
                <p class="mb-4">
                  Fully-equipped fitness centers with modern cardio and strength training equipment, and
                  wellness areas to maintain your healthy lifestyle.
                </p>
                <ul class="space-y-2">
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>24-hour gym access</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Yoga & aerobics studio</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Sauna & steam room</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Photo needed: Swimming Pool -->
          <div class="scroll-revealed col-12 md:col-6">
            <div class="rounded-xl overflow-hidden shadow-card-1 hover:shadow-lg bg-body-light-1 dark:bg-primary-dark-2">
              <div class="w-full aspect-[16/10] bg-body-light-3 dark:bg-body-dark-3 flex items-center justify-center">
                <!-- PHOTO NEEDED: swimming-pool.jpg (modern pool, rooftop pool preferred) -->
                <img src="{{ asset('images/facilities/swimming-pool.webp') }}" alt="Swimming Pool"
                  class="w-full h-full object-cover" />
              </div>
              <div class="p-6">
                <h4 class="text-[1.5rem]/tight font-semibold mb-4 text-body-light-12 dark:text-body-dark-12">
                  Swimming Pools & Recreation
                </h4>
                <p class="mb-4">
                  Multiple swimming pools including rooftop infinity pools, children's pools, and jacuzzi areas with
                  stunning city views for ultimate relaxation.
                </p>
                <ul class="space-y-2">
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Infinity rooftop pool</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Children's play pool</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Poolside lounge areas</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Photo needed: Co-working Space -->
          <div class="scroll-revealed col-12 md:col-6">
            <div class="rounded-xl overflow-hidden shadow-card-1 hover:shadow-lg bg-body-light-1 dark:bg-primary-dark-2">
              <div class="w-full aspect-[16/10] bg-body-light-3 dark:bg-body-dark-3 flex items-center justify-center">
                <img src="{{ asset('images/facilities/coworking-space.png') }}" alt="Co-working Space"
                  class="w-full h-full object-cover" />
              </div>
              <div class="p-6">
                <h4 class="text-[1.5rem]/tight font-semibold mb-4 text-body-light-12 dark:text-body-dark-12">
                  Work & Study Spaces
                </h4>
                <p class="mb-4">
                  Professional co-working spaces with high-speed internet, meeting rooms, and quiet study areas perfect
                  for remote work and productivity.
                </p>
                <ul class="space-y-2">
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>High-speed fiber internet</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Private meeting rooms</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Printing & scanning services</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Photo needed: Sky Lounge -->
          <div class="scroll-revealed col-12 md:col-6">
            <div class="rounded-xl overflow-hidden shadow-card-1 hover:shadow-lg bg-body-light-1 dark:bg-primary-dark-2">
              <div class="w-full aspect-[16/10] bg-body-light-3 dark:bg-body-dark-3 flex items-center justify-center">
                <img src="{{ asset('images/facilities/sky-lounge.jpg') }}" alt="Sky Lounge"
                  class="w-full h-full object-cover" />
              </div>
              <div class="p-6">
                <h4 class="text-[1.5rem]/tight font-semibold mb-4 text-body-light-12 dark:text-body-dark-12">
                  Sky Lounge & Gardens
                </h4>
                <p class="mb-4">
                  Elegant rooftop lounges and landscaped gardens with panoramic Bangkok views, perfect for
                  relaxing after a long day.
                </p>
                <ul class="space-y-2">
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Rooftop sky lounge</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>BBQ & party areas</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <i class="lni lni-checkmark text-primary mt-1"></i>
                    <span>Landscaped gardens</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Resident Portal CTA section -->
    <section id="portal-cta" class="section-area !bg-primary !text-primary-color">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[650px] mx-auto">
          <div
            class="w-[80px] h-[80px] rounded-2xl mb-8 mx-auto flex items-center justify-center text-[40px]/none bg-primary-color text-primary">
            <i class="lni lni-laptop-phone"></i>
          </div>
          <h2 class="mb-6 text-inherit">
            Access All Services Through Our Resident Portal
          </h2>
          <p class="mb-8">
            Manage your bills, track parcels, book facilities, and stay connected with your community—all from one
            convenient digital platform accessible 24/7 from anywhere.
          </p>
          <a href="{{ route('register') }}"
            class="inline-block px-7 py-4 rounded-md bg-primary-color text-primary hover:bg-primary-light-5 dark:hover:bg-primary-light-5 focus:bg-primary-light-5 dark:focus:bg-primary-light-5 text-base font-medium shadow-lg"
            role="button">Get Started Now</a>
        </div>
      </div>
    </section>

  </main>
@endsection