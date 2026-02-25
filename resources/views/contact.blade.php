@extends('layouts.app')

@section('content')
  <main class="main relative">
    <!-- Hero section -->
    <section id="contact-hero"
      class="relative overflow-hidden bg-primary bg-rings text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px] pb-20">
      <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
          <div class="w-full px-5">
            <div class="scroll-revealed mx-auto max-w-[780px] text-center">
              <h1
                class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight">
                Get in Touch With Us
              </h1>

              <p class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal">
                Have questions about our properties or services? Our team is ready to assist you in finding
                your perfect home in Bangkok. Reach out to us today.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Information & Form section -->
    <section id="contact-info" class="section-area">
      <div class="container">
        <div class="row">
          <div class="col-12 xl:col-4">
            <div class="row">
              <div class="col-12 md:col-6 xl:col-12">
                <div
                  class="scroll-revealed py-5 px-6 rounded-xl shadow-card-1 bg-body-light-1 dark:bg-primary-dark-2 flex gap-6 hover:shadow-lg">
                  <div>
                    <i
                      class="lni lni-phone w-[50px] h-[50px] inline-flex items-center justify-center rounded-lg text-[1.25rem] bg-primary text-primary-color"></i>
                  </div>
                  <div>
                    <h4 class="text-[1.25rem] text-primary mb-3">Contact</h4>
                    <p class="m-0">+66 2 123 4567</p>
                    <p class="m-0">info@ideo.co.th</p>
                  </div>
                </div>
              </div>

              <div class="col-12 md:col-6 xl:col-12">
                <div
                  class="scroll-revealed py-5 px-6 rounded-xl shadow-card-1 bg-body-light-1 dark:bg-primary-dark-2 flex gap-6 hover:shadow-lg">
                  <div>
                    <i
                      class="lni lni-map-marker w-[50px] h-[50px] inline-flex items-center justify-center rounded-lg text-[1.25rem] bg-primary text-primary-color"></i>
                  </div>
                  <div>
                    <h4 class="text-[1.25rem] text-primary mb-3">Headquarters</h4>
                    <p class="m-0">Sukhumvit Road, Khlong Toei</p>
                    <p class="m-0">Bangkok 10110, Thailand</p>
                  </div>
                </div>
              </div>

              <div class="col-12 md:col-6 xl:col-12">
                <div
                  class="scroll-revealed py-5 px-6 rounded-xl shadow-card-1 bg-body-light-1 dark:bg-primary-dark-2 flex gap-6 hover:shadow-lg">
                  <div>
                    <i
                      class="lni lni-alarm-clock w-[50px] h-[50px] inline-flex items-center justify-center rounded-lg text-[1.25rem] bg-primary text-primary-color"></i>
                  </div>
                  <div>
                    <h4 class="text-[1.25rem] text-primary mb-3">Office Hours</h4>
                    <p class="m-0">All Week: 8:00 AM - 8:00 PM</p>
                    <p class="m-0">Juristic Office: 9:00 AM - 6:00 PM</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 xl:col-8">
            <div
              class="scroll-revealed bg-body-light-1 dark:bg-primary-dark-2 rounded-xl py-8 sm:py-12 px-6 sm:px-10 z-10 relative shadow-card-1 hover:shadow-lg">
              <div class="text-center max-w-[550px] mx-auto mb-12">
                <h6 class="mb-2 block text-lg font-semibold text-primary">
                  Send us a Message
                </h6>
                <h2 class="mb-3">We're Here to Help</h2>
                <p>
                  Fill out the form below and our team will get back to you within 24 hours.
                </p>
              </div>

              @if(session('success'))
                <div
                  class="mb-6 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg flex items-center">
                  <i class="lni lni-checkmark-circle text-2xl mr-3"></i>
                  <span>{{ session('success') }}</span>
                </div>
              @endif

              @if($errors->any())
                <div
                  class="mb-6 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded-lg">
                  <p class="font-semibold mb-2">Please fix the following errors:</p>
                  <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form action="{{ route('contact.store') }}" method="POST" class="flex flex-col gap-6">
                @csrf
                <div class="row">
                  <div class="col-12 md:col-6">
                    <input type="text" name="name" value="{{ old('name') }}"
                      class="block w-full px-5 py-3 rounded-md border border-solid border-alpha-light dark:border-alpha-dark text-inherit text-base focus:border-primary @error('name') border-red-500 @enderror"
                      placeholder="Name" required />
                    @error('name')
                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="col-12 md:col-6">
                    <input type="email" name="email" value="{{ old('email') }}"
                      class="block w-full px-5 py-3 rounded-md border border-solid border-alpha-light dark:border-alpha-dark text-inherit text-base focus:border-primary @error('email') border-red-500 @enderror"
                      placeholder="Email" required />
                    @error('email')
                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="col-12 md:col-6">
                    <input type="text" name="phone" value="{{ old('phone') }}"
                      class="block w-full px-5 py-3 rounded-md border border-solid border-alpha-light dark:border-alpha-dark text-inherit text-base focus:border-primary @error('phone') border-red-500 @enderror"
                      placeholder="Phone" required />
                    @error('phone')
                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="col-12 md:col-6">
                    <select name="property_interest"
                      class="block w-full px-5 py-3 rounded-md border border-solid border-alpha-light dark:border-alpha-dark text-inherit text-base focus:border-primary @error('property_interest') border-red-500 @enderror">
                      <option value="">Property Interest</option>
                      <option value="sukhumvit" {{ old('property_interest') == 'sukhumvit' ? 'selected' : '' }}>Sukhumvit
                        Area</option>
                      <option value="rama9" {{ old('property_interest') == 'rama9' ? 'selected' : '' }}>Rama 9 Area</option>
                      <option value="bangna" {{ old('property_interest') == 'bangna' ? 'selected' : '' }}>Bang Na Area
                      </option>
                      <option value="bangchak" {{ old('property_interest') == 'bangchak' ? 'selected' : '' }}>Bang Chak Area
                      </option>
                      <option value="other" {{ old('property_interest') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('property_interest')
                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="col-12">
                    <textarea name="message" rows="5"
                      class="block w-full px-5 py-3 rounded-md border border-solid border-alpha-light dark:border-alpha-dark text-inherit text-base focus:border-primary @error('message') border-red-500 @enderror"
                      placeholder="Type your message" required>{{ old('message') }}</textarea>
                    @error('message')
                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="col-12">
                    <div class="w-full text-center">
                      <button type="submit"
                        class="inline-block px-5 py-3 rounded-md text-base bg-primary text-primary-color hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:bg-primary-light-10 dark:focus:bg-primary-dark-10">
                        Send Message
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Interactive Map section with Ideo Locations -->
    <section id="locations-map" class="section-area !pt-0">
      <div class="container">
        <div class="scroll-revealed text-center max-w-[550px] mx-auto mb-12">
          <h6 class="mb-2 block text-lg font-semibold text-primary">
            Our Locations
          </h6>
          <h2 class="mb-6">Find Ideo Near You</h2>
          <p>
            Explore our premium condominium locations across Bangkok. Click on any marker to learn more about
            each property.
          </p>
        </div>

        <div class="scroll-revealed rounded-xl overflow-hidden shadow-lg">
          <div id="map" class="w-full h-[600px]"></div>
        </div>
      </div>
    </section>

  </main>

  <!-- Google Maps Script -->
  <script>
    let map;
    let infoWindow;

    // Ideo locations with coordinates
    const ideoLocations = [{
      name: "Ideo Q Sukhumvit 36",
      position: {
        lat: 13.7307,
        lng: 100.5707
      },
      address: "Sukhumvit 36, Khlong Tan, Khlong Toei",
      station: "BTS Thong Lo (600m)"
    },
    {
      name: "Ideo Rama 9 - Asoke",
      position: {
        lat: 13.7589,
        lng: 100.5644
      },
      address: "Phra Ram 9 Road, Huai Khwang",
      station: "MRT Phra Ram 9 (400m)"
    },
    {
      name: "Ideo O2",
      position: {
        lat: 13.6673,
        lng: 100.6341
      },
      address: "Sanphawut Road, Bang Na",
      station: "BTS Bang Na (2km)"
    },
    {
      name: "Ideo Sukhumvit 93",
      position: {
        lat: 13.6867,
        lng: 100.6119
      },
      address: "Sukhumvit 93, Bang Chak",
      station: "BTS Bang Chak (800m)"
    },
    {
      name: "Ideo Sukhumvit 115",
      position: {
        lat: 13.6792,
        lng: 100.6245
      },
      address: "Sukhumvit 115, Samrong Nuea",
      station: "BTS Samrong (1.5km)"
    },
    {
      name: "Ideo Mobi Sukhumvit",
      position: {
        lat: 13.7200,
        lng: 100.5900
      },
      address: "Sukhumvit Road, various locations",
      station: "Near BTS stations"
    }
    ];

    function initMap() {
      // Center map on Bangkok
      const bangkok = {
        lat: 13.7307,
        lng: 100.5607
      };

      map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: bangkok,
        styles: [{
          "featureType": "water",
          "elementType": "geometry",
          "stylers": [{
            "color": "#e9e9e9"
          }, {
            "lightness": 17
          }]
        },
        {
          "featureType": "landscape",
          "elementType": "geometry",
          "stylers": [{
            "color": "#f5f5f5"
          }, {
            "lightness": 20
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#ffffff"
          }, {
            "lightness": 17
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#ffffff"
          }, {
            "lightness": 29
          }, {
            "weight": 0.2
          }]
        }
        ]
      });

      infoWindow = new google.maps.InfoWindow();

      // Add markers for each Ideo location
      ideoLocations.forEach((location) => {
        const marker = new google.maps.Marker({
          position: location.position,
          map: map,
          title: location.name,
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 10,
            fillColor: "#3d63dd",
            fillOpacity: 1,
            strokeColor: "#ffffff",
            strokeWeight: 3,
          }
        });

        marker.addListener("click", () => {
          const contentString = `
                                                  <div style="padding: 10px; max-width: 250px;">
                                                      <h3 style="margin: 0 0 8px 0; color: #3d63dd; font-size: 16px; font-weight: 600;">${location.name}</h3>
                                                      <p style="margin: 0 0 4px 0; font-size: 14px; color: #666;">${location.address}</p>
                                                      <p style="margin: 0; font-size: 13px; color: #888;"><strong>Transit:</strong> ${location.station}</p>
                                                  </div>
                                              `;
          infoWindow.setContent(contentString);
          infoWindow.open(map, marker);
        });
      });
    }

    // Load Google Maps API
    window.initMap = initMap;
  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
@endsection