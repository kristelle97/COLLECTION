<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-col-2 gap-4 items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">"{{$collection->title}}" Dashboard created by @if($collection->user_id == Auth::user()->id) you  @else {{$collection->user->name}} @endif</h2>
        <p class="text-xs font-semibold tracking-wide uppercase">
          <span class="p-1 px-2 bg-yellow-100 rounded-full bg-cover">{{$collection->tag}}</span>
        </p>
    </div>
    </x-slot>

    <x-img-modal/>

    <div class="pt-6">
        <a href="{{url()->previous()}}" class="bg-transparent text-gray-400 font-semibold hover:text-blue-800 px-12">Back</a>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{route('collection.item.edit',[$collection->id, $item->id])}}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    @csrf
                        <!-- Item Name -->

                        <x-forms.form-group name="title" label="Title" id="item-title" placeholder="{{$item->title}}" value="{{$item->title}}"></x-forms.form-group>
                    
                        <!-- Item Description -->

                        <x-forms.form-group name="description" label="Description" id="item-description" placeholder="{{$item->description}}" value="{{$item->description}}"></x-forms.form-group>

                        <div class="relative flex justify-center items-center gap-4" x-data="{}">
                            <div class="w-48 h-48">
                                <div  x-on:click="$dispatch('img-modal', {  imgModalSrc: '{{Storage::url($item->file_path)}}', imgModalDesc: '{{$item->title}}' })" class="absolute inset-0 cursor-pointer z-20"></div>
                                <img src="{{Storage::url($item->file_path)}}" class="object-cover h-48 w-full"/>
                            </div>
                        </div>

                        <x-forms.image-upload name="item-image" title="Item Image"></x-forms.image-upload>

                        <div class="flex justify-center mt-4">
                          <form action="{{route('collection.item.update',[$collection->id, $item->id])}}" method="POST">
                              @csrf
                              @method('PUT')
                              <x-button>Update</x-button>
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
