@extends('layouts.main')

@section('konten')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
            {{ $title ?? 'Tentang E-Library' }}
        </h1>
        <p class="max-w-2xl mt-4 mx-auto text-xl text-gray-500">
            Membuka jendela dunia melalui akses literasi digital tanpa batas, kapan saja dan di mana saja.
        </p>
    </div>

    <div class="mt-16 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="px-6 py-10 sm:p-14">
            
            <div class="mb-12 text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Mengenal Perpustakaan Digital Kami</h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    E-Library ini dibangun untuk menjawab tantangan era digital dengan membawa koleksi buku, jurnal, dan literatur langsung ke genggaman Anda. Kami percaya bahwa setiap orang berhak mendapatkan kemudahan akses ilmu pengetahuan tanpa terhalang jarak dan waktu operasional perpustakaan fisik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                
                <div class="bg-blue-50 p-8 rounded-xl border border-blue-100 transition duration-300 hover:shadow-md hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-blue-500 rounded-lg text-white mr-4">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Visi</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Menjadi platform literasi digital terdepan yang menumbuhkan minat baca dan memajukan pendidikan dengan menyediakan sumber informasi yang komprehensif dan mudah diakses.
                    </p>
                </div>

                <div class="bg-amber-50 p-8 rounded-xl border border-amber-100 transition duration-300 hover:shadow-md hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-amber-500 rounded-lg text-white mr-4">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Misi</h3>
                    </div>
                    <ul class="text-gray-600 leading-relaxed list-disc list-outside ml-4 space-y-2">
                        <li>Menyediakan koleksi *e-book* yang terus diperbarui dan relevan.</li>
                        <li>Menghadirkan pengalaman meminjam dan membaca buku digital yang praktis dan nyaman.</li>
                        <li>Membangun ekosistem membaca yang positif bagi pelajar, mahasiswa, dan masyarakat umum.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection