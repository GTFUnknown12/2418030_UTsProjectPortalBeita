<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'title', 
        'slug', 
        'content', 
        'category_id', 
        'date', 
        'image'
    ];

    /**
     * The attributes that should be cast
     */
    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship to Category
     * Get the category that owns the news
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope: Filter by category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope: Get latest news
     */
    public function scopeLatest($query, $column = 'date')
    {
        return $query->orderBy($column, 'desc');
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }
}