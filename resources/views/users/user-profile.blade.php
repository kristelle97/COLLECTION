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

                  <p>{{ Auth::user()->name }}</p>
                  <p>{{ Auth::user()->email }}</p>

                  <div class="w-48 h-48">
                     <img src="{{ Auth::user()->file_path }}" class="object-cover h-48 w-full"></img>
                  </div>


        </div>
    </div>
    </div>
</x-app-layout>
