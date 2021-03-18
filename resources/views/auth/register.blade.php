@extends('master')
@section('mainContent')

<style type="text/css">
    body{
        background-color: #e5e7eb;
    }

    @media screen and (max-width: 600px) {
    .logo_main{
        width: 50%;
        margin-bottom: 25px;
    }

    .col-lg-6{
        margin-bottom: 8px;
    }
}
</style>

<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
       <div class="flex md:w-1/5 justify-center" style="margin: 0 auto; margin-bottom: 2%; margin-top: 5%;">
        <img class="logo_main" style="text-align: center;" src="{{ asset('img/dodotracking.png') }}" alt="">
    </div>
    <div class="bg-white rounded-md w-full overflow-hidden shadow" style="padding: 10%; margin-bottom: 10%;">
        <div class="rounded-lg bg-white">
            <div class="row">
                <div>
                    <h2 style="margin-bottom: 25px;" class="text-xl text-gray-800 font-bold leading-tight">Register Here</h2>
                </div>
            </div>
            <div class="line relative">

                <div class="row">


                    <form method="POST" action="{{ route('register') }}" style="width: 100%;">
                        @csrf

                        @if ($errors->any())
                        <x-alert-danger>
                            <ul class=" list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </x-alert-danger>
                        @endif

                        <!-- Shop Id -->
                        {{-- <div>
                            <x-label for="shop_id">Shop Id</x-label>

                            <x-input id="shop_id" class="block form-control w-full" type="text" name="shop_id"
                            :value="old('shop_id')" required autofocus />
                        </div> --}}

                        <div class="row" style="margin-bottom: 15px;">

                           <div class="col-lg-6 col-md-6">

                            <x-label for="username">User Name</x-label>

                            <x-input id="username" class="block  form-control w-full" type="text" name="username"
                            :value="old('username')" required />
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <x-label for="shopname">Shop Name</x-label>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required />
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-lg-6">
                        <x-label for="contactname">Contact Name</x-label>

                        <x-input id="contactname" class="block mt-1 w-full" type="text" name="contactname"
                        :value="old('contactname')" required />
                    </div>
                    <div class="col-lg-6">
                        <x-label for="phone">Mobile Number</x-label>

                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                        :value="old('phone')" required />
                    </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                           <div class="col-lg-6">
                        <x-label for="email">Email</x-label>

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required />
                    </div>
                    <div class="col-lg-6">
                        <x-label for="lineid">Line Id</x-label>

                        <x-input id="lineid" class="block mt-1 w-full" type="text" name="lineid"
                        :value="old('lineid')" required />
                    </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                          <div class="col-lg-6">
                        <x-label for="password">Password</x-label>

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                        required autocomplete="password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-lg-6">
                        <x-label for="password_confirmation">Confirm Password</x-label>

                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required />
                    </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                  
                        <label for="remember_me" class="inline-flex items-center">
                            <input style="margin-left: 15px;" required id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('I accept your terms and Condition') }}</span>
                        </label>
              
                    </div>

                    
                    

                    <!-- Email Address -->
                 
                    <!-- Password -->
                  
                    

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
<div class="col-lg-2"></div>
</div>



</div>

@endsection