<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DodoTracking') }} - Sign In</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="h-9/12 md:h-screen bg-gray-200">
        <main>
            <div class="h-screen w-screen py-12 flex items-center justify-center flex-col">
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
                                @if(session('failed'))
                                <x-alert-danger>{{ session('failed') }}</x-alert-danger>
                                @endif
                                <form method="POST" action="{{ route('signin') }}">
                                    @csrf

                                    @if ($errors->any())
                                        <div>
                                            <div class="font-medium text-red-600">
                                                {{ __('Oops! Ada yang salah.') }}
                                            </div>

                                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (Session::has('success'))
                                        <div class="font-medium text-green-600">
                                            Success Inserted
                                        </div>
                                        <div class="text-sm text-green-600">
                                            Your data successfully being inserted
                                        </div>
                                    @endif
                                    @if (Session::has('successs'))
                                       
                                        <div class="text-sm text-green-600">
                                           {{Session::get('successs')}}
                                        </div>
                                    @endif
                                    <div>
                                        <x-label>Phone Number</x-label>
                                        <x-input type="text"  name="phone"></x-input>
                                    </div>
                       
                                    <div class="mt-6">
                                        <x-label>Password</x-label>
                                        <x-input type="password" name="password"></x-input>
                                    </div>
                                    <div class="block mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    
                                    <div class="flex items-center justify-end mt-6">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                            href="{{ route('register') }}">
                                            {{ __('Dont have an account?') }}
                                        </a>

                                        <x-button color="blue" class="ml-4">
                                            {{ __('Signin') }}
                                        </x-button>
                                    </div>

                                    <div class="flex items-center  mt-3">
                                        <a style="margin: 0 auto; font-size: 15px;" class="underline text-sm text-gray-600 hover:text-gray-900"
                                            href="{{ url('forget_password') }}">
                                            {{ __('Forget Password?') }}
                                        </a>

                                  
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
