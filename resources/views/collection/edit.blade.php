<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Collection') }}
        </h2>
    </x-slot>


    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                <div class="bg-red-200 text-red-700 mb-4 rounded">
                    <div class="pl-8">
                    <p>Your Collection could not be updated because:</p>
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
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{route('collection.edit',$collection->id)}}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    @csrf
                        <!-- Collection Name -->
                        <x-forms.form-group name="title" label="Title" id="collection-title" placeholder="{{$collection->title}}" value="{{$collection->title}}"></x-forms.form-group>


                        <!-- Collection Description -->
                        <x-forms.form-group name="description" label="Description" id="collection-description" placeholder="{{$collection->description}}" value="{{$collection->description}}"></x-forms.form-group>
                        
                        <div class="flex justify-center">
                            <div class="mb-6 lg:w-2/3 md:w-2/3 sm:w-full">
                                <label for="collectionTag" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Tag</label>
                                <select id="collectionTag" name="tag" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-500 leading-tight focus:outline-none focus:bg-white focus:border-blue">
                                    <option value="{{$collection->tag}}" selected >{{$collection->tag}}</option>
                                    @foreach ($tags['tags'] as $tag)
                                    <option>{{$tag}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="relative flex justify-center items-center gap-4 mb-6" x-data="{}">
                            <div class="w-48 h-48">
                                <div  x-on:click="$dispatch('img-modal', {  imgModalSrc: '{{Storage::url($collection->file_path)}}', imgModalDesc: '{{$collection->title}}' })" class="absolute inset-0 cursor-pointer z-20"></div>
                                <img src="{{Storage::url($collection->file_path)}}" class="object-cover h-48 w-full rounded"></img>
                            </div>
                        </div>

                        <x-forms.image-upload name="collection-image" title="Collection Image"></x-forms.image-upload>

                        <!-- Update Collection Button -->
                        <div class="flex justify-center">
                          <form action="{{route('collection.update',$collection->id)}}" method="POST">
                              @csrf
                              @method('PUT')                        
                              <x-button>Update</x-button>
                            </form>
                        </div>

                  </form>

        </div>
    </div>
    </div>
</x-app-layout>
