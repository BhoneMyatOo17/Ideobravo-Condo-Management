@extends('layouts.app')

@section('content')
  <main class="main relative">
    <!-- Hero section -->
    <section id="about-hero"
      class="relative overflow-hidden bg-primary bg-rings text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] pb-20">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <h1
                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                About Ideo Condominiums
              </h1>

              <p class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Leading Thailand's residential real estate with innovative design, premium facilities, and
                professional juristic management across Bangkok's prime locations.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About section with tabs -->
    <section id="about" class="section-area">
      <div class="container">
        <div class="grid grid-cols-1 gap-14 lg:grid-cols-2">
          <div class="w-full">
            <figure class="scroll-revealed max-w-[480px] mx-auto">
              <img src="{{ asset('images/about-img.jpg') }}" alt="About Ideo" class="rounded-xl" />
            </figure>
          </div>

          <div class="w-full">
            <div class="scroll-revealed">
              <h6 class="mb-2 block text-lg font-semibold text-primary">
                About Ideo
              </h6>
              <h2 class="mb-6">
                Leading the Future of Urban Living in Thailand
              </h2>
            </div>

            <div class="tabs scroll-revealed">
              <nav class="tabs-nav flex flex-wrap gap-4 my-8" role="tablist" aria-label="About us tabs">
                <button type="button"
                  class="tabs-link inline-block py-2 px-4 rounded-md text-body-light-12 dark:text-body-dark-12 bg-body-light-12/10 dark:bg-body-dark-12/10 text-inherit font-medium hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                  data-web-toggle="tabs" data-web-target="tabs-panel-profile" id="tabs-list-profile" role="tab"
                  aria-controls="tabs-panel-profile">
                  Our Profile
                </button>

                <button type="button"
                  class="tabs-link inline-block py-2 px-4 rounded-md text-body-light-12 dark:text-body-dark-12 bg-body-light-12/10 dark:bg-body-dark-12/10 text-inherit font-medium hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                  data-web-toggle="tabs" data-web-target="tabs-panel-vision" id="tabs-list-vision" role="tab"
                  aria-controls="tabs-panel-vision">
                  Our Vision
                </button>

                <button type="button"
                  class="tabs-link inline-block py-2 px-4 rounded-md text-body-light-12 dark:text-body-dark-12 bg-body-light-12/10 dark:bg-body-dark-12/10 text-inherit font-medium hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                  data-web-toggle="tabs" data-web-target="tabs-panel-history" id="tabs-list-history" role="tab"
                  aria-controls="tabs-panel-history">
                  Our History
                </button>
              </nav>

              <div class="tabs-content mt-4" id="tabs-panel-profile" tabindex="-1" role="tabpanel"
                aria-labelledby="tabs-list-profile">
                <p>
                  Ideo is one of Thailand's premier condominium developers, specializing in high-rise
                  residential projects throughout Bangkok. We are committed to creating modern living
                  spaces that combine innovative design and accessible locations near BTS and MRT stations.
                </p>
                <p>
                  Our developments are designed to meet the diverse needs of both local Thai residents and
                  international professionals, offering a perfect blend of comfort, convenience, and
                  contemporary lifestyle.
                </p>
              </div>

              <div class="tabs-content mt-4" id="tabs-panel-vision" tabindex="-1" role="tabpanel"
                aria-labelledby="tabs-list-vision">
                <p>
                  We envision a future where urban living seamlessly integrates with modern technology,
                  sustainable practices, and community-focused design. Our goal is to revolutionize
                  condominium management through innovative digital solutions that enhance resident
                  experience.
                </p>
                <p>
                  By continuously improving our facilities and services, we strive to set new standards in
                  Thailand's residential real estate market, making quality urban living accessible to
                  all.
                </p>
              </div>

              <div class="tabs-content mt-4" id="tabs-panel-history" tabindex="-1" role="tabpanel"
                aria-labelledby="tabs-list-history">
                <p>
                  Founded with a vision to transform Bangkok's skyline, Ideo has grown from a single
                  development to become a trusted name in Thailand's condominium industry. Over the years,
                  we have successfully completed numerous projects across Bangkok's most sought-after
                  districts.
                </p>
                <p>
                  Our journey reflects our commitment to quality construction, thoughtful design, and
                  creating vibrant communities where residents can truly call home. Each project
                  represents our dedication to excellence and innovation in urban development.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Juristic Office Management section -->
    <section id="juristic" class="section-area">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
          <h6 class="mb-2 block text-lg font-semibold text-primary">
            Juristic Management
          </h6>
          <h2 class="mb-6">Professional Property Management</h2>
          <p>
            Our dedicated juristic office teams ensure smooth operations, maintenance excellence, and
            comprehensive resident support across all Ideo properties.
          </p>
        </div>

        <div class="row">
          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-users"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Resident Relations
                </h4>
                <p>
                  Our juristic office serves as your primary point of contact for all condominium-related
                  matters. From registration to daily inquiries, we're here to assist with prompt and
                  professional service tailored to your needs.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-cog"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Facility Maintenance
                </h4>
                <p>
                  Regular maintenance schedules, preventive care, and rapid response teams ensure all
                  building systems, common areas, and amenities remain in pristine condition. Our
                  professional staff handles everything from minor repairs to major upgrades.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-files"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Financial Management
                </h4>
                <p>
                  Transparent financial administration including common area fee collection, vendor
                  payments, budget planning, and regular financial reporting. Our juristic office ensures
                  efficient fund management for the benefit of all residents.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-bullhorn"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Community Management
                </h4>
                <p>
                  Organizing community events, managing resident feedback, coordinating with committee
                  members, and facilitating communication between residents. We foster a vibrant,
                  connected community atmosphere.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-certificate"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  Compliance & Legal
                </h4>
                <p>
                  Ensuring compliance with Thai Condominium Act, building regulations, safety standards,
                  and local ordinances. Our juristic team handles all legal documentation, permits, and
                  regulatory requirements professionally.
                </p>
              </div>
            </div>
          </div>

          <div class="scroll-revealed col-12 sm:col-6 lg:col-4">
            <div class="group hover:-translate-y-1">
              <div
                class="w-[70px] h-[70px] rounded-2xl mb-6 flex items-center justify-center text-[37px]/none bg-primary text-primary-color">
                <i class="lni lni-customer"></i>
              </div>
              <div class="w-full">
                <h4 class="text-[1.25rem]/tight font-semibold mb-5">
                  24/7 Support Services
                </h4>
                <p>
                  Emergency response teams, round-the-clock security coordination, urgent maintenance
                  requests, and after-hours support. Your peace of mind is our priority, with dedicated
                  staff available whenever you need assistance.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials section -->
    <section id="testimonials" class="section-area">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
          <h6 class="mb-2 block text-lg font-semibold text-primary">
            Client Reviews
          </h6>
          <h2 class="mb-6">What Residents Say</h2>
          <p>
            Hear from our satisfied residents about their experience living in Ideo condominiums and the
            quality of our management services.
          </p>
        </div>

        <div class="swiper testimonial-carousel common-carousel scroll-revealed">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 px-5 py-8 shadow-card-2 sm:px-8">
                <p class="mb-6 text-base text-body-light-11 dark:text-body-dark-11">
                  "Living at Ideo has been exceptional. The juristic office is responsive, and the digital services make
                  everything so convenient. Highly
                  recommend!"
                </p>
                <figure class="flex items-center gap-4">
                  <div class="h-[50px] w-[50px] overflow-hidden">
                    <img src="{{ asset('images/avatar/avatar-5.jpg') }}" alt="Resident"
                      class="h-full w-full rounded-full object-cover" />
                  </div>
                  <figcaption class="flex-grow">
                    <h3 class="text-sm font-semibold text-body-light-11 dark:text-body-dark-11">
                      Sarah Johnson
                    </h3>
                    <p class="text-xs text-body-light-10 dark:text-body-dark-10">
                      Ideo Q Sukhumvit Resident
                    </p>
                  </figcaption>
                </figure>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 px-5 py-8 shadow-card-2 sm:px-8">
                <p class="mb-6 text-base text-body-light-11 dark:text-body-dark-11">
                  "The professional management and modern amenities make Ideo stand out. Security is
                  excellent, and the staff is always helpful. Great place to call home in Bangkok."
                </p>
                <figure class="flex items-center gap-4">
                  <div class="h-[50px] w-[50px] overflow-hidden">
                    <img src="{{ asset('images/avatar/avatar-6.jpg') }}" alt="Resident"
                      class="h-full w-full rounded-full object-cover" />
                  </div>
                  <figcaption class="flex-grow">
                    <h3 class="text-sm font-semibold text-body-light-11 dark:text-body-dark-11">
                      Takeshi Yamamoto
                    </h3>
                    <p class="text-xs text-body-light-10 dark:text-body-dark-10">
                      Ideo Rama 9 Resident
                    </p>
                  </figcaption>
                </figure>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="rounded-xl bg-body-light-1 dark:bg-body-dark-12/10 px-5 py-8 shadow-card-2 sm:px-8">
                <p class="mb-6 text-base text-body-light-11 dark:text-body-dark-11">
                  "Love the location and facilities! The management system is so convenient, and
                  living style is perfect Ideo truly understands modern urban living."
                </p>
                <figure class="flex items-center gap-4">
                  <div class="h-[50px] w-[50px] overflow-hidden">
                    <img src="{{ asset('images/avatar/avatar-7.jpg') }}" alt="Resident"
                      class="h-full w-full rounded-full object-cover" />
                  </div>
                  <figcaption class="flex-grow">
                    <h3 class="text-sm font-semibold text-body-light-11 dark:text-body-dark-11">
                      Priya Sharma
                    </h3>
                    <p class="text-xs text-body-light-10 dark:text-body-dark-10">
                      Ideo O2 Resident
                    </p>
                  </figcaption>
                </figure>
              </div>
            </div>
          </div>

          <div class="mt-[60px] flex items-center justify-center gap-1">
            <div class="swiper-button-prev">
              <i class="lni lni-arrow-left"></i>
            </div>
            <div class="swiper-button-next">
              <i class="lni lni-arrow-right"></i>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA section -->
    <section id="cta" class="section-area !bg-primary !text-primary-color">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto">
          <h2 class="mb-8 text-inherit">
            Experience Modern Condominium Living
          </h2>
          <p>
            Join our growing community of satisfied residents across Bangkok. Discover why Ideo is the
            preferred choice for quality urban living with professional juristic management and premium
            facilities.
          </p>
          <a href="{{ route('welcome') }}#locations"
            class="inline-block px-5 py-3 rounded-md mt-11 bg-green-400 text-white hover:bg-green-500 hover:text-white focus:bg-green-500 focus:text-white"
            role="button">View Our Properties</a>
        </div>
      </div>
    </section>

  </main>
@endsection