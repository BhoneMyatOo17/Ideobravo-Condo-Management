@extends('layouts.app')

@section('content')
    <main class="main relative">
        <!-- Hero section -->
        <section id="home"
            class="relative overflow-hidden bg-primary text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px]">
            <div class="container">
                <div class="-mx-5 flex flex-wrap items-center">
                    <div class="w-full px-5">
                        <div class="scroll-revealed mx-auto max-w-[780px] text-center">
                            <h1
                                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                                Smart Urban Residences Crafted for Life
                            </h1>

                            <p class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                                Ideo is Thailand's leading high-rise condominium developer, offering modern living spaces in
                                Bangkok's most desirable locations. Experience contemporary design, premium amenities, and
                                seamless urban connectivity.
                            </p>

                            <ul class="mb-10 flex flex-wrap items-center justify-center gap-4 md:gap-5">
                                <li>
                                    <a href="#locations"
                                        class="ic-page-scroll inline-flex items-center justify-center rounded-md bg-primary-color text-primary px-5 py-3 text-center text-base font-medium shadow-md hover:bg-primary-light-5 md:px-7 md:py-[14px]"
                                        role="button">Explore Properties</a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)"
                                        class="video-popup flex items-center gap-4 rounded-md bg-primary-color/[0.15] px-5 py-3 text-base font-medium text-primary-color hover:bg-primary-color hover:text-primary md:px-7 md:py-[14px]"
                                        role="button"><i class="lni lni-play text-lg/none"></i> Watch Intro</a>
                                </li>
                            </ul>

                            <div>
                                <p class="mb-4 text-center text-primary-color">Powered by Laravel</p>

                                <div class="scroll-revealed flex items-center justify-center gap-4 text-center">
                                    <a href="https://laravel.com/" target="_blank"
                                        class="text-primary-color/60 hover:text-primary-color">
                                        <svg class="fill-current" height="26" viewBox="0 0 50 52"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-5">
                        <div class="scroll-revealed relative z-10 mx-auto max-w-[845px]">
                            <figure class="mt-16">
                                <img id="hero-image" src="{{ asset('images/hero.jpg') }}" alt="Ideo Condominium"
                                    class="mx-auto max-w-full rounded-t-xl rounded-tr-xl" />
                            </figure>

                            <div class="absolute -left-9 bottom-0 z-[-1]">
                                <img src="{{ asset('images/dots.svg') }}" alt class="w-[120px] opacity-75" />
                            </div>

                            <div class="absolute -right-6 -top-6 z-[-1]">
                                <img src="{{ asset('images/dots.svg') }}" alt class="w-[120px] opacity-75" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About section -->
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
                                    data-web-toggle="tabs" data-web-target="tabs-panel-profile" id="tabs-list-profile"
                                    role="tab" aria-controls="tabs-panel-profile">
                                    Our Profile
                                </button>

                                <button type="button"
                                    class="tabs-link inline-block py-2 px-4 rounded-md text-body-light-12 dark:text-body-dark-12 bg-body-light-12/10 dark:bg-body-dark-12/10 text-inherit font-medium hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                                    data-web-toggle="tabs" data-web-target="tabs-panel-vision" id="tabs-list-vision"
                                    role="tab" aria-controls="tabs-panel-vision">
                                    Our Vision
                                </button>

                                <button type="button"
                                    class="tabs-link inline-block py-2 px-4 rounded-md text-body-light-12 dark:text-body-dark-12 bg-body-light-12/10 dark:bg-body-dark-12/10 text-inherit font-medium hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                                    data-web-toggle="tabs" data-web-target="tabs-panel-history" id="tabs-list-history"
                                    role="tab" aria-controls="tabs-panel-history">
                                    Our History
                                </button>
                            </nav>

                            <div class="tabs-content mt-4" id="tabs-panel-profile" tabindex="-1" role="tabpanel"
                                aria-labelledby="tabs-list-profile">
                                <p>
                                    Ideo is one of Thailand's premier condominium developers, specializing in high-rise
                                    condominium projects throughout Bangkok. We are committed to creating modern living
                                    spaces that combine innovative design and accessible locations near BTS and MRT
                                    stations.
                                </p>
                                <p>
                                    Our developments are designed to meet the diverse needs of both local and international
                                    residents, offering a perfect blend of comfort, convenience, and
                                    contemporary lifestyle.
                                </p>
                            </div>

                            <div class="tabs-content mt-4" id="tabs-panel-vision" tabindex="-1" role="tabpanel"
                                aria-labelledby="tabs-list-vision">
                                <p>
                                    We envision a future where urban living integrates with modern technology,
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

        <!-- Intro video section -->
        <section id="intro" class="section-area">
            <div class="container">
                <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
                    <h6 class="mb-2 block text-lg font-semibold text-primary">
                        Intro Video
                    </h6>
                    <h2 class="mb-6">Discover Ideo Living</h2>
                    <p>
                        Experience the perfect blend of modern design, premium facilities, and strategic locations that
                        define Ideo condominiums. Watch our introduction video to explore what makes Ideo your ideal urban
                        home.
                    </p>
                </div>

                <div class="scroll-revealed relative max-w-[900px] mx-auto">
                    <div class="aspect-video rounded-xl overflow-hidden">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/lhmxe7ZZYEE?si=j4DS-VEPN1VRx9J_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

        <!-- Locations section -->
        <section id="locations" class="section-area">
            <div class="container">
                <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
                    <h6 class="mb-2 block text-lg font-semibold text-primary">
                        Our Locations
                    </h6>
                    <h2 class="mb-6">Ideo Condominiums Across Bangkok</h2>
                    <p>
                        Discover our premium condominium projects in Bangkok's most vibrant
                        neighborhoods.
                    </p>
                </div>

                <nav class="scroll-revealed portfolio-menu mb-[3.750rem] text-center" aria-label="Location filter">
                    <button type="button"
                        class="font-semibold px-5 py-2 rounded-md text-body-light-11 dark:text-body-dark-11 hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color active"
                        data-filter="all">
                        All Locations
                    </button>
                    <button type="button"
                        class="font-semibold px-5 py-2 rounded-md text-body-light-11 dark:text-body-dark-11 hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                        data-filter="sukhumvit">
                        Sukhumvit
                    </button>
                    <button type="button"
                        class="font-semibold px-5 py-2 rounded-md text-body-light-11 dark:text-body-dark-11 hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                        data-filter="rama9">
                        Rama 9
                    </button>
                    <button type="button"
                        class="font-semibold px-5 py-2 rounded-md text-body-light-11 dark:text-body-dark-11 hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                        data-filter="bangna">
                        Bang Na
                    </button>
                    <button type="button"
                        class="font-semibold px-5 py-2 rounded-md text-body-light-11 dark:text-body-dark-11 hover:bg-primary hover:text-primary-color focus:bg-primary focus:text-primary-color"
                        data-filter="bangchak">
                        Bang Chak
                    </button>
                </nav>

                <div class="scroll-revealed portfolio-grid row">
                    <div class="portfolio col-12 sm:col-6 lg:col-4">
                        <article class="group" data-filter="sukhumvit">
                            <div class="relative overflow-hidden w-full aspect-[4/3] rounded-xl">
                                <img src="{{ asset('images/portfolio/portfolio-1.jpg') }}" alt="Ideo Q Sukhumvit 36"
                                    class="w-full h-full object-cover" />
                                <div
                                    class="absolute top-0 left-0 w-full aspect-[4/3] flex items-center justify-center bg-body-light-1/75 scale-[0.15] rounded-xl opacity-0 invisible group-hover:scale-95 group-hover:opacity-100 group-hover:visible">
                                    <div class="flex flex-wrap gap-2 p-4">
                                        <div class="inline-block relative">
                                            <a href="{{ asset('images/portfolio/portfolio-1.jpg') }}"
                                                class="portfolio-box text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-zoom-in"></i>
                                            </a>
                                        </div>
                                        <div class="portfolio-icon">
                                            <a href="javascript:void(0)"
                                                class="text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <h4 class="mb-2">
                                    <a href="javascript:void(0)" class="text-[1.5rem] leading-tight text-inherit">Ideo Q
                                        Sukhumvit 36</a>
                                </h4>
                                <p>
                                    Luxury condominium near Thong Lo BTS. Modern design with premium amenities in the heart
                                    of Sukhumvit.
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="portfolio col-12 sm:col-6 lg:col-4">
                        <article class="group" data-filter="rama9">
                            <div class="relative overflow-hidden w-full aspect-[4/3] rounded-xl">
                                <img src="{{ asset('images/portfolio/portfolio-2.png') }}" alt="Ideo Rama 9 - Asoke"
                                    class="w-full h-full object-cover" />
                                <div
                                    class="absolute top-0 left-0 w-full aspect-[4/3] flex items-center justify-center bg-body-light-1/75 scale-[0.15] rounded-xl opacity-0 invisible group-hover:scale-95 group-hover:opacity-100 group-hover:visible">
                                    <div class="flex flex-wrap gap-2 p-4">
                                        <div class="inline-block relative">
                                            <a href="{{ asset('images/portfolio/portfolio-2.png') }}"
                                                class="portfolio-box text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-zoom-in"></i>
                                            </a>
                                        </div>
                                        <div class="portfolio-icon">
                                            <a href="javascript:void(0)"
                                                class="text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <h4 class="mb-2">
                                    <a href="javascript:void(0)" class="text-[1.5rem] leading-tight text-inherit">Ideo Rama
                                        9 - Asoke</a>
                                </h4>
                                <p>
                                    Located in the New CBD with access to MRT Phra Ram 9. Complete facilities in a prime
                                    business district.
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="portfolio col-12 sm:col-6 lg:col-4">
                        <article class="group" data-filter="bangna">
                            <div class="relative overflow-hidden w-full aspect-[4/3] rounded-xl">
                                <img src="{{ asset('images/portfolio/portfolio-3.webp') }}" alt="Ideo O2"
                                    class="w-full h-full object-cover" />
                                <div
                                    class="absolute top-0 left-0 w-full aspect-[4/3] flex items-center justify-center bg-body-light-1/75 scale-[0.15] rounded-xl opacity-0 invisible group-hover:scale-95 group-hover:opacity-100 group-hover:visible">
                                    <div class="flex flex-wrap gap-2 p-4">
                                        <div class="inline-block relative">
                                            <a href="{{ asset('images/portfolio/portfolio-3.webp') }}"
                                                class="portfolio-box text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-zoom-in"></i>
                                            </a>
                                        </div>
                                        <div class="portfolio-icon">
                                            <a href="javascript:void(0)"
                                                class="text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <h4 class="mb-2">
                                    <a href="javascript:void(0)" class="text-[1.5rem] leading-tight text-inherit">Ideo
                                        O2</a>
                                </h4>
                                <p>
                                    Resort-style facilities near BTS Bang Na. Features 3 swimming pools, bike track, and
                                    futsal court on 10 rai of land.
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="portfolio col-12 sm:col-6 lg:col-4">
                        <article class="group" data-filter="bangchak">
                            <div class="relative overflow-hidden w-full aspect-[4/3] rounded-xl">
                                <img src="{{ asset('images/portfolio/portfolio-4.png') }}" alt="Ideo Sukhumvit 93"
                                    class="w-full h-full object-cover" />
                                <div
                                    class="absolute top-0 left-0 w-full aspect-[4/3] flex items-center justify-center bg-body-light-1/75 scale-[0.15] rounded-xl opacity-0 invisible group-hover:scale-95 group-hover:opacity-100 group-hover:visible">
                                    <div class="flex flex-wrap gap-2 p-4">
                                        <div class="inline-block relative">
                                            <a href="{{ asset('images/portfolio/portfolio-4.png') }}"
                                                class="portfolio-box text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-zoom-in"></i>
                                            </a>
                                        </div>
                                        <div class="portfolio-icon">
                                            <a href="javascript:void(0)"
                                                class="text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <h4 class="mb-2">
                                    <a href="javascript:void(0)" class="text-[1.5rem] leading-tight text-inherit">Ideo
                                        Sukhumvit 93</a>
                                </h4>
                                <p>
                                    Near Bang Chak BTS station. Modern condominium with co-working space, swimming pool, and
                                    comprehensive facilities.
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="portfolio col-12 sm:col-6 lg:col-4">
                        <article class="group" data-filter="sukhumvit">
                            <div class="relative overflow-hidden w-full aspect-[4/3] rounded-xl">
                                <img src="{{ asset('images/portfolio/portfolio-5.jpg') }}" alt="Ideo Sukhumvit 115"
                                    class="w-full h-full object-cover" />
                                <div
                                    class="absolute top-0 left-0 w-full aspect-[4/3] flex items-center justify-center bg-body-light-1/75 scale-[0.15] rounded-xl opacity-0 invisible group-hover:scale-95 group-hover:opacity-100 group-hover:visible">
                                    <div class="flex flex-wrap gap-2 p-4">
                                        <div class="inline-block relative">
                                            <a href="{{ asset('images/portfolio/portfolio-5.jpg') }}"
                                                class="portfolio-box text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-zoom-in"></i>
                                            </a>
                                        </div>
                                        <div class="portfolio-icon">
                                            <a href="javascript:void(0)"
                                                class="text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <h4 class="mb-2">
                                    <a href="javascript:void(0)" class="text-[1.5rem] leading-tight text-inherit">Ideo
                                        Sukhumvit 115</a>
                                </h4>
                                <p>
                                    Convenient location on Sukhumvit with easy access to shopping malls and public
                                    transportation.
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="portfolio col-12 sm:col-6 lg:col-4">
                        <article class="group" data-filter="sukhumvit">
                            <div class="relative overflow-hidden w-full aspect-[4/3] rounded-xl">
                                <img src="{{ asset('images/portfolio/portfolio-6.jpeg') }}" alt="Ideo Mobi Sukhumvit"
                                    class="w-full h-full object-cover" />
                                <div
                                    class="absolute top-0 left-0 w-full aspect-[4/3] flex items-center justify-center bg-body-light-1/75 scale-[0.15] rounded-xl opacity-0 invisible group-hover:scale-95 group-hover:opacity-100 group-hover:visible">
                                    <div class="flex flex-wrap gap-2 p-4">
                                        <div class="inline-block relative">
                                            <a href="{{ asset('images/portfolio/portfolio-6.jpeg') }}"
                                                class="portfolio-box text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-zoom-in"></i>
                                            </a>
                                        </div>
                                        <div class="portfolio-icon">
                                            <a href="javascript:void(0)"
                                                class="text-[1.75rem] text-primary-color bg-primary z-10 w-[60px] aspect-square rounded-lg text-center inline-flex items-center justify-center hover:bg-primary-light-10 hover:text-primary-color dark:hover:bg-primary-dark-10 dark:hover:text-primary-color focus:bg-primary-light-10 focus:text-primary-color dark:focus:bg-primary-dark-10 dark:focus:text-primary-color">
                                                <i class="lni lni-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <h4 class="mb-2">
                                    <a href="javascript:void(0)" class="text-[1.5rem] leading-tight text-inherit">Ideo Mobi
                                        Sukhumvit</a>
                                </h4>
                                <p>
                                    Compact and efficient design perfect for urban professionals along the Sukhumvit
                                    corridor.
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call action section -->
        <section id="call-action" class="section-area !bg-primary !text-primary-color">
            <div class="container">
                <div class="scroll-revealed text-center max-w-[550px] mx-auto">
                    <h2 class="mb-8 text-inherit">
                        Find Your New Home in Bangkok's Prime Locations
                    </h2>
                    <p>
                        Discover modern condominium living with Ideo. From Sukhumvit to Rama 9, our properties offer the
                        perfect blend of convenience, luxury, and urban lifestyle. Start your journey to finding your ideal
                        home today.
                    </p>
                    <a href="#locations"
                        class="inline-block px-7 py-4 rounded-md bg-primary-color text-primary hover:bg-primary-light-5 dark:hover:bg-primary-light-5 focus:bg-primary-light-5 dark:focus:bg-primary-light-5 text-base font-medium shadow-lg mt-11"
                        role="button">
                        Explore Properties
                    </a>

                </div>
            </div>
        </section>

    </main>
@endsection
