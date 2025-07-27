<x-app-layout>
    <div class="w-full max-w-7xl mx-auto bg-white rounded-xl shadow p-8 mt-10">
        <h2 class="text-2xl font-bold mb-8 text-center">My Cart</h2>
        @if(count($items))
            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-y-3">
                    <thead>
                    <tr>
                        <th class="text-left text-gray-600 font-semibold min-w-[100px]">Product Image</th>
                        <th class="text-left text-gray-600 font-semibold min-w-[220px]">Product Name</th>
                        <th class="text-center text-gray-600 font-semibold min-w-[130px]">Product Quantity</th>
                        <th class="text-right text-gray-600 font-semibold">Product Price</th>
                        <th class="text-center text-gray-600 font-semibold min-w-[100px]">Action</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total = 0; @endphp
                    @foreach($items as $item)
                        @php $total += $item['spare_part']->price * $item['quantity']; @endphp
                        <tr class="bg-gray-50 hover:bg-gray-100 rounded-xl">
                            <td class="p-2 align-middle">
                                <img src="{{ $item['spare_part']->image ? asset('storage/'.$item['spare_part']->image) : asset('images/placeholder.png') }}"
                                     class="w-24 h-24 object-contain rounded border" alt="Product Image">
                            </td>
                            <td class="p-2 align-middle">
                                <div class="font-bold text-lg text-gray-800">{{ $item['spare_part']->name }}</div>
                                <div class="text-sm text-gray-500 mb-1">{{ $item['spare_part']->model }} {{ $item['spare_part']->year }}</div>
                                <div class="text-xs text-gray-400">{{ $item['spare_part']->part_brand }} / {{ $item['spare_part']->category }}</div>
                            </td>
                            <td class="text-center p-2 align-middle text-lg font-semibold">
                                <form method="POST" action="{{ route('cart.update') }}" class="flex items-center justify-center gap-2">
                                    @csrf
                                    <input type="hidden" name="spare_part_id" value="{{ $item['spare_part']->id }}">
                                    @if($item['quantity'] > 1)
                                        <button type="submit" name="action" value="decrease"
                                                class="w-8 h-8 bg-gray-200 hover:bg-gray-300 text-xl rounded font-bold">-</button>
                                    @else
                                        <span class="w-8"></span>
                                    @endif
                                    <span class="w-8 text-center block">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="action" value="increase"
                                            class="w-8 h-8 bg-gray-200 hover:bg-gray-300 text-xl rounded font-bold">+</button>
                                </form>
                            </td>
                            <td class="text-right p-2 align-middle font-bold text-blue-700 text-lg">
                                {{ number_format($item['spare_part']->price * $item['quantity'], 2) }} ₺
                            </td>
                            <td class="p-2 align-middle text-center">
                                <form method="POST" action="{{ route('cart.remove') }}" class="inline-flex justify-center">
                                    @csrf
                                    <input type="hidden" name="spare_part_id" value="{{ $item['spare_part']->id }}">
                                    <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xl font-bold text-gray-800">
                    Total: <span class="text-blue-700">{{ number_format($total, 2) }} ₺</span>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold text-lg shadow hover:bg-green-700 transition">
                        Checkout
                    </button>
                </form>
            </div>
        @else
            <div class="text-gray-400 text-center py-10">Your cart is empty.</div>
        @endif
    </div>
</x-app-layout>
