<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
class BookController extends Controller
{
// 1. Read: Tampilkan Semua Data Buku
public function index()
{
$books = Book::with('category')->get();
return response()->json([
'status' => true,
'message' => 'Daftar katalog buku berhasil dimuat',
'data' => BookResource::collection($books)
], 200);
}

// 2. Create: Simpan Buku Baru
public function store(StoreBookRequest $request)
{
$book = Book::create($request->validated());
return response()->json([
'status' => true,
'message' => 'Katalog buku berhasil ditambahkan',
'data' => new BookResource($book->load('category'))
], 201); // 201 Created
}
// 3. Read: Tampilkan Detail Buku Berdasarkan ID
public function show($id)
{
$book = Book::with('category')->find($id);
if (!$book) {
return response()->json([
'status' => false,
'message' => 'Data buku tidak ditemukan'
], 404);
}
return response()->json([
'status' => true,
'message' => 'Detail data buku ditemukan',
'data' => new BookResource($book)
], 200);
}
// 4. Update: Perbarui Data Buku
public function update(UpdateBookRequest $request, $id)
{
$book = Book::find($id);
if (!$book) {
return response()->json([
'status' => false,
'message' => 'Data buku tidak ditemukan'
], 404);
}
$book->update($request->validated());

return response()->json([
'status' => true,
'message' => 'Data buku berhasil diperbarui',
'data' => new BookResource($book->load('category'))
], 200);
}
// 5. Delete: Hapus Data Buku
public function destroy($id)
{
$book = Book::find($id);
if (!$book) {
return response()->json([
'status' => false,
'message' => 'Data buku tidak ditemukan'
], 404);
}
$book->delete();
return response()->json([
'status' => true,
'message' => 'Data buku berhasil dihapus'
], 200);
}
}