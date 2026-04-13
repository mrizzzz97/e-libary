@extends('dashboard.layouts.main')

@section('content')
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        @if (session()->has('success'))
            <div class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('category.create') }}" class="px-5 py-3 bg-sky-300 rounded-md text-gray-500 hover:bg-sky-400 transition">
            Tambah category
        </a>
    </div>
</div>

<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Slug</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($categories->count())
                        @foreach ($categories as $category)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $category->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $category->slug }}
                            </td>

                            <td class="px-6 py-4 flex gap-3 justify-center">

                                <!-- Edit -->
                                <a href="/dashboard/category/{{ $category->slug }}/edit" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('category.destroy', $category->slug) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="3" class="px-6 py-4 text-white text-center">
                                Belum ada data category.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            
            {{-- Pagination --}}
            <div class="mt-6">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
</div>
@endsection