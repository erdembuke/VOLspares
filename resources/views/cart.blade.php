<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-8 mt-10">
        <h2 class="text-2xl font-bold mb-8">Sepetim</h2>
        @if(count($items))
            @foreach($items as $item)
                <div class="flex items-center gap-6 border-b py-4">
                    <img src="{{ $item['spare_part']->image ? asset('storage/'.$item['spare_part']->image) : asset('images/placeholder.png') }}"
                         class="w-20 h-20 object-contain rounded">
                    <div>
                        <div class="font-bold">{{ $item['spare_part']->name }}</div>
                        <div class="text-sm text-gray-500">Parça No: {{ $item['spare_part']->part_number }}</div>
                        <div class="text-sm text-gray-500">Model: {{ $item['spare_part']->model }}</div>
                        <div class="text-sm text-gray-500">Yıl: {{ $item['spare_part']->year }}</div>
                        <div class="text-sm text-gray-500">Kategori: {{ $item['spare_part']->category }}</div>
                        <div class="text-sm text-gray-500">Marka: {{ $item['spare_part']->part_brand }}</div>
                        <div class="text-sm text-gray-500">Fiyat: {{ number_format($item['spare_part']->price,2) }} ₺</div>
                        <div class="text-sm text-gray-500">Adet: {{ $item['quantity'] }}</div>
                    </div>
                    <form method="POST" action="{{ route('cart.remove') }}" class="ml-auto">
                        @csrf
                        <input type="hidden" name="spare_part_id" value="{{ $item['spare_part']->id }}">
                        <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Sil</button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="text-gray-400 text-center py-10">Sepetiniz boş.</div>
        @endif
    </div>
</x-app-layout>
