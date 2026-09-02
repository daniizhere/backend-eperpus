<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Member;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
public function run(): void

{
    
// 1. Buat data kategori master secara manual
$cat1 = Category::create(['name' => 'Pemrograman & IT', 'slug' => 'pemrograman-it']);
$cat2 = Category::create(['name' => 'Novel & Fiksi', 'slug' => 'novel-fiksi']);
$cat3 = Category::create(['name' => 'Sains & Matematika', 'slug' => 'sains-matematika']);
// 2. Generate 15 Anggota dummy menggunakan Factory
Member::factory(15)->create();
// 3. Generate 30 Buku dummy menggunakan Factory
Book::factory(30)->create();
// 4. Simulasi Transaksi Peminjaman Sederhana
$member = Member::first();
$book = Book::first();
$borrowing = Borrowing::create([
'member_id' => $member->id,
'borrow_code' => 'TRX-' . rand(10000, 99999),
'borrow_date' => now(),
'due_date' => now()->addDays(7),
'status' => 'borrowed'
]);
// Hubungkan ke tabel pivot
$borrowing->books()->attach($book->id, ['quantity' => 1]);
}
}