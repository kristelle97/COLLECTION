<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @include('flash::message')

            <div>
                @if ($errors->any())
                <div class="bg-red-200 text-red-700 mb-4 rounded">
                    <div class="pl-8">
                        <p>Your Profile could not be updated because:</p>
                        <ul class="list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{route('user.edit')}}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    @csrf
                        <!-- User Name -->
                        <x-forms.form-group name="name" label="Name" id="user-name" placeholder="{{$user->name}}" value="{{$user->name}}"></x-forms.form-group>

                        <!-- User Email -->
                        <x-forms.form-group name="email" label="Email" id="user-email" placeholder="{{$user->email}}" value="{{$user->email}}"></x-forms.form-group>

                        <div class="flex flex-wrap justify-center items-center gap-4">

                            <div class="w-48 h-48">
                            <img src="{{asset($user->file_path)}}" class="object-cover h-48 w-full rounded"></img>
                            </div>

                            <div class="md:flex md:justify-center mb-6">
                                <input type="file" name="profile-image">
                            </div>

                        </div>

                        <!-- Update User Button -->
                        <div class="flex justify-center mt-4">
                          <form action="{{route('user.update')}}" method="POST">
                              @csrf
                              @method('POST')
                              <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                          </form>
                        </div>
                  </form>

        </div>
    </div>
    </div>
</x-app-layout>
