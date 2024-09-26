<x-guest-layout>
    <x-authentication-card class="bg-white shadow-md rounded-lg p-6">
        <x-slot name="logo">
            <img src="{{ asset('img/logobike.jpeg') }}" width="20%" height="10%" alt="Logo" class="w-24 h-24 rounded-full object-cover mx-auto mb-4" /> <!-- Cambia el tamaño según lo necesites -->
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full border border-gray-300 rounded-md" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full border border-gray-300 rounded-md" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="bg-green-600 hover:bg-green-700 text-white rounded-md px-4 py-2">
                    {{ __('Log in') }}
                </x-button>
                
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
