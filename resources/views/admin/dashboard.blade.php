<x-app-layout>
    <div class="max-w-3xl mx-auto p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Admin Paneline Hoşgeldiniz!</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('spare-parts.index') }}" class="bg-white rounded-xl shadow hover:shadow-lg transition p-8 flex flex-col items-center justify-center text-center border border-gray-200 hover:border-blue-500">
                <span class="text-xl font-semibold text-blue-700 mb-2">Yedek Parçalar</span>
                <span class="text-gray-400">Tüm yedek parçaları yönetin</span>
            </a>
            <a href="#" class="bg-white rounded-xl shadow hover:shadow-lg transition p-8 flex flex-col items-center justify-center text-center border border-gray-200 hover:border-blue-500">
                <span class="text-xl font-semibold text-blue-700 mb-2">Araçlar</span>
                <span class="text-gray-400">Kayıtlı araçları yönetin</span>
            </a>
            <a href="#" class="bg-white rounded-xl shadow hover:shadow-lg transition p-8 flex flex-col items-center justify-center text-center border border-gray-200 hover:border-blue-500">
                <span class="text-xl font-semibold text-blue-700 mb-2">Siparişler</span>
                <span class="text-gray-400">Gelen siparişleri takip edin</span>
            </a>
            <a href="#" class="bg-white rounded-xl shadow hover:shadow-lg transition p-8 flex flex-col items-center justify-center text-center border border-gray-200 hover:border-blue-500">
                <span class="text-xl font-semibold text-blue-700 mb-2">Müşteriler</span>
                <span class="text-gray-400">Kullanıcıları yönetin</span>
            </a>
            <a href="#" class="bg-white rounded-xl shadow hover:shadow-lg transition p-8 flex flex-col items-center justify-center text-center border border-gray-200 hover:border-blue-500">
                <span class="text-xl font-semibold text-blue-700 mb-2">Servis Geçmişi</span>
                <span class="text-gray-400">Araçların bakım geçmişi</span>
            </a>
        </div>
    </div>
</x-app-layout>
