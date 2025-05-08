<x-default-layout title="Plant" section_title="Edit plant data">
    <div class="grid grid-cols-3 gap-6">
        <form action="{{ route('plants.update', $plant->Plant_ID) }}" method="POST" 
            class="flex flex-col gap-6 px-8 py-6 bg-white rounded-lg border border-blue-200 shadow-lg col-span-3 md:col-span-2">
            @csrf
            @method("PUT")

            <!-- Plant Name Input -->
            <div class="flex flex-col gap-2">
                <label for="Plant_Name" class="text-blue-600 font-semibold">Plant Name</label>
                <input type="text" id="Plant_Name" name="Plant_Name" 
                    class="px-4 py-3 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-blue-50"
                    placeholder="Plant Name" value="{{ old('Plant_Name', $plant->Plant_Name) }}">
                @error('Plant_Name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Plant Type Select -->
            <div class="flex flex-col gap-2">
                <label for="Type_ID" class="text-blue-600 font-semibold">Plant Type</label>
                <select name="Type_ID" id="Type_ID" 
                    class="px-4 py-3 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-blue-50">
                    <option value="" disabled>Select Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->Type_ID }}" 
                            {{ old('Type_ID', $plant->Type_ID) == $type->Type_ID ? 'selected' : '' }}>
                            {{ $type->Type_Name }}
                        </option>
                    @endforeach
                </select>
                @error('Type_ID')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price Input -->
            <div class="flex flex-col gap-2">
                <label for="Price" class="text-blue-600 font-semibold">Price (Rp)</label>
                <input type="number" id="Price" name="Price" 
                    class="px-4 py-3 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-blue-50"
                    placeholder="10000" value="{{ old('Price', $plant->Price) }}">
                @error('Price')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Stock Input -->
            <div class="flex flex-col gap-2">
                <label for="Stock" class="text-blue-600 font-semibold">Stock</label>
                <input type="number" id="Stock" name="Stock" 
                    class="px-4 py-3 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-blue-50"
                    placeholder="10" value="{{ old('Stock', $plant->Stock) }}">
                @error('Stock')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('plants.index') }}" 
                    class="bg-blue-50 border border-blue-500 text-blue-500 px-4 py-2 rounded-lg hover:bg-blue-100 transition duration-200">
                    Cancel
                </a>
                <button type="submit" 
                    class="bg-blue-500 border border-blue-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-600 transition duration-200">
                    <i class="ph ph-floppy-disk"></i>
                    <span>Update</span>
                </button>
            </div>
        </form>
    </div>
</x-default-layout>