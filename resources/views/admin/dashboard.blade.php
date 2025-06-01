<x-default-layout title="Dashboard" section_title="Dashboard">
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        <!-- Card Total Plants -->
        <div class="bg-blue-50 border-l-4 border-blue-500 shadow-lg rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
            <div class="px-6 py-4">
                <div class="text-zinc-600 text-sm">Total Plants</div>
                <div class="text-3xl font-bold text-blue-600">{{ $totalPlants }}</div>
            </div>
        </div>

        <!-- Card Total Catalogs -->
        <div class="bg-blue-50 border-l-4 border-blue-500 shadow-lg rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
            <div class="px-6 py-4">
                <div class="text-zinc-600 text-sm">Total Catalogs</div>
                <div class="text-3xl font-bold text-blue-600">{{ $totalCatalogs }}</div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Catalogs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <div class="col-span-3 sm:col-span-2 overflow-x-auto rounded-lg bg-white shadow-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-50 border-b border-blue-200 text-sm leading-normal">
                        <th class="py-3 px-6 text-left text-blue-600">#</th>
                        <th class="py-3 px-6 text-left text-blue-600">Catalogs</th>
                        <th class="py-3 px-6 text-center text-blue-600">Total Plants</th>
                    </tr>
                </thead>
                <tbody class="text-zinc-700 text-sm font-light">
                    @forelse ($catalogs as $index => $catalog)
                        <tr class="border-b border-zinc-200 hover:bg-blue-100 transition-all duration-200">
                            <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-left">{{ $catalog->Type_Name }}</td>
                            <td class="py-3 px-6 text-center">{{ $catalog->plants_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-3 px-6 text-center text-zinc-400">No catalogs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-default-layout>