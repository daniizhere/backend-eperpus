<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class BookResource extends JsonResource
{
public function toArray(Request $request): array
{

return [
'id' => $this->id,
'title' => $this->title,
'author' => $this->author,
'publisher' => $this->publisher,
'published_year' => $this->published_year,
'stock' => $this->stock,
// Menyertakan data relasi kategori secara aman menggunakan Resource terpisah /

'category' => [
'id' => $this->category->id ?? null,
'name' => $this->category->name ?? null,
],
'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
];
}
}
