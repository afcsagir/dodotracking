@extends('master')
@section('mainContent')

            <div class="w-screen py-12 flex items-center justify-center flex-col">
                <div class="flex md:w-1/5 justify-center">
                    <img class="w-6/12 md:w-4/5" src="{{ asset('img/dodotracking.png') }}" alt="">
                </div>
                <div class="px-8 mt-6">
                    <div class="bg-white rounded-md w-full overflow-hidden shadow">
                        <div class="p-6 md:px-10 rounded-lg bg-white">
                            <div class="md:flex md:justify-between md:items-center">
                                <div>
                                    <h2 class="text-xl text-gray-800 font-bold leading-tight">Sign In</h2>
                                </div>
                            </div>
                            <div class="line my-4 mx-2 relative">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    @if ($errors->any())
                                        <x-alert-danger>
                                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </x-alert-danger>
                                    @endif

                                    <!-- Shop Id -->
                                    {{-- <div>
                                        <x-label for="shop_id">Shop Id</x-label>

                                        <x-input id="shop_id" class="block mt-1 w-full" type="text" name="shop_id"
                                            :value="old('shop_id')" required autofocus />
                                    </div> --}}
                                    <div class="mt-4">
                                        <x-label for="username">User Name</x-label>

                                        <x-input id="username" class="block mt-1 w-full" type="text" name="username"
                                            :value="old('username')" required />
                                    </div>
                                    <div class="mt-4">
                                        <x-label for="shopname">Shop Name</x-label>

                                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                            :value="old('name')" required />
                                    </div>
                                    <div class="mt-4">
                                        <x-label for="contactname">Contact Name</x-label>

                                        <x-input id="contactname" class="block mt-1 w-full" type="text" name="contactname"
                                            :value="old('contactname')" required />
                                    </div>
                                    <div class="mt-4">
                                        <x-label for="phone">Mobile Number</x-label>

                                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                            :value="old('phone')" required />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-4">
                                        <x-label for="email">Email</x-label>

                                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email')" required />
                                    </div>
                                    <div class="mt-4">
                                        <x-label for="lineid">Line Id</x-label>

                                        <x-input id="lineid" class="block mt-1 w-full" type="text" name="lineid"
                                            :value="old('lineid')" required />
                                    </div>
                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-label for="password">Password</x-label>

                                        <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                            required autocomplete="password" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <x-label for="password_confirmation">Confirm Password</x-label>

                                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                            name="password_confirmation" required />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                            href="{{ route('signin') }}">
                                            {{ __('Already registered?') }}
                                        </a>

                                        <x-button color="blue" class="ml-4">
                                            {{ __('Register') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
@endsection