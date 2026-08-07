<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{

    public function authorize(): bool
    {
    return true;
    }
    public function rules(): array
    {
    return [
    'category_id' => 'required|exists:categories,id',
    'title' => 'required|string|max:255',
    'author' => 'required|string|max:255',
    'publisher' => 'required|string|max:255',
    'published_year' => 'required|digits:4|integer',
    'stock' => 'required|integer|min:0',
    ];
    }
    public function messages(): array
    {
    return [
    'category_id.required' => 'Kategori buku wajib dipilih.',
    'category_id.exists' => 'Kategori yang dipilih tidak valid di dalam database.',
    'title.required' => 'Judul buku wajib diisi.',
    'stock.min' => 'Stok buku tidak boleh bernilai negatif.',
    ];
    }
    }