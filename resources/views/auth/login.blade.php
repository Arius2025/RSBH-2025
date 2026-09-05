<x-guest-layout>
    <div class="mb-6 text-center">
        <h4 class="text-2xl font-heading font-bold text-military-green-dark">Masuk ke Panel Admin</h4>
        <p class="text-sm text-gray-500 mt-1">Silakan otentikasi untuk melanjutkan</p>
    </div>

    <x-auth-session-status class="mb-4 text-green-600 font-medium" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-5">
        @csrf

        {{-- Email Address --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-military-green focus:border-military-green transition-shadow shadow-sm text-sm"
                    placeholder="nama@email.com" />
            </div>
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
            <div class="relative" x-data="{ show: false }">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </div>
                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                    class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-military-green focus:border-military-green transition-shadow shadow-sm text-sm"
                    placeholder="••••••••" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-military-green transition-colors focus:outline-none">
                    <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                </button>
            </div>
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Remember & Forgot --}}
        <div class="flex items-center justify-between pt-1">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-military-green focus:ring-military-green border-gray-300 rounded cursor-pointer transition-colors">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600 cursor-pointer select-none">
                    Ingat Saya
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-military-green hover:text-gold-dark transition-colors" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-military-green/20 text-sm font-bold text-white bg-military-green hover:bg-military-green-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-military-green transition-all duration-300 active:scale-[0.98]">
                <span class="material-symbols-outlined mr-2 text-[20px]">login</span> Masuk
            </button>
        </div>
    </form>
    
    @if (Route::has('register'))
    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm text-gray-500 mb-3">Belum memiliki akses admin?</p>
        <a href="{{ route('register') }}" class="inline-flex justify-center w-full px-4 py-2.5 text-sm font-semibold text-military-green bg-white border-2 border-military-green/20 hover:border-military-green hover:bg-military-green/5 rounded-xl transition-colors duration-300">
            Daftar Akun Baru
        </a>
    </div>
    @endif
</x-guest-layout>