<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Profile') }}
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

                            <div class="flex justify-center">
                                <div class="relative md:w-2/3 w-full mb-3" x-data="{ show: true }">
                                    <label for="password" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Password</label>
                                    <input :type="show ? 'password' : 'text'" name="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue" placeholder="" />
                                    <div class=" absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 ">
                                        <p class=" mt-5 text-gray-700" @click="show=! show" x-text=" show ? 'Show' : 'Hide' "></p>
                                    </div>
                                </div>      
                            </div>
                            
                            <div class="flex flex-grid-2 gap-4 justify-center items-center">
                                <div class="w-48 h-48">
                                <img src="{{asset($user->file_path)}}" class="object-cover h-48 w-full rounded"></img>
                                </div>
                            </div>

                            <x-forms.image-upload name="collection-image"></x-forms.image-upload>

                            <!-- Update User Button -->
                            <div class="flex justify-center mt-4">
                            <form action="{{route('user.update')}}" method="POST">
                                @csrf
                                @method('POST')
                                <x-button>Update</x-button>
                            </form>
                            </div>
                    </form>

        </div>
    </div>
    </div>
</x-app-layout>
