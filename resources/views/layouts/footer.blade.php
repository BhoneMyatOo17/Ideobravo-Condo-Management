<!-- Footer -->
<footer class="bg-body-light-2 dark:bg-primary-dark-2 text-body-light-12 dark:text-white">
  <div class="container py-20 lg:py-[100px]">
    <div class="row">
      <div class="col-12 order-first lg:col-4">
        <div class="w-full">
          <a href="." class="inline-block mb-5">
            <!-- White logo for dark mode -->
            <img src="{{ asset('images/logo-white.png') }}" alt="Ideo" class="h-[40px] w-auto hidden dark:block" />
            <!-- Blue logo for light mode -->
            <img src="{{ asset('images/logo-blue.png') }}" alt="Ideo" class="h-[40px] w-auto block dark:hidden" />
          </a>

          <p class="mb-8 text-body-light-11 dark:text-body-dark-11">
            Leading the future of urban living in Thailand with modern condominium developments and innovative digital
            management solutions.
          </p>

          <div class="-mx-3 flex items-center">
            <a href="javascript:void(0)"
              class="px-3 text-body-light-11 dark:text-body-dark-11 hover:text-blue-800 text-[22px] leading-none">
              <i class="lni lni-facebook-fill"></i>
            </a>

            <a href="javascript:void(0)"
              class="px-3 text-body-light-11 dark:text-body-dark-11 hover:text-sky-400 text-[22px] leading-none">
              <i class="lni lni-twitter-original"></i>
            </a>

            <a href="javascript:void(0)"
              class="px-3 text-body-light-11 dark:text-body-dark-11 hover:text-red-500 text-[22px] leading-none">
              <i class="lni lni-instagram-original"></i>
            </a>

            <a href="javascript:void(0)"
              class="px-3 text-body-light-11 dark:text-body-dark-11 hover:text-cyan-800 text-[22px] leading-none">
              <i class="lni lni-linkedin-original"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-6 lg:col-2">
        <div class="w-full">
          <h4 class="mb-9 text-lg font-semibold text-body-light-12 dark:text-inherit">Locations</h4>
          <ul>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Sukhumvit</a>
            </li>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Rama 9</a>
            </li>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Bang Na</a>
            </li>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Bang Chak</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-6 lg:col-2">
        <div class="w-full">
          <h4 class="mb-9 text-lg font-semibold text-body-light-12 dark:text-inherit">Services</h4>
          <ul>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Property
                Sales</a>
            </li>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Resident
                Portal</a>
            </li>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Facilities</a>
            </li>
            <li>
              <a href="javascript:void(0)"
                class="mb-3 inline-block text-body-light-11 dark:text-body-dark-11 hover:text-primary">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-12 -order-3 lg:col-4 lg:order-1">
        <div class="w-full">
          <h4 class="mb-9 text-lg font-semibold text-body-light-12 dark:text-inherit">Newsletter</h4>

          <p class="text-body-light-11 dark:text-body-dark-11">
            Stay updated with the latest news and exclusive offers from Ideo condominiums
          </p>
          @if(session('success'))
            <p id="newsletter-success" class="mt-2 text-m text-green-600">
              {{ session('success') }}
            </p>

            <script>
              document.getElementById('newsletter-success')
                ?.scrollIntoView({ behavior: 'smooth' });
            </script>
          @endif

          @if($errors->any())
            <div class="mt-2">
              @foreach($errors->all() as $error)
                <p class="text-sm text-red-600">{{ $error }}</p>
              @endforeach
            </div>
          @endif

          <form action="/subscribe" method="POST" class="mt-6">
            @csrf

            <input type="text" name="name"
              class="inline-block w-full px-5 py-3 mb-3 rounded-md border border-solid border-alpha-light dark:border-alpha-dark bg-transparent text-inherit text-base focus:border-primary"
              placeholder="Your name" value="{{ old('name') }}" required />

            <div class="flex">
              <input type="email" name="email"
                class="inline-block flex-grow px-5 py-3 rounded-md rounded-e-none border border-solid border-alpha-light dark:border-alpha-dark bg-transparent text-inherit text-base focus:border-primary"
                placeholder="Email address" value="{{ old('email') }}" required />

              <button type="submit"
                class="inline-block py-3 w-[50px] rounded-md rounded-s-none text-center text-lg/none bg-primary text-primary-color hover:bg-primary-light-10 dark:hover:bg-primary-dark-10">
                <i class="lni lni-envelope"></i>
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <div class="w-full border-t border-solid border-alpha-light dark:border-alpha-dark"></div>
  <div class="container py-8">
    <div class="flex flex-wrap">
      <div class="w-full md:w-1/2">
        <div class="my-1">
          <div class="flex flex-wrap justify-center gap-x-3 md:justify-start">
            <a href="{{ route('privacy.policy') }}"
              class="text-body-light-11 dark:text-body-dark-11 hover:text-body-light-12 dark:hover:text-body-dark-12">Privacy
              Policy</a>
            <a href="{{ route('legal.notice') }}"
              class="text-body-light-11 dark:text-body-dark-11 hover:text-body-light-12 dark:hover:text-body-dark-12">Legal
              Notice</a>
            <a href="{{ route('terms') }}"
              class="text-body-light-11 dark:text-body-dark-11 hover:text-body-light-12 dark:hover:text-body-dark-12">Terms
              of
              Service</a>
          </div>
        </div>
      </div>

      <div class="w-full md:w-1/2">
        <div class="my-1 flex justify-center md:justify-end">
          <p class="text-body-light-11 dark:text-body-dark-11">
            &#169; 2025 Ideo Condominiums. All rights reserved.
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>