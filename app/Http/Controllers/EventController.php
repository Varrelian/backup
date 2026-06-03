<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- WAJIB DIIMPORT untuk fitur hapus file gambar

class EventController extends Controller
{
    // FUNGSI UTAMA: Menampilkan Manajemen Acara
   public function index()
{
    $events = Event::with('category')->latest()->get();
    
    // UBAH DI SINI: ganti 'events' menjadi 'event_index'
    return view('event_index', compact('events')); 
}

    // FUNGSI menampilkan halaman form tambah
    public function create()
    {
        // Ambil semua daftar kategori untuk isi Dropdown <select>
        $categories = Category::all();
        return view('event_create', compact('categories'));
    }

    // FUNGSI 1: CREATE (Penyimpanan Media Baru)
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Memastikan ID kategori valid di DB
            'title'       => 'required|min:5',
            'event_date'  => 'required|date',
            'location'    => 'required',
            'quota'       => 'required|numeric|min:1',
            'description' => 'required',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Validasi keamanan file poster
        ]);

        $data = $request->all();

        // Menyimpan aset fisik gambar poster ke hardisk (Storage)
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Event::create($data);

        return redirect('/events')->with('success', 'Acara dan Poster berhasil dipublikasi!');
    }

    // FUNGSI 2: EDIT (Menampilkan halaman form edit)
    public function edit(Event $event)
    {
        $categories = Category::all(); // Membawa data relasi untuk dropdown pilihan
        return view('event_edit', compact('event', 'categories'));
    }

    // FUNGSI 3: UPDATE (Algoritma Garbage Collection Gambar)
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|min:5',
            'event_date'  => 'required|date',
            'location'    => 'required',
            'quota'       => 'required|numeric|min:1',
            'description' => 'required',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('poster')) {
            // [GARBAGE COLLECTION] Hancurkan fisik poster lama jika ada agar tidak memenuhi server!
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            // Setelah file lama hancur, simpan poster barunya
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect('/events')->with('success', 'Data Acara sukses diperbarui!');
    }

    // FUNGSI 4: DELETE (Pemusnahan Data Total)
    public function destroy(Event $event)
    {
        // [GARBAGE COLLECTION] Hancurkan fisik poster terlebih dahulu sebelum datanya dihapus
        if ($event->poster) {
            Storage::disk('public')->delete($event->poster);
        }

        // Setelah fisiknya musnah dari server, hapus catatan datanya dari Database
        $event->delete();

        return redirect('/events')->with('success', 'Acara dan fisik posternya telah dimusnahkan!');
    }
}