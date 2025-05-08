<x-default-layout title="Catalogs" section_title="List of Catalogs">
    <!-- Button for Adding Catalog -->
    <div class="flex mb-6">
        <a href="{{ route('catalogs.create') }}"
            class="bg-blue-50 text-blue-600 border border-blue-500 px-4 py-2 flex items-center gap-2 rounded-lg shadow-md hover:bg-blue-100 transition duration-200">
            <i class="ph ph-plus block text-blue-500"></i>
            <div class="text-blue-600">Add Catalog</div>
        </a>
    </div>

    <!-- Catalog Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-blue-50">
                <tr class="text-sm text-blue-600 border-b border-blue-200">
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">Catalog Name</th>
                    <th class="py-3 px-6 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-zinc-700 text-sm font-light">
                @foreach ($catalogs as $catalog)
                    <tr class="border-b border-zinc-200 hover:bg-blue-50 transition duration-200">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6">{{ $catalog->Type_Name }}</td>
                        <td class="py-3 px-6 flex justify-center gap-3">
                            <!-- View Button -->
                            <a href="{{ route('catalogs.show', $catalog->Type_ID) }}" 
                                class="bg-blue-100 text-blue-600 border border-blue-500 p-2 rounded-lg hover:bg-blue-200 transition duration-200">
                                <i class="ph ph-eye text-blue-500"></i>
                            </a>
                            <!-- Edit Button -->
                            <a href="{{ route('catalogs.edit', $catalog->Type_ID) }}" 
                                class="bg-yellow-100 text-yellow-600 border border-yellow-500 p-2 rounded-lg hover:bg-yellow-200 transition duration-200">
                                <i class="ph ph-note-pencil text-yellow-500"></i>
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('catalogs.destroy', $catalog->Type_ID) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-100 text-red-600 border border-red-500 p-2 rounded-lg hover:bg-red-200 transition duration-200">
                                    <i class="ph ph-trash-simple text-red-500"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-default-layout>