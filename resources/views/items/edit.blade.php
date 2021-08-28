<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{route('collection.item.edit',[$collection->id, $item->id])}}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    @csrf
                    <!-- Item Name -->
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Title</label>

                            @error('title')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-sm-6">
                                <input type="text" name="title" id="item-title" class="form-control" value="{{$item->title}}">
                            </div>

                        </div>

                        <!-- Item Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            @error('description')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-sm-6">
                                <input type="text" name="description" id="item-description" class="form-control" value="{{$item->description}}">
                            </div>

                        </div>

                        <div class="w-48 h-48">
                           <img src="{{asset($item->file_path)}}" class="object-cover h-48 w-full"></img>
                        </div>

                        <div class="md:flex md:justify-center mb-6">
                            <input type="file" name="item-image">
                        </div>

                        <div>
                          <form action="{{route('collection.item.update',[$collection->id, $item->id])}}" method="POST">
                              @csrf
                              @method('PUT')
                              <button>Update</button>
                          </form>
                        </div>

                    </form>
                  </div>

                  <div>

                  </div>
        </div>
    </div>
    </div>
</x-app-layout>
