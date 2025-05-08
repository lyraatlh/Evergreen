<x-default-layout title="Catalog" section_title="Catalog Detail">
    <div class="flex flex-col gap-6 px-6 py-6 bg-white border border-blue-200 shadow-lg rounded-lg col-span-3 md:col-span-2">
        
        <!-- Catalog Name -->
        <div class="flex flex-col gap-4">
            <label for="Type_Name" class="text-lg font-semibold text-blue-600">Catalog Name</label>
            <input type="text" id="Type_Name" name="Type_Name"
                class="px-4 py-3 border border-blue-300 bg-blue-50 rounded-lg focus:ring-2 focus:ring-blue-300 transition duration-200"
                value="{{ old('Type_Name', $catalog->Type_Name ?? '') }}"
                placeholder="Example: Succulent Plants">
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 self-end mt-6">
            <a href="{{ route('catalogs.index') }}"
                class="bg-white text-blue-600 border border-blue-500 px-5 py-2 rounded-lg shadow-md hover:bg-blue-50 transition duration-200">
                Cancel
            </a>
            <button type="submit"
                class="bg-blue-500 text-white border border-blue-500 px-5 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-200 flex items-center gap-2">
                <i class="ph ph-floppy-disk"></i>
                Save
            </button>
        </div>
    </div>
</x-default-layout>