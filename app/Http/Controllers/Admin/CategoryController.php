<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller {
    
    public function index() {
        $categories = Category::all();
        $news = News::with('category')->latest()->get(); 
        return view('admin.category.index', compact('categories', 'news'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->back()->with('success', 'Kategori Berhasil Ditambah!');
    }

    // --- TAMBAHAN FITUR EDIT ---
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    // --- TAMBAHAN FITUR UPDATE ---
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori Berhasil Diperbarui!');
    }

    // --- TAMBAHAN FITUR HAPUS ---
    public function destroy($id) {
        $category = Category::findOrFail($id);
        
        // Opsional: Cek apakah kategori sedang digunakan di berita
        $checkNews = News::where('category_id', $id)->exists();
        if ($checkNews) {
            return redirect()->back()->with('error', 'Gagal hapus! Kategori ini masih digunakan oleh beberapa berita.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Kategori Berhasil Dihapus!');
    }
}