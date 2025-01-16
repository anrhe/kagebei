<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password? Tenang saja. Tulis email anda dan akan kami konfirmsikan ke admin agar anda dapat mereset password anda dan membuat password baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button onclick="redirectWithAlert()">
                {{ __('Kirim Email Anda') }}
            </x-primary-button>
        </div>
        
        <script>
            function redirectWithAlert() {
                // Arahkan ke halaman "welcome" dengan query string
                window.location.href = "/welcome?alert=true";
            }
        </script>
        
        
    </form>
</x-guest-layout>
