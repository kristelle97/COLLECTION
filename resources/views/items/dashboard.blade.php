<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$collection->title}} Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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

                     @if (count($items) > 0)
                         @foreach ($items as $item)
                             <div class="card">
                                 <div class="container flex content-start">

                                   <div class="w-48 h-48">
                                      <img src="{{asset($item->file_path)}}" class="object-cover h-48 w-full"></img>
                                   </div>

                                   <div>
                                     <h4><b>{{$item->title}}</b></h4>
                                     <p>{{$item->description}}</p>
                                     <div class="text-sm mt-4">
                                       <p class="text-gray-600">{{$item->created_at}}</p>
                                     </div>
                                     <x-forms.delete-button :action="route('collection.item.destroy',[$collection->id, $item->id])"><i class="far fa-trash-alt"></i></x-forms.delete-button>
                                     <a href="{{route('collection.item.edit',[$collection->id, $item->id])}}">Edit</a>
                                   </div>
                                 </div>
                             </div>
                         @endforeach
                     @endif

                    </div>
                  </div>
        </div>
    </div>
    </div>
</x-app-layout>
