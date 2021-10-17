<x-guest-layout>
        <div class="pl-8 pr-8">
            <!-- @if (Route::has('login'))
                <div class="fixed top-0 right-0 px-6 py-4 mb-8 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->

            <div class='flex mt-12 mb-4 justify-center'>
              <h1 class="text-2xl">All Users' Collections</h1>
            </div>

            <form action="{{route('index')}}" enctype="multipart/form-data" method="GET">
            @csrf
            <div class="flex justify-center mb-6">
              <select id="collectionTag" name="tag" class="rounded border-none py-2 px-4 block whitespace-no-wrap hover:text-blue-500">
                <option value="" disabled selected hidden>Filter by Collection Type</option>
                @foreach ($tags['tags'] as $tag)
                  <option @if ($tag==request()->tag) selected @endif>{{$tag}}</option>
                @endforeach
              </select>
            </div>

            <div class='flex flex-row justify-center items-center'>
              <div>
              <x-button><i class="fas fa-filter"></i> Filter</x-button>
            </div>
            <div>
              @if (request()->has('tag'))
              <a href="{{route('index')}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2">Clear Filter</a>
              @endif
            </div>
          </div>

          </form>

              @if (count($collections) > 0)
              <div class="px-4 mb-6 grid lg:grid-cols-3 md:grid-cols-2 gap-4 grid-cols-1 mt-8">
                  @foreach ($collections as $collection)
                        <div class=" w-full lg:max-w-full flex flex-col shadow-lg rounded h-auto">
                          <div class="relative h-48 w-full">
                            <div class="absolute top-5 left-5 text-xs font-semibold tracking-wide uppercase">
                                <span class="p-1 px-2 bg-yellow-100 rounded-full bg-cover">{{$collection->tag}}</span>
                              </div>
                             <img src="{{asset($collection->file_path)}}" class="object-cover h-48 w-full"></img>
                          </div>

                          <div class="flex flex-grow items-stretch">
                            <div class="p-5 flex-grow flex flex-col w-full sm:w-auto">

                              <div>
                                <h1 class="text-gray-900 font-bold text-xl mb-2">{{$collection->title}}</h1>
                                <p class="text-gray-700 text-base">{{$collection->description}}</p>
                              </div>
                              

                              <div class="flex flex-row items-end flex-grow mt-4">
                                <div class="flex items-center">
                                <img class="rounded-full w-12 h-12" src="{{asset($collection->user->file_path)}}"></img>
                                <div class="text-sm mt-4 pl-4">
                                  <p class="text-gray-900 leading-none">{{$collection->user->name}}</p>
                                  <p class="text-gray-600">{{$collection->created_at}}</p>
                                </div>
                              </div>
                              </div>
                            </div>

                            <div class="flex w-1/3 flex-col w-12 mt-3 justify-center items-end pr-5">
                              @if (Auth::check() && $collection->user_id == Auth::user()->id)
                              <x-forms.delete-button :action="route('collection.destroy',$collection->id)" onclick="return confirm('Are you sure?')" class='bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2'><i class="far fa-trash-alt"></i></x-forms.delete-button>
                              <a href="{{route('collection.edit', $collection->id)}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2"><i class="far fa-edit transform rotate-180"></i></a>
                              @endif
                              <a href="{{route('collection.item.index', $collection->id)}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2"><i class="fas fa-expand"></i></a>
                              <div class="flex w-full flex-col w-12 mt-3 justify-end items-end">
                                <form action="{{route('collection.like', $collection->id)}}" enctype="multipart/form-data" method="POST">
                                  @csrf
                                <div class="flex flex-row bg-transparent text-gray-400 font-semibold hover:text-blue-800">
                                  <button>
                                    @if ($collection->liked())
                                      <i class="fas fa-heart"></i>
                                    @else
                                      <i class="far fa-heart"></i>
                                    @endif
                                  </button>
                                  <p>{{$collection->likeCount}}</p>
                                </div>
                              </form>
                            </div>
                          </div>

                          </div>

                          </div>
                  @endforeach

            @else
              <p>No Items Created</p>
              
            @endif
                  </div>
                </div>
                </div>
          </div>
</x-guest-layout>
