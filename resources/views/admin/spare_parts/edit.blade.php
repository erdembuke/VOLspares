<x-app-layout>
    <div class="max-w-xl mx-auto p-8 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Spare Part</h1>
        <form method="POST" action="{{ route('spare-parts.update', $sparePart->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">Part Name</label>
                <input type="text" name="name" value="{{ old('name', $sparePart->name) }}" required
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"/>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Stock Count</label>
                <input type="number" name="stock" value="{{ old('stock', $sparePart->stock) }}" min="0" required
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"/>
                @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Price (₺)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $sparePart->price) }}" min="0" required
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"/>
                @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Model</label>
                <select name="model" class="w-full rounded border-gray-300">
                    <option value="">Select</option>
                    @foreach(['850', '940', '960', 'S40', 'S60', 'S70', 'S80', 'S90', 'V40', 'V50', 'V60', 'V70', 'V90', 'XC40', 'XC60', 'XC70', 'XC90', 'C30', 'C70', 'S100', '240', '260', '440', '460', '480', '740', '760', '780'] as $model)
                        <option value="{{ $model }}" {{ old('model', $sparePart->model) == $model ? 'selected' : '' }}>{{ $model }}</option>
                    @endforeach
                </select>
                @error('model')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Year</label>
                <select name="year" class="w-full rounded border-gray-300">
                    <option value="">Select</option>
                    @for($y = 1990; $y <= 2025; $y++)
                        <option value="{{ $y }}" {{ old('year', $sparePart->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                @error('year')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Category</label>
                <select name="category" class="w-full rounded border-gray-300">
                    <option value="">Select</option>
                    @foreach(['Engine', 'Transmission', 'Suspension', 'Ignition System', 'Coolant System', 'Brake System', 'Lights', 'Interior/Exterior', 'Maintenance'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $sparePart->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Part Brand</label>
                <select name="part_brand" class="w-full rounded border-gray-300">
                    <option value="">Select</option>
                    @foreach(['VOLVO (Genuine)', 'Bosch', 'Valeo', 'NGK', 'LONGSERNG', 'Monroe'] as $brand)
                        <option value="{{ $brand }}" {{ old('part_brand', $sparePart->part_brand) == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
                @error('part_brand')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded border-gray-300">{{ old('description', $sparePart->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Photo of Part</label>
                @if($sparePart->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $sparePart->image) }}" alt="Photo of Part" class="h-24">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('spare-parts.index') }}"
                   class="inline-block px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</a>
                <button type="submit"
                        class="px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 font-bold">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
