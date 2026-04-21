<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index() {
        $news = News::with('category')->latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function create() {
        $categories = Category::all(); 
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'date' => 'required'
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        News::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'date' => $request->date,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diposting!');
    }

    // --- TAMBAHKAN METHOD EDIT DI BAWAH INI ---
    public function edit($id) {
        $news = News::findOrFail($id);
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    // --- TAMBAHKAN METHOD UPDATE DI BAWAH INI ---
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // nullable karena gambar tidak wajib ganti
            'category_id' => 'required',
            'date' => 'required'
        ]);

        $news = News::findOrFail($id);
        
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'date' => $request->date,
        ];

        // Cek jika user mengupload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage
            if($news->image) Storage::disk('public')->delete($news->image);
            
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id) {
        $news = News::findOrFail($id);
        if($news->image) Storage::disk('public')->delete($news->image);
        $news->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}