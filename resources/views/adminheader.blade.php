<nav class="bg-white shadow py-4 px-8 flex justify-between items-center">
    <!-- Sol: VOLspares & Menü -->
    <div class="flex items-center gap-8">
        <a href="{{ route('homepage') }}" class="text-xl font-bold text-blue-700">VOLspares</a>
        <a href="{{ route('homepage') }}" class="hover:text-blue-700 font-semibold {{ request()->routeIs('homepage') ? 'text-blue-700' : 'text-gray-800' }}">Home Page</a>
        <a href="{{ route('spare-parts.index') }}" class="hover:text-blue-700 font-semibold {{ request()->routeIs('spare-parts.*') ? 'text-blue-700' : 'text-gray-800' }}">Spare Parts</a>
        @auth
            <a href="{{ route('dashboard') }}" class="hover:text-blue-700 font-semibold {{ request()->routeIs('dashboard') ? 'text-blue-700' : 'text-gray-800' }}">Dashboard</a>
        @endauth
    </div>
    <!-- Sağ: Login/Register veya Profil Dropdown -->
    <div class="flex items-center gap-4">
        <div class="relative group">
            <button class="flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 transition font-semibold focus:outline-none">
                <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <span>{{ Auth::user()?->name }}</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <!-- Dropdown Menü -->
            <div class="absolute right-0 mt-0.4 w-48 bg-white border rounded shadow-lg z-50 hidden group-hover:block group-focus:block">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
