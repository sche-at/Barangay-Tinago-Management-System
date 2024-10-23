<x-guest-layout>
    <!-- Add inline styles for background image -->
    <style>
        body {
            background-image: url('{{ asset('assets/img/house.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Overlay for better text visibility */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
            z-index: 1; /* Keep it below the form */
        }

        .form-container {
            position: relative;
            z-index: 2; /* Keep form above the overlay */
            background-color: white; /* White background for form */
            padding: 2rem; /* Padding for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        }
    </style>

    <div class="overlay"></div> <!-- Overlay -->

    <div class="form-container">
        <!-- Session Status -->
        <x-auth-session-status class="mb-2" :status="session('status')" />
        
        <div class="flex justify-center">
            <img src="{{ asset('assets/img/tinago.png') }}" alt="Barangay Logo" style="width: 155px; height: 155px;">
        </div>

        <!-- Title or Welcome Message -->
        <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">
            Barangay Tinago System Login
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Register Link -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                @endif

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="flex items-center justify-end mt-4 mb-5">
                <x-primary-button class="ms-4">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
