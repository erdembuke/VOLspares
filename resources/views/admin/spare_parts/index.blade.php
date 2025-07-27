<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4">
        <h1 class="text-4xl font-bold mb-10 text-center">Spare Part List</h1>

        <!-- Search + Add Button (satırda, sağ/sol) -->
        <div class="mb-6 flex justify-between items-center gap-4">
            <!-- Sol: Search -->
            <form method="GET" action="{{ route('spare-parts.index') }}" class="flex gap-2">
                <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by part name..."
                        class="border rounded p-3 w-96"
                />
                <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded font-semibold">Search</button>
            </form>
            <!-- Sağ: Add New -->
            <a href="{{ route('spare-parts.create') }}"
               class="px-5 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold shadow text-lg whitespace-nowrap">
                + Add a New Spare Part
            </a>
        </div>

        <div class="bg-white shadow rounded-2xl overflow-x-auto">
            <table class="min-w-full text-lg">
                <thead>
                <tr class="bg-gray-100 text-gray-700 text-center">
                    <th class="py-4 px-6">ID</th>
                    <th class="py-4 px-6">Picture</th>
                    <th class="py-4 px-6">Name</th>
                    <th class="py-4 px-6">Model</th>
                    <th class="py-4 px-6">Year</th>
                    <th class="py-4 px-6">Stock</th>
                    <th class="py-4 px-6">Price (₺)</th>
                    <th class="py-4 px-6">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($spareParts as $part)
                    <tr class="border-b text-center align-middle hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $part->id }}</td>
                        <td class="py-4 px-6">
                            @if($part->image)
                                <img src="{{ asset('storage/' . $part->image) }}" alt="Part Image"
                                     class="h-40 w-64 object-contain rounded shadow mx-auto transition-all duration-150" />
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">{{ $part->name }}</td>
                        <td class="py-4 px-6">{{ $part->model }}</td>
                        <td class="py-4 px-6">{{ $part->year }}</td>
                        <td class="py-4 px-6">{{ $part->stock }}</td>
                        <td class="py-4 px-6">{{ number_format($part->price, 2) }}</td>
                        <td class="py-4 px-6">
                            <div class="flex justify-center items-center gap-4">
                                <a href="{{ route('spare-parts.edit', $part->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('spare-parts.destroy', $part->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure that you want to delete this item? This action is irreversable');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-8 px-6 text-center text-gray-500 text-xl">Spare parts could not be found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
