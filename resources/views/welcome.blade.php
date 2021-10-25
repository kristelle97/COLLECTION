<x-guest-layout>

          <div class="pb-16 bg-indigo-50">

            {{-- Hero --}}

            <div class="bg-white">

              <div class="p-12 flex justify-center items-center">
                <img src="{{asset('/img/koolekt-img.svg')}}" class="object-cover h-100 w-1/3"/>
              </div>
              
              <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                  <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                    <span class="relative inline-block">
                      <svg viewBox="0 0 52 24" fill="currentColor" class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-gray-400 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
                        <defs>
                          <pattern id="dc223fcc-6d72-4ebc-b4ef-abe121034d6e" x="0" y="0" width=".135" height=".30">
                            <circle cx="1" cy="1" r=".7"></circle>
                          </pattern>
                        </defs>
                        <rect fill="url(#dc223fcc-6d72-4ebc-b4ef-abe121034d6e)" width="52" height="24"></rect>
                      </svg>
                      <span class="relative">Showcase</span>
                    </span>
                    your collections
                  </h2>
                  <p class="text-base text-gray-700 md:text-lg">
                    Share your collectibles with the rest of the community. Browse through the collections posted by other users. Enjoy the first space for collectioneurs.
                  </p>
                </div>
                <div class="flex items-center sm:justify-center gap-4">

                  <x-forms.redirect-button url="register" class='inline-flex bg-transparent text-gray-400 font-semibold hover:text-blue-800'>Get Started</x-forms.redirect-button>
                  <a href="#howto">Learn More</a>
                </div>
              </div>

            </div>

            <div class="bg-indigo-50 relative px-4 sm:px-0">
              <div class="absolute inset-0 bg-white h-1/2"></div>
              <div class="relative grid mx-auto overflow-hidden bg-white divide-y rounded shadow sm:divide-y-0 sm:divide-x sm:max-w-screen-sm sm:grid-cols-3 lg:max-w-screen-md">
                <div class="inline-block p-8 text-center ">
                  <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-indigo-50 text-blue">
                    <i class="fas fa-camera"></i>
                  </div>
                  <p class="font-bold tracking-wide text-gray-800">Snap It</p>
                </div>
                <div class="inline-block p-8 text-center">
                  <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-indigo-50 text-blue">
                    <i class="fas fa-upload"></i>
                  </div>
                  <p class="font-bold tracking-wide text-gray-800">Post It</p>
                </div>
                <div class="inline-block p-8 text-center">
                  <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-indigo-50 text-blue">
                    <i class="fas fa-share"></i>
                  </div>
                  <p class="font-bold tracking-wide text-gray-800">Share It</p>
                </div>
              </div>

            </div>
          </div>

          {{-- Features --}}

          <div id="howto" class="bg-indigo-50 px-4 py-16">
            <div class="flex flex-col">
              <div class="max-w-xl pr-16 mx-auto mb-10">
                <h5 class="mb-6 text-3xl font-extrabold leading-none">
                  Your collections at the tip of your Fingers
                </h5>
                <p class="mb-6 text-gray-900">
                  The easiest way to share your passion and discover other collectionneurs who share your passion.
                </p>
                <div class="flex items-center gap-4">
                  <x-forms.redirect-button url="register" class='inline-flex bg-transparent text-gray-400 font-semibold hover:text-blue-800'>Get Started</x-forms.redirect-button>
                </div>
              </div>
              <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="grid max-w-2xl mx-auto">
                  <div class="flex">
                    <div class="flex flex-col items-center mr-6">
                      <div class="w-px h-10 opacity-0 sm:h-full"></div>
                      <div>
                        <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border border-gray-400 rounded-full">
                          1
                        </div>
                      </div>
                      <div class="w-px h-full bg-gray-400"></div>
                    </div>
                    <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
                      <div class="sm:mr-5">
                        <div class="flex items-center justify-center w-16 h-16 my-3 rounded-full bg-white sm:w-24 sm:h-24 text-blue">
                          <i class="fas fa-users fa-2x"></i>
                        </div>
                      </div>
                      <div>
                        <p class="text-xl font-semibold sm:text-base">Create your Profile</p>
                        <p class="text-sm text-gray-700">
                          Sign up and fill your information in a few clicks.  
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="flex flex-col items-center mr-6">
                      <div class="w-px h-10 bg-gray-400 sm:h-full"></div>
                      <div>
                        <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border border-gray-400 rounded-full">
                          2
                        </div>
                      </div>
                      <div class="w-px h-full bg-gray-400"></div>
                    </div>
                    <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
                      <div class="sm:mr-5">
                        <div class="flex items-center justify-center w-16 h-16 my-3 rounded-full bg-white sm:w-24 sm:h-24 text-blue">
                          <i class="fas fa-folder-plus fa-2x"></i>
                        </div>
                      </div>
                      <div>
                        <p class="text-xl font-semibold sm:text-base">Create a Collection</p>
                        <p class="text-sm text-gray-700">
                          Once registered, you can create as many collections as you want. Let others know what you are collecting and show your collections to your friends.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="flex flex-col items-center mr-6">
                      <div class="w-px h-10 bg-gray-400 sm:h-full"></div>
                      <div>
                        <div class="flex items-center justify-center w-8 h-8 text-xs font-medium border border-gray-400 rounded-full">
                          3
                        </div>
                      </div>
                      <div class="w-px h-full opacity-0"></div>
                    </div>
                    <div class="flex flex-col pb-6 sm:items-center sm:flex-row sm:pb-0">
                      <div class="sm:mr-5">
                        <div class="flex items-center justify-center w-16 h-16 my-3 rounded-full bg-white sm:w-24 sm:h-24 text-blue">
                          <i class="fas fa-copy fa-2x"></i>
                        </div>
                      </div>
                      <div>
                        <p class="text-xl font-semibold sm:text-base">Create Items</p>
                        <p class="text-sm text-gray-700">
                          Now that you created a collection, add items to it. Items are your precious collectibles that are part of the collection.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

</x-guest-layout>



