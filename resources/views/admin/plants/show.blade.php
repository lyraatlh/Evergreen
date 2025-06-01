<x-default-layout title="Plant" section_title="Plant detail">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Detail Plant -->
        <div class="flex flex-col gap-6 px-6 py-6 bg-white border-t-4 border-blue-500 shadow-lg rounded-lg">
            <!-- Plant Name -->
            <div class="flex flex-col gap-2">
                <div class="text-lg font-semibold text-blue-600">Plant Name</div>
                <div class="px-4 py-3 border border-blue-300 rounded-md text-zinc-700">{{ $plant->Plant_Name }}</div>
            </div>

            <!-- Type -->
            <div class="flex flex-col gap-2">
                <div class="text-lg font-semibold text-blue-600">Type</div>
                <div class="px-4 py-3 border border-blue-300 rounded-md text-zinc-700">{{ $plant->type->Type_Name ?? '-' }}</div>
            </div>

            <!-- Price -->
            <div class="flex flex-col gap-2">
                <div class="text-lg font-semibold text-blue-600">Price</div>
                <div class="px-4 py-3 border border-blue-300 rounded-md text-zinc-700">Rp {{ number_format($plant->Price) }}</div>
            </div>

            <!-- Stock -->
            <div class="flex flex-col gap-2">
                <div class="text-lg font-semibold text-blue-600">Stock</div>
                <div class="px-4 py-3 border border-blue-300 rounded-md text-zinc-700">{{ $plant->Stock }}</div>
            </div>
        </div>
    </div>
</x-default-layout>