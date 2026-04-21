<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    /**
     * Get all news with pagination or all records
     */
    public function getAllNews($paginate = true, $perPage = 15)
    {
        $query = News::with('category')->latest('date');

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    /**
     * Get single news by ID
     */
    public function getNewsById($id)
    {
        return News::with('category')->findOrFail($id);
    }

    /**
     * Get news by category
     */
    public function getNewsByCategory($categoryId)
    {
        return News::where('category_id', $categoryId)
            ->with('category')
            ->latest('date')
            ->get();
    }

    /**
     * Create new news
     */
    public function createNews(array $data)
    {
        // Handle image upload
        $imagePath = null;
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('news', 'public');
        }

        $news = News::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'date' => $data['date'],
            'image' => $imagePath
        ]);

        return $news->load('category');
    }

    /**
     * Update existing news
     */
    public function updateNews($id, array $data)
    {
        $news = News::findOrFail($id);

        $updateData = [
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'date' => $data['date'],
        ];

        // Handle image upload
        if (isset($data['image'])) {
            // Delete old image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $updateData['image'] = $data['image']->store('news', 'public');
        }

        $news->update($updateData);

        return $news->load('category');
    }

    /**
     * Delete news
     */
    public function deleteNews($id)
    {
        $news = News::findOrFail($id);

        // Delete image
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return true;
    }

    /**
     * Search news
     */
    public function searchNews($keyword)
    {
        return News::where('title', 'LIKE', "%{$keyword}%")
            ->orWhere('content', 'LIKE', "%{$keyword}%")
            ->with('category')
            ->latest('date')
            ->get();
    }
}
