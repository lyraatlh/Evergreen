<x-default-layout title="Plant" section_title="List of Plants">
    @if (session('success'))
        <div class="bg-green-50 border border-green-500 text-green-500 px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
    @can('store-student')
    <div class="flex mb-6">
        <a href="{{ route('admin.plants.create') }}" class="bg-blue-50 text-blue-500 border border-blue-500 px-4 py-2 flex items-center gap-2 rounded-lg shadow-md hover:bg-blue-100 duration-200">
            <i class="ph ph-plus block text-blue-500"></i>
            Add Plant
        </a>
    </div>
    @endcan
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-50 text-blue-600">
                <tr class="text-sm leading-normal">
                    <th class="py-4 px-6 text-left">#</th>
                    <th class="py-4 px-6 text-left">Plant Name</th>
                    <th class="py-4 px-6 text-center">Type</th>
                    <th class="py-4 px-6 text-center">Price</th>
                    <th class="py-4 px-6 text-center">Stock</th>
                    <th class="py-4 px-6 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-zinc-700 text-sm font-light">
                @forelse ($plants as $plant)
                    <tr class="border-b border-zinc-200 hover:bg-blue-50 transition-colors">
                        <td class="py-4 px-6 text-left">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6 text-left">{{ $plant->Plant_Name }}</td>
                        <td class="py-4 px-6 text-center">{{ $plant->type->Type_Name ?? '-' }}</td>
                        <td class="py-4 px-6 text-center">Rp {{ number_format($plant->Price) }}</td>
                        <td class="py-4 px-6 text-center">{{ $plant->Stock }}</td>
                        <td class="py-4 px-6 flex justify-center gap-3">
                            <a href="{{ route('admin.plants.show', $plant->Plant_ID) }}" class="bg-blue-50 border border-blue-500 p-2 rounded-lg shadow-md hover:bg-blue-100">
                                <i class="ph ph-eye block text-blue-500"></i>
                            </a>
                            @can('edit-student')
                            <a href="{{ route('admin.plants.edit', $plant->Plant_ID) }}" class="bg-yellow-50 border border-yellow-500 p-2 rounded-lg shadow-md hover:bg-yellow-100">
                                <i class="ph ph-note-pencil block text-yellow-500"></i>
                            </a>
                            @endcan
                            @can('destroy-student')
                            <form onsubmit="return confirm('Are you sure?')" method="POST" action="{{ route('admin.plants.destroy', $plant->Plant_ID) }}">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="bg-red-50 border border-red-500 p-2 rounded-lg shadow-md hover:bg-red-100">
                                    <i class="ph ph-trash-simple block text-red-500"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-zinc-500">No plants found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-default-layout>