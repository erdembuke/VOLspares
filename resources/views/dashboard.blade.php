<x-app-layout>

    <div class="max-w-6xl mx-auto p-8">
        <!-- Hoşgeldin ve Bilgi -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Welcome, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-500">Welcome to the VOLspares Admin Panel.</p>
        </div>

        <!-- İstatistik Kartları -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Yedek Parça -->
            <div class="bg-blue-50 rounded-xl shadow p-6 flex flex-col items-center justify-center">
                <svg class="w-10 h-10 text-blue-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M7 17l9-5-9-5v10z" />
                </svg>
                <div class="text-2xl font-bold text-blue-700">
                    {{ \App\Models\SparePart::count() }}
                </div>
                <div class="text-gray-700">Total Spare Parts</div>
            </div>
            <!-- Kullanıcı -->
            <div class="bg-green-50 rounded-xl shadow p-6 flex flex-col items-center justify-center">
                <svg class="w-10 h-10 text-green-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4A4 4 0 1112 6a4 4 0 010 8z" />
                </svg>
                <div class="text-2xl font-bold text-green-700">
                    {{ \App\Models\User::count() }}
                </div>
                <div class="text-gray-700">Total User</div>
            </div>
            <!-- Sipariş -->
            <div class="bg-red-50 rounded-xl shadow p-6 flex flex-col items-center justify-center">
                <svg class="w-10 h-10 text-red-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 7l1.664 8.32A2 2 0 006.638 17h10.724a2 2 0 001.974-1.68L21 7" />
                    <path d="M16 11V5a4 4 0 00-8 0v6" />
                </svg>
                <div class="text-2xl font-bold text-red-700">
                    {{ \App\Models\Order::count() }}
                </div>
                <div class="text-gray-700">Total Order Count</div>
            </div>
        </div>

        <!-- Hızlı Kısayollar -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('spare-parts.index') }}" class="block bg-white hover:bg-blue-50 border rounded-xl shadow p-6 text-center transition">
                <div class="text-xl font-semibold text-blue-600 mb-2">Manage Spare Parts</div>
                <div class="text-gray-500">Add, Edit, Delete Spare Parts</div>
            </a>
            <a href="#" class="block bg-white hover:bg-green-50 border rounded-xl shadow p-6 text-center transition opacity-50 cursor-not-allowed">
                <div class="text-xl font-semibold text-green-600 mb-2">Manage Orders</div>
                <div class="text-gray-500">Coming Soon</div>
            </a>
        </div>
    </div>
</x-app-layout>
