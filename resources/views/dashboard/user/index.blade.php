@extends('dashboard.layouts.main')

@section('content')
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        @if (session()->has('success'))
            <div class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('user.create') }}" class="px-5 py-3 bg-sky-300 rounded-md text-gray-500 hover:bg-sky-400 transition">
            Tambah user
        </a>
    </div>
</div>

<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Slug</th>
                        <th class="px-6 py-3">Username</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $user->slug }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $user->username }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $user->role }}
                        </td>

                        <td class="px-6 py-4 flex gap-3 justify-center">

                            <!-- Edit -->
                            <a href="/dashboard/user/{{ $user->slug }}/edit" class="text-yellow-500 hover:text-yellow-600">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('user.destroy', $user->slug) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:text-rose-600">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">
                            Data user belum ada.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
