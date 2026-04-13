<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi secara massal, kecuali 'id'
    protected $guarded = ['id'];

    // Eager loading: Otomatis memuat data relasi book dan user setiap kali data borrow dipanggil. 
    // Ini sangat bagus untuk mencegah masalah N+1 Query dan mempercepat loading halaman webmu!
    protected $with = ['book', 'user'];

    // Memastikan kolom tanggal otomatis diubah menjadi objek Carbon,
    // sehingga kamu bisa langsung memakai format('d M Y') di file Blade.
    protected $casts = [
        'borrow_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    // Relasi ke tabel books (Setiap peminjaman memiliki 1 buku)
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke tabel users (Setiap peminjaman dilakukan oleh 1 user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}