<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Collection Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mb-12 justify-center">
        <div class="max-w-7xl mx-auto px-8">

        @include('flash::message')

          <div>
            @if ($errors->any())
              <div class="bg-red-200 text-red-700 mb-4 rounded">
                <div class="pl-8">
                <p>Your Collection could not be created because:</p>
                  <ul class="list-disc">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
              </div>
            @endif
        </div>

        <x-img-modal/>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

              <div x-data={show:false}>
                  <p class="flex">
                      <a x-on:click.prevent="show=!show" class="text-gray-500 rounded hover:text-blue-500 px-8 pt-4 pb-2 cursor-pointer focus:outline-none mr-2">
                      <i class="fas fa-plus"></i> New Collection
                      </a>
                  </p>

                <div x-show="show" class="p-6">

                    <form action="{{route('collection.store')}}" enctype="multipart/form-data" method="POST" class="w-full max-w-s bg-white pt-6 rounded">
                    @csrf
                    <!-- Collection Name -->
                        <x-forms.form-group name="title" label="Title" id="collection-id" placeholder="Collection Title">

                        </x-forms.form-group>

                        <div class="flex justify-center">
                          <div class="mb-6 lg:w-2/3 md:w-2/3 sm:w-full">
                              <label for="collectionTag" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Tag</label>
                              <select id="collectionTag" name="tag" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-blue">
                                  <option value="" disabled selected hidden>Type of Collection</option>
                                  @foreach ($tags['tags'] as $tag)
                                    <option>{{$tag}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>

                        <!-- Collection Description -->
                        <x-forms.form-group name="description" label="Description" id="collection-description" placeholder="Collection Description" size="h-24"></x-forms.form-group>

                        <x-forms.image-upload name="collection-image" title="Collection Image"></x-forms.image-upload>

                        <!-- Add Collection Button -->
                        <x-forms.submit-button>Create Collection</x-forms.submit-button>

                    </form>
                  </div>
                </div>

                    @if (count($collections) > 0)
                    <div class="p-4 mb-6 grid lg:grid-cols-3 md:grid-cols-2 gap-4 grid-cols-1 mt-8" x-data="{}">
                        @foreach ($collections as $collection)

                        <div class=" w-full lg:max-w-full flex flex-col shadow-lg rounded h-auto">
                          <div class="relative h-48 w-full">
                            <div class="absolute top-5 left-5 text-xs font-semibold tracking-wide uppercase z-10">
                                <span class="p-1 px-2 bg-yellow-100 rounded-full bg-cover">{{$collection->tag}}</span>
                              </div>
                              <div  x-on:click="$dispatch('img-modal', {  imgModalSrc: '{{Storage::url($collection->file_path)}}', imgModalDesc: '{{$collection->title}}' })" class="absolute inset-0 cursor-pointer z-20"></div>
                             <img src="{{Storage::url($collection->file_path)}}" class="object-cover h-48 w-full z-0"/>
                          </div>

                          <div class="flex flex-grow items-stretch">
                            <div class="p-5 flex-grow flex flex-col w-full sm:w-auto">

                              <div>
                                <h1 class="text-gray-900 font-bold text-xl mb-2">{{$collection->title}}</h1>
                                <p class="text-gray-700 text-base">{{$collection->description}}</p>
                              </div>
                              

                              <div class="flex flex-row items-end flex-grow mt-4">
                                <div class="flex items-center">
                                <img class="rounded-full w-12 h-12" src="{{Storage::url($collection->user->file_path)}}"></img>
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

                    @endif
                </div>
                {{ $collections->links() }}
              </div>
            </div>
        </div>
</x-app-layout>

<script>

</script>
