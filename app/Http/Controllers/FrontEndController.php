<?php

namespace App\Http\Controllers;

use App\Models\Event; // <-- Wajib panggil model Event
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        // [EAGER LOADING] Ambil semua data acara dan kategorinya, urutkan dari yang terbaru
        $events = Event::with('category')->latest()->get();

        // Serahkan data tersebut ke halaman depan bernama 'welcome'
        return view('welcome', compact('events'));
    }
}