<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$collection->title}} Dashboard created by @if($collection->user_id == Auth::user()->id) you  @else {{$collection->user->name}} @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

              @if (Auth::check() && $collection->user_id == Auth::user()->id)
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
              @endif

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
                                       <p class="text-sm text-gray-600">{{$item->created_at}}</p>
                                   </div>
                                   </div>
                                   <div class="flex w-full mb-3 justify-center items-center">

                                   @if (Auth::check() && $collection->user_id == Auth::user()->id)
                                     <button action="route('collection.item.destroy',[$collection->id, $item->id])" onclick="return confirm('Are you sure?')" class='bg-transparent text-gray-400 font-semibold hover:text-blue-800 mr-8 py-2 px-2'><i class="far fa-trash-alt"></i></button>
                                     <a href="{{route('collection.item.edit',[$collection->id, $item->id])}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 mr-8 py-2 px-2"><i class="far fa-edit"></i></a>
                                  @endif

                                  <div class="py-2 px-2">
                                     <form action="{{route('collection.item.like', [$collection->id, $item->id])}}" enctype="multipart/form-data" method="POST">
                                       @csrf
                                     <div class="flex flex-row bg-transparent text-gray-400 font-semibold hover:text-blue-800">
                                       <button>
                                         @if ($item->liked())
                                           <i class="fas fa-heart"></i>
                                         @else
                                           <i class="far fa-heart"></i>
                                         @endif
                                       </button>
                                       <p class="pr-4">{{$item->likeCount}}</p>
                                     </div>
                                   </form>
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
    </div>
</x-app-layout>
