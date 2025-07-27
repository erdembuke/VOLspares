<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VOLspares - Home</title>
    @vite('resources/css/app.css')
    <style>
        .modal-bg {
            background: rgba(0,0,0,0.3);
        }
        .modal-content {
            max-width: 540px;
            width: 94vw;
        }
        @media (min-width: 768px) {
            .modal-content {
                max-width: 700px;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

<!-- HEADER -->
@include('defaultheader')
<!-- MAIN -->
<div class="flex max-w-7xl mx-auto mt-8 gap-8">
    <!-- LEFT FILTER MENU -->
    <aside class="w-1/4 bg-white rounded-xl shadow p-6
           max-h-[650px] sticky top-8 overflow-auto"
           style="min-width:270px;">
        <form method="GET" action="{{ route('homepage') }}">
            <h3 class="text-lg font-bold mb-4">Find a Part</h3>
            <div class="mb-3">
                <label class="font-semibold mb-1 block">Brand</label>
                <select name="brand" class="w-full rounded border-gray-300">
                    <option value="volvo" selected>Volvo</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="font-semibold mb-1 block">Model</label>
                <select name="model" class="w-full rounded border-gray-300">
                    <option value="">All</option>
                    @foreach([
                        '850', '940', '960', 'S40', 'S60', 'S70', 'S80', 'S90',
                        'V40', 'V50', 'V60', 'V70', 'V90',
                        'XC40', 'XC60', 'XC70', 'XC90',
                        'C30', 'C70', 'S100', '240', '260', '440', '460', '480', '740', '760', '780'
                    ] as $model)
                        <option value="{{ $model }}" {{ request('model') == $model ? 'selected' : '' }}>{{ $model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="font-semibold mb-1 block">Year</label>
                <select name="year" class="w-full rounded border-gray-300">
                    <option value="">All</option>
                    @for($y = 1990; $y <= 2025; $y++)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label class="font-semibold mb-1 block">Category</label>
                <select name="category" class="w-full rounded border-gray-300">
                    <option value="">All</option>
                    @foreach(['Engine', 'Transmission', 'Suspension', 'Ignition System', 'Coolant System', 'Brake System', 'Lights', 'Interior/Exterior', 'Maintenance'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="font-semibold mb-1 block">Part Brand</label>
                <select name="part_brand" class="w-full rounded border-gray-300">
                    <option value="">All</option>
                    @foreach(['VOLVO (Genuine)', 'Bosch', 'Valeo', 'NGK', 'LONGSERNG', 'Monroe'] as $brand)
                        <option value="{{ $brand }}" {{ request('part_brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 flex gap-2">
                <input type="number" name="min_price" placeholder="Min ₺" class="w-1/2 rounded border-gray-300" min="0" value="{{ request('min_price') }}">
                <input type="number" name="max_price" placeholder="Max ₺" class="w-1/2 rounded border-gray-300" min="0" value="{{ request('max_price') }}">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700">Search</button>
        </form>
    </aside>

    <!-- PRODUCT LIST AREA -->
    <main class="flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($spareParts as $part)
            <div class="bg-white rounded-xl shadow p-4 flex flex-col min-h-[470px] max-h-[470px] h-[470px]">
                <img src="{{ $part->image ? asset('storage/'.$part->image) : asset('images/placeholder.png') }}"
                     class="h-36 mb-2 object-cover mx-auto" alt="">
                <h4 class="font-bold text-lg mb-1 text-center">{{ $part->name }}</h4>
                <div class="mb-1 text-gray-500 text-center">Model: {{ $part->model ?? '-' }}</div>
                <div class="mb-1 text-gray-500 text-center">Year: {{ $part->year ?? '-' }}</div>
                <div class="mb-1 text-gray-500 text-center">Brand: {{ $part->part_brand ?? '-' }}</div>
                <div class="mb-1 text-gray-500 text-center">Category: {{ $part->category ?? '-' }}</div>
                <div class="font-bold text-blue-700 mb-2 text-center">{{ number_format($part->price,2) }} ₺</div>
                <!-- Butonlar -->
                <div class="mt-auto w-full flex flex-col gap-2">
                    <a href="#"
                       class="w-full text-center py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold view-details-btn mb-1"
                       data-name="{{ $part->name }}"
                       data-image="{{ $part->image ? asset('storage/'.$part->image) : asset('images/placeholder.png') }}"
                       data-model="{{ $part->model ?? '-' }}"
                       data-year="{{ $part->year ?? '-' }}"
                       data-brand="{{ $part->part_brand ?? '-' }}"
                       data-category="{{ $part->category ?? '-' }}"
                       data-price="{{ number_format($part->price,2) }} ₺"
                       data-description="{{ $part->description ?? '-' }}">
                        View Details
                    </a>
                    <div class="flex w-full gap-2">
                        <button type="button"
                                class="flex-1 py-2 rounded bg-yellow-500 text-white font-semibold hover:bg-yellow-600 add-to-cart-btn"
                                data-id="{{ $part->id }}">
                            Add to Cart
                        </button>
                        <button type="button"
                                class="flex-1 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700"
                                onclick="alert('Button is not working yet! Please Continue with Add to Cart Function')">
                            Buy Now
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-400 py-16">No parts found.</div>
        @endforelse
    </main>
</div> <!-- !!! ANA FLEX DIV'İNİ KAPATTIM !!! -->

<!-- MODAL POPUP -->
<div id="modal-bg" class="fixed inset-0 z-50 flex items-center justify-center modal-bg hidden">
    <div class="bg-white rounded-xl shadow-lg modal-content relative p-8">
        <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-3xl font-bold focus:outline-none">
            &times;
        </button>
        <div class="flex flex-col md:flex-row gap-6">
            <img id="modal-image" src="" class="w-60 h-60 object-contain rounded mx-auto mb-4 md:mb-0" alt="">
            <div class="flex-1 flex flex-col">
                <h2 id="modal-name" class="text-2xl font-bold mb-2"></h2>
                <div class="mb-1 text-gray-600" id="modal-model"></div>
                <div class="mb-1 text-gray-600" id="modal-year"></div>
                <div class="mb-1 text-gray-600" id="modal-brand"></div>
                <div class="mb-1 text-gray-600" id="modal-category"></div>
                <div class="font-bold text-blue-700 text-xl mb-2" id="modal-price"></div>
                <div class="mb-4 text-gray-800" id="modal-description"></div>
                <a href="#" class="w-full text-center py-2 bg-green-600 text-white rounded hover:bg-green-700 font-semibold mt-auto">Purchase Now</a>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
    // Cart
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({spare_part_id: btn.dataset.id})
            })
                .then(res => res.json())
                .then(res => {
                    if(res.success) {
                        showSuccess("Product has been added to the cart successfully!");
                    }
                });
        });
    });

    function showSuccess(message) {
        let successBox = document.getElementById('success-message');
        if (!successBox) {
            successBox = document.createElement('div');
            successBox.id = 'success-message';
            successBox.className = 'fixed top-8 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-8 py-3 rounded shadow-xl text-lg z-50';
            document.body.appendChild(successBox);
        }
        successBox.innerText = message;
        successBox.style.display = 'block';
        setTimeout(() => { successBox.style.display = 'none'; }, 2000);
    }


    // Show Modal
    document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('modal-name').textContent = btn.dataset.name;
            document.getElementById('modal-image').src = btn.dataset.image;
            document.getElementById('modal-model').textContent = 'Model: ' + btn.dataset.model;
            document.getElementById('modal-year').textContent = 'Year: ' + btn.dataset.year;
            document.getElementById('modal-brand').textContent = 'Brand: ' + btn.dataset.brand;
            document.getElementById('modal-category').textContent = 'Category: ' + btn.dataset.category;
            document.getElementById('modal-price').textContent = btn.dataset.price;
            document.getElementById('modal-description').textContent = btn.dataset.description;
            document.getElementById('modal-bg').classList.remove('hidden');
        });
    });
    // Close Modal (X and background)
    document.getElementById('close-modal').onclick = () =>
        document.getElementById('modal-bg').classList.add('hidden');
    document.getElementById('modal-bg').onclick = function(e) {
        if (e.target === this) this.classList.add('hidden');
    }
</script>
</body>
</html>
