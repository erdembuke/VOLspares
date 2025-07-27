<header class="bg-white shadow py-4 px-8 flex justify-between items-center fixed w-full top-0 z-50">
    <div class="flex items-center gap-8">
        <a href="{{ route('homepage') }}" class="text-xl font-bold text-blue-700">VOLspares</a>
        <a href="{{ route('homepage') }}" class="hover:text-blue-700 font-semibold">Home Page</a>
        <a href="#" class="hover:text-blue-700 font-semibold">About Us</a>
        <a href="#" class="hover:text-blue-700 font-semibold">Partnership</a>
    </div>
    <div class="flex items-center gap-4">
        <!-- Cart Img -->
        <a href="{{ route('cart.show') }}" class="mr-3">
            <svg class="w-8 h-8 text-blue-600 hover:text-blue-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path d="M1 1h4l2.7 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
        </a>
        @guest
            <a href="{{ route('login') }}" class="text-blue-600 font-bold px-4 py-1 rounded hover:underline">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-600 px-4 py-1 rounded text-white font-bold hover:bg-blue-700">Register</a>
        @else
            <div class="relative group">
                <button class="flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 transition font-semibold focus:outline-none">
                    <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <!-- Dropdown -->
                <div class="absolute right-0 mt-0.4 w-48 bg-white border rounded shadow-lg z-50 hidden group-hover:block group-focus:block">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Log Out</button>
                        </form>
                    @elseif(Auth::user()->role === 'customer')
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My Account</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My Orders</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Log Out</button>
                        </form>
                    @endif
                </div>
            </div>
        @endguest
    </div>
</header>
<div class="h-20"></div>

