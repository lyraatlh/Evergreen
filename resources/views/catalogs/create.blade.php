<x-default-layout title="Catalogs" section_title="Add Catalog">
    <form action="{{ route('catalogs.store') }}" method="POST">
        @csrf
        @include('catalogs.show')
    </form>
</x-default-layout>