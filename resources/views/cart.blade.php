<x-app-layout>
    @php
        $total = 0;
        foreach($items as $item) {
            $total += $item['spare_part']->price * $item['quantity'];
        }
    @endphp

    <script>
        window.cartTotal = {{ $total }};
    </script>

    <div class="w-full max-w-7xl mx-auto bg-white rounded-xl shadow p-8 mt-10">
        <h2 class="text-2xl font-bold mb-8 text-center">My Cart</h2>
        @if(count($items))
            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-y-3">
                    <thead>
                    <tr>
                        <th class="text-left text-gray-600 font-semibold min-w-[100px]">Product Image</th>
                        <th class="text-left text-gray-600 font-semibold min-w-[220px]">Product Name</th>
                        <th class="text-center text-gray-600 font-semibold min-w-[130px]">Quantity</th>
                        <th class="text-right text-gray-600 font-semibold">Price</th>
                        <th class="text-center text-gray-600 font-semibold min-w-[100px]">Action</th>
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
                                <form method="POST" action="{{ route('cart.remove') }}" class="inline-flex justify-center w-full">
                                    @csrf
                                    <input type="hidden" name="spare_part_id" value="{{ $item['spare_part']->id }}">
                                    <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 mx-auto">Remove</button>
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
                <button
                    id="checkout-btn"
                    class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold text-lg shadow hover:bg-green-700 transition"
                >
                    Checkout
                </button>
            </div>
        @else
            <div class="text-gray-400 text-center py-10">Your cart is empty.</div>
        @endif

        <!-- Checkout Modal -->
        <div id="checkout-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-30 hidden">
            <div id="modal-content" class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full text-center relative">
                <div id="modal-step1">
                    <h3 class="text-xl font-bold mb-4">Are you sure that you want to Checkout?</h3>
                    <div class="mb-6 text-gray-600">This action is irreversible.</div>
                    <div class="mb-6 font-semibold">
                        Total Price: <span class="text-blue-700">{{ number_format($total, 2) }} ₺</span>
                    </div>
                    <div class="flex justify-center gap-4">
                        <button id="confirm-checkout" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Yes</button>
                        <button id="cancel-checkout" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">No</button>
                    </div>
                </div>
                <div id="modal-step2" class="hidden">
                    <h3 class="text-xl font-bold mb-4">Checkout is completed.</h3>
                    <div class="mb-4 text-gray-600">
                        Payment Completed Automatically via your main credit card on the system.
                    </div>
                    <div class="flex justify-center gap-4 mt-6">
                        <button id="ok-btn" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">OK</button>
                        <button id="continue-shopping" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">Continue Shopping</button>
                    </div>
                </div>
                <button id="close-modal" class="absolute top-3 right-3 text-2xl text-gray-400 hover:text-red-500">&times;</button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('checkout-modal');
        const step1 = document.getElementById('modal-step1');
        const step2 = document.getElementById('modal-step2');
        const checkoutBtn = document.getElementById('checkout-btn');
        const closeBtn = document.getElementById('close-modal');
        const cancelBtn = document.getElementById('cancel-checkout');
        const confirmBtn = document.getElementById('confirm-checkout');
        const okBtn = document.getElementById('ok-btn');
        const continueBtn = document.getElementById('continue-shopping');

        if(checkoutBtn){
            checkoutBtn.onclick = () => {
                modal.classList.remove('hidden');
                step1.classList.remove('hidden');
                step2.classList.add('hidden');
            }
        }

        closeBtn.onclick = cancelBtn.onclick = function() {
            modal.classList.add('hidden');
        };

        confirmBtn.onclick = function() {
            // Checkout isteğini gönder ve popup'ı ikinci mesaja çevir.
            fetch("{{ route('cart.checkout') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
                .then(res => res.json())
                .then(res => {
                    if(res.success){
                        step1.classList.add('hidden');
                        step2.classList.remove('hidden');
                    }
                });
        };

        okBtn.onclick = function() {
            window.location.reload();
        };

        continueBtn.onclick = function() {
            window.location.href = "{{ route('homepage') }}";
        };

        // Modal dışına tıklayınca kapansın
        modal.onclick = function(e) {
            if (e.target === modal) modal.classList.add('hidden');
        }
    </script>

</x-app-layout>
