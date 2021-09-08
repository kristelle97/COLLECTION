<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$collection->title}} Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

              <div x-data={show:false}>
                  <p class="flex">
                      <a x-on:click.prevent="show=!show" class="text-gray-500 rounded hover:text-blue-500 px-8 py-3 cursor-pointer focus:outline-none mr-2">
                      <i class="fas fa-plus"></i> New Item
                      </a>
                  </p>

                <div x-show="show" class="p-6">
                  <form action="{{route('collection.item.store',[$collection->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                  @csrf

                  <!-- Item Name -->
                      <x-forms.form-group name="title" label="Title" id="item-id" placeholder="Item Title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </x-forms.form-group>

                      <!-- Item Description -->
                      <x-forms.form-group name="description" label="Description" id="item-description" placeholder="Item Description" size="h-24">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </x-forms.form-group>

                      <div class="md:flex md:justify-center mb-6">
                          <input type="file" name="item-image" required>
                      </div>

                      <!-- Add Task Button -->
                      <x-forms.submit-button>Create Item</x-forms.submit-button>
                  </form>
                </div>
              </div>

              <div class="px-4 py-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
              <div class="grid gap-8 lg:grid-cols-3 sm:max-w-sm sm:mx-auto lg:max-w-full">
                     @if (count($items) > 0)
                         @foreach ($items as $item)
                               <div class="overflow-hidden transition-shadow duration-300 bg-white rounded shadow-sm">
                                 <div class="w-full h-48">
                                    <img src="{{asset($item->file_path)}}" class="object-cover h-48 w-full"></img>
                                 </div>
                                   <div class="p-5 flex-grow w-full sm:w-auto">
                                     <div class="text-gray-900 font-bold text-xl mb-2">{{$item->title}}</div>
                                     <p class="text-gray-700 text-base">{{$item->description}}</p>
                                     <div class="flex flex-row">
                                       <img class="rounded-full w-12 h-12" src="{{asset($collection->user->file_path)}}"></img>
                                     <div class="text-sm mt-4 pl-4">
                                       <p class="text-gray-900 leading-none">{{$collection->user->name}}</p>
                                       <p class="text-gray-600">{{$item->created_at}}</p>
                                     </div>
                                   </div>
                                   </div>
                                   <div class="flex w-full mb-3 justify-center items-center">
                                     <x-forms.delete-button :action="route('collection.item.destroy',[$collection->id, $item->id])"><i class="far fa-trash-alt"></i></x-forms.delete-button>
                                     <a href="{{route('collection.item.edit',[$collection->id, $item->id])}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2"><i class="far fa-edit"></i></a>
                                   </div>
                                 </div>
                         @endforeach
                     @endif
                    </div>
                  </div>
              </div>
        </div>
    </div>
    </div>
</x-app-layout>
