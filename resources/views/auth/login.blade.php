<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Menampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />
            
            <!-- Input Password -->
            <x-text-input id="password" class="block mt-1 w-full pr-10"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Toggle Password Visibility -->
            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2C5.455 2 1.732 5.098 0 10c1.732 4.902 5.455 8 10 8s8.268-3.098 10-8c-1.732-4.902-5.455-8-10-8zm0 14c-3.065 0-5.872-2.118-7.645-5C4.128 6.118 6.935 4 10 4s5.872 2.118 7.645 5c-1.773 2.882-4.58 5-7.645 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
                </svg>
            </button>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- JavaScript -->
    <script>
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        togglePassword.addEventListener('click', () => {
            // Toggle password visibility
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
        });
    </script>
</x-guest-layout>
