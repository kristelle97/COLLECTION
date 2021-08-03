<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Collection Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{route('collection.store')}}" method="POST" class="w-full max-w-s bg-white pt-6 rounded">
                    @csrf
                    <!-- Collection Name -->
                        <div class="md:flex md:justify-center mb-6">
                          <div class="md:w-2/3">
                            <label for="title" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Title</label>

                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" name="title" id="collection-title" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="Jane Doe's Collection">
                            </div>

                        </div>

                        <x-forms.forms-group : for="title" name="title" id="item-title" placeholder="Collection Title"/>

                        <!-- Collection Description -->
                        <div class="md:flex md:justify-center mb-6">
                          <div class="md:w-2/3">
                            <label for="description" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-2 pr-4">Description</label>

                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" name="description" id="collection-description" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 h-24">
                            </div>
                        </div>
                        <!-- Add Task Button -->
                        <div class="md:flex md:justify-center pb-6 mb-24">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create Collection
                                </button>
                            </div>
                        </div>
                    </form>

                    @if (count($collections) > 0)
                    <div class="flex justify-center md:justify-start flex-wrap mb-6">
                        @foreach ($collections as $collection)

                            <div class=" w-full lg:max-w-full flex flex-wrap shadow-lg rounded">
                              <!-- <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/mountain.jpg')" title="Mountain">
                              </div> -->
                                <div class="p-5 flex-grow w-full sm:w-auto">
                                  <div class="text-gray-900 font-bold text-xl mb-2">{{$collection->title}}</div>
                                  <p class="text-gray-700 text-base">{{$collection->description}}</p>
                                  <div class="flex flex-row">
                                  <i class="fas fa-user-tie mt-4"></i>
                                  <div class="text-sm mt-4">
                                    <p class="text-gray-900 leading-none">{{$collection->user->name}}</p>
                                    <p class="text-gray-600">{{$collection->created_at}}</p>
                                  </div>
                                </div>
                                </div>
                                <div class="flex w-full sm:flex-col sm:w-12 mt-3 justify-end items-center">
                                  <x-forms.deleteButton :action="route('collection.destroy',['collectionId'=>$collection->id])"><i class="far fa-trash-alt"></i></x-forms.deleteButton>
                                  <a href="{{route('collection.edit', $collection->id)}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2"><i class="far fa-edit"></i></a>
                                  <a href="{{route('collection.item.index', $collection->id)}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2"><i class="fas fa-expand"></i></a>
                                </div>
                              </div>


                        @endforeach

                    @endif
                </div>
                {{ $collections->links() }}
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
