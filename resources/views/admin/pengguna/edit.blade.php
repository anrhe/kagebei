<x-app-layout>
    <x-slot name="header">
        <button onclick="window.history.back()" 
                class="text-gray-800 hover:text-gray-600 transition duration-200 flex items-center focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                <span class="font-medium">{{ __('Kembali') }}</span>
            </button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('pengguna.update', $pengguna) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $pengguna->name }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ $pengguna->email }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>
                            <select name="role" id="role" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="admin" {{ $pengguna->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="operator" {{ $pengguna->role == 'operator' ? 'selected' : '' }}>Operator</option>
                                <option value="gembala" {{ $pengguna->role == 'gembala' ? 'selected' : '' }}>Gembala</option>
                                <option value="user" {{ $pengguna->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="id_gereja" class="block font-medium text-sm text-gray-700">Gereja</label>
                            <select name="id_gereja" id="id_gereja" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @foreach($gereja as $g)
                                    <option value="{{ $g->id }}" {{ $pengguna->id_gereja == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_gereja')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 relative">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                            <input type="password" name="password" id="password" 
                                   placeholder="Biarkan kosong jika tidak ingin mengubah password"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <!-- Toggle Password Visibility Button -->
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 2C5.455 2 1.732 5.098 0 10c1.732 4.902 5.455 8 10 8s8.268-3.098 10-8c-1.732-4.902-5.455-8-10-8zm0 14c-3.065 0-5.872-2.118-7.645-5C4.128 6.118 6.935 4 10 4s5.872 2.118 7.645 5c-1.773 2.882-4.58 5-7.645 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
                                </svg>
                            </button>
                        </div>
                        
                        
                        <script>
                            // JavaScript to Toggle Password Visibility
                            const togglePasswordButton = document.getElementById('toggle-password');
                            const passwordInput = document.getElementById('password');
                            const eyeIcon = document.getElementById('eye-icon');
                        
                            togglePasswordButton.addEventListener('click', () => {
                                const isPassword = passwordInput.type === 'password';
                                passwordInput.type = isPassword ? 'text' : 'password';
                        
                                // Update Eye Icon (Optional)
                                if (isPassword) {
                                    eyeIcon.setAttribute('fill', '#4A5568'); // Change icon color to indicate visibility
                                } else {
                                    eyeIcon.setAttribute('fill', '#718096'); // Reset icon color
                                }
                            });
                        </script>
                        

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
