<x-default-layout title="Catalogs" section_title="Add Catalog">
    <form action="{{ route('admin.catalogs.store') }}" method="POST">
        @csrf
        @include('admin.catalogs.show')
    </form>
</x-default-layout>