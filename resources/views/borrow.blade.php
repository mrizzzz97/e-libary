@extends('layouts.main')

@section('konten')

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-5xl">
            
            <!-- Header -->
            <div class="p-6 bg-sky-950 text-white text-center rounded-t-lg">
                <h1 class="text-3xl font-bold">Daftar Peminjaman</h1>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 m-3 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
 
            <!-- Content -->
            <div class="overflow-x-auto p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <!-- Table Head -->
                    <thead class="bg-sky-900 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nama Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Judul Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tanggal Peminjaman</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Batas Peminjaman</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Action</th>
                        </tr>
                    </thead>
 
                    <!-- Table Body -->
                    <tbody class="bg-white divide-y divide-gray-200">

                        @if ($borrows->count())
                            
                        @foreach ($borrows as $borrow)
                        
                        <tr>
                            <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm">{{ $borrow->user->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $borrow->book->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $borrow->borrow_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm">{{ $borrow->due_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 capitalize text-sm font-medium">
                                @if ($borrow->status == 'diajukan')
                                    <p class="bg-yellow-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                @elseif ($borrow->status == 'dipinjam')
                                    <p class="bg-green-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                @elseif ($borrow->status == 'dikembalikan')
                                    <p class="bg-blue-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                @elseif ($borrow->status == 'ditolak')
                                    <p class="bg-red-300 text-center p-1 rounded-md">{{ $borrow->status }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="/borrow/detail/{{ $borrow->id }}" class="bg-blue-200 px-2 py-1 rounded-lg text-blue-500 hover:bg-blue-500 hover:text-white">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @else

                            <tr class="bg-white border-b border-gray-200">
                                <td colspan="9" class="text-center p-4 font-medium text-gray-500">
                                    Tidak ada data Peminjaman
                                </td>
                            </tr>
                            
                        @endif

 
 
                    </tbody>
                </table>
                <div class="mt-8">
                    {{ $borrows->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection