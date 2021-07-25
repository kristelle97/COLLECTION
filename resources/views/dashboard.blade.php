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

                    <form action="/collection" method="POST" class="form-horizontal">
                    @csrf

                    <!-- Collection Name -->
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Title</label>

                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-sm-6">
                                <input type="text" name="title" id="collection-title" class="form-control">
                            </div>

                        </div>

                        <!-- Collection Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-sm-6">
                                <input type="text" name="description" id="collection-description" class="form-control">
                            </div>

                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    Create Collection
                                </button>
                            </div>
                        </div>
                    </form>

                    @if (count($collections) > 0)
                        @foreach ($collections as $collection)
                            <div class="card">
                                <button class="container">
                                    <h4><b>{{$collection->title}}</b></h4>
                                    <p>{{$collection->description}}</p>
                                    <form action="/collection/{{ $collection->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button>Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
