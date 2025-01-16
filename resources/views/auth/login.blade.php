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
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <!-- Wrapper untuk input password -->
            <div class="relative flex items-center">
                <!-- Input Password -->
                <input id="password" 
                       class="block w-full pr-12 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password" />
                
                <!-- Icon Mata -->
                <button type="button" id="toggle-password" 
                        class="ml-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2C5.455 2 1.732 5.098 0 10c1.732 4.902 5.455 8 10 8s8.268-3.098 10-8c-1.732-4.902-5.455-8-10-8zm0 14c-3.065 0-5.872-2.118-7.645-5C4.128 6.118 6.935 4 10 4s5.872 2.118 7.645 5c-1.773 2.882-4.58 5-7.645 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Tombol Login -->
        <div class="flex items-center justify-end mt-4 gap-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif

            <x-primary-button class="rounded-md px-3 py-2 text-white text-sm lg:text-base ring-1 transition hover:text-black/70 focus:outline-none" style="background-color: #a6c4ff !important;">
                {{ __('Masuk Akun') }}
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
