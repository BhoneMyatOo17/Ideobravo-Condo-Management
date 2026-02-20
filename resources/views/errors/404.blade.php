@extends('layouts.minimal')

@section('content')
  <main class="main relative">
    <!-- 404 Error Section -->
    <section id="error-404"
      class="relative overflow-hidden bg-primary bg-rings text-primary-color min-h-screen flex items-center justify-center">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center justify-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <!-- 404 Large Text -->
              <div class="mb-8 overflow-visible flex-justify-center">
                <h1 style="font-size: 100px; line-height: 1;"
                  class="sm:!text-[100px] lg:!text-[200px] xl:!text-[300px] font-bold text-primary-color select-none">
                  404
                </h1>
              </div>


              <!-- Error Message -->
              <h2 class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug">
                Page Not Found
              </h2>

              <p class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Oops! The page you're looking for doesn't exist. It might have been moved, deleted, or the URL might be
                incorrect.
              </p>

              <!-- Action Buttons -->
              <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('welcome') }}"
                  class="inline-flex items-center justify-center gap-2 rounded-md bg-primary-color text-primary px-6 py-3 text-center text-base font-medium shadow-md hover:bg-primary-light-5 dark:hover:bg-primary-dark-5"
                  role="button">
                  <i class="lni lni-home text-lg"></i>
                  Back to Home
                </a>

                <a href="javascript:history.back()"
                  class="inline-flex items-center justify-center gap-2 rounded-md bg-primary-color/15 text-primary-color px-6 py-3 text-center text-base font-medium hover:bg-primary-color hover:text-primary"
                  role="button">
                  <i class="lni lni-arrow-left text-lg"></i>
                  Go Back
                </a>
              </div>

              <!-- Helpful Links -->
              <div class="mt-16">
                <p class="text-primary-color/80 mb-6 text-sm">You might be looking for:</p>
                <div class="flex flex-wrap justify-center gap-4">
                  <a href="{{ route('welcome') }}#services"
                    class="text-primary-color hover:text-primary-color/80 text-sm underline">
                    Services
                  </a>
                  <a href="{{ route('welcome') }}#portfolio"
                    class="text-primary-color hover:text-primary-color/80 text-sm underline">
                    Portfolio
                  </a>
                  <a href="{{ route('welcome') }}#contact"
                    class="text-primary-color hover:text-primary-color/80 text-sm underline">
                    Contact Us
                  </a>
                  @auth
                    <a href="{{ route('dashboard') }}"
                      class="text-primary-color hover:text-primary-color/80 text-sm underline">
                      Dashboard
                    </a>
                  @else
                    <a href="{{ route('login') }}" class="text-primary-color hover:text-primary-color/80 text-sm underline">
                      Login
                    </a>
                  @endauth
                </div>
              </div>

              <!-- Decorative Elements -->
              <div class="absolute -left-9 bottom-20 z-[-1] opacity-50">
                <img src="{{ asset('images/dots.svg') }}" class="w-[120px]" />
              </div>
              <div class="absolute -right-6 top-20 z-[-1] opacity-50">
                <img src="{{ asset('images/dots.svg') }}" class="w-[120px]" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection