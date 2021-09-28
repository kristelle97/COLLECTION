<x-guest-layout>
        <div class="pl-8 pr-8">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 mb-8 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class='flex mt-24'>
              <h1>All Users' Collections</h1>
            </div>

            <form action="{{route('index')}}" enctype="multipart/form-data" method="GET">
            @csrf
            <div class="md:flex md:justify-center mb-6">
              <select id="collectionTag" name="tag" class="rounded border-none py-2 px-4 block whitespace-no-wrap hover:text-blue-500">
                <option value="" disabled selected hidden>Filter by Collection Type</option>
                @foreach ($tags['tags'] as $tag)
                  <option @if ($tag==request()->tag) selected @endif>{{$tag}}</option>
                @endforeach
              </select>
            </div>

            <div class='flex flex-row justify-center items-center'>
              <div>
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              <i class="fas fa-filter"></i> Filter
              </button>
            </div>
            <div>
              @if (request()->has('tag'))
              <a href="{{route('index')}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2">Clear Filter</a>
              @endif
            </div>
          </div>

          </form>

              @if (count($collections) > 0)
              <div class="flex justify-start md:justify-start flex-wrap mb-6">
                  @foreach ($collections as $collection)
                        <div class=" w-full lg:max-w-full flex flex-wrap content-start shadow-lg rounded">
                          <div class="w-48 h-48">
                             <img src="{{asset($collection->file_path)}}" class="object-cover h-48 w-full"></img>
                          </div>
                            <div class="p-5 flex-grow w-full sm:w-auto">
                              <div class="text-gray-900 font-bold text-xl mb-2">{{$collection->title}}</div>
                              <p class="text-gray-700 text-base">{{$collection->description}}</p>
                              <p class="mb-3 mt-3 text-xs font-semibold tracking-wide uppercase">
                                <span class="p-1 px-2 bg-yellow-100 rounded-full bg-cover">{{$collection->tag}}</span>
                              </p>
                              <div class="flex flex-row">
                                <!-- <img class="rounded-full w-12 h-12" src="{{asset($collection->user->file_path)}}"></img> -->
                              <div class="text-sm mt-4 pl-4">
                                <p class="text-gray-900 leading-none">{{$collection->user->name}}</p>
                                <p class="text-gray-600">{{$collection->created_at}}</p>
                              </div>
                            </div>
                            </div>

                            <div class="flex w-full sm:flex-col sm:w-12 mt-3 justify-end items-center">
                              @if (Auth::check() && $collection->user_id == Auth::user()->id)
                              <button action="route('collection.destroy',['collectionId'=>$collection->id])" onclick="return confirm('Are you sure?')" class='bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2'><i class="far fa-trash-alt"></i></button>
                              <a href="{{route('collection.edit', $collection->id)}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2"><i class="far fa-edit"></i></a>
                            @endif
                            <a href="{{route('collection.item.index', $collection->id)}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2"><i class="fas fa-expand"></i></a>
                            <div class="flex w-full sm:flex-col sm:w-12 mt-3 justify-end items-center">
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

                  @endforeach
                </div>
              @endif
          </div>
</x-guest-layout>
