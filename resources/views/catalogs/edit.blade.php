<x-default-layout title="Catalogs" section_title="Edit Catalog">
    <form action="{{ route('catalogs.update', $catalog->Type_ID) }}" method="POST">
        @csrf
        @method('PUT')
        @include('catalogs.show', ['catalog' => $catalog])
    </form>
</x-default-layout>