<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Category; // <-- [1] Panggil Kepala Gudang

class CategoryController extends Controller
{
    // [2] Buat ruangan/method bernama index
    public function index()
    {
        // [3] Manajer meminta semua data dari Gudang
        $categories = Category::all();
        // [4] Manajer mengirim paket data ke halaman Dashboard
        return view('dashboard', compact('categories'));
    }

    // === DIUBAH DI SINI ===
    public function create()
    {
        // Ambil semua data kategori agar file induk layouts.app tidak error kelaparan data
        $categories = Category::all();

        // Mengarahkan ke file view form sambil membawa data $categories
        return view('category_create', compact('categories')); 
    }

    public function store(Request $request)
    {
        // 1. Tahap Pemeriksaan (Validasi)
        $request->validate([
            'name' => 'required|min:3|unique:categories,name',
            'slug' => 'required|unique:categories,slug'
        ]);

        // 2. Tahap Eksekusi Simpan (Eloquent)
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        // 3. Tahap Feedback (Redirect)
        return redirect('/dashboard')->with('success', 'Kategori Berhasil Disimpan!');
    }

    // === DIUBAH DI SINI ===
    public function edit(Category $category)
    {
        // Ambil semua daftar kategori untuk kebutuhan komponen layout induk (navbar/sidebar)
        $categories = Category::all();

        // Melempar data kategori yang ditemukan SEKALIGUS seluruh daftar kategori ke halaman tampilan
        return view('category_edit', compact('category', 'categories'));
    }

    // 2. Fungsi Memproses Perubahan Data (UPDATE)
    public function update(Request $request, Category $category)
    {
        // A. Periksa kelengkapan isi form
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);
        
        // B. Eloquent ORM: Ubah datanya di database
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        // C. Tendang kembali ke dashboard dengan membawa pesan sukses
        return redirect('/dashboard')->with('success', 'Data Kategori berhasil diperbarui!');
    }

    // 3. Fungsi Memproses Penghapusan Data (DELETE)
    public function destroy(Category $category)
    {
        // Eloquent ORM: Hancurkan datanya dari database
        $category->delete();
        
        // Tendang kembali ke dashboard dengan membawa pesan sukses
        return redirect('/dashboard')->with('success', 'Data Kategori berhasil dihapus permanen!');
    }
}