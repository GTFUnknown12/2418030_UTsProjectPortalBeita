<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of news
     * GET /api/news
     */
    public function index()
    {
        try {
            $news = $this->newsService->getAllNews($paginate = false);
            
            return response()->json([
                'success' => true,
                'message' => 'News retrieved successfully',
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve news',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created news in database
     * POST /api/news
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
                'date' => 'required|date'
            ]);

            $data = $request->all();
            $data['image'] = $request->file('image');
            
            $news = $this->newsService->createNews($data);

            return response()->json([
                'success' => true,
                'message' => 'News created successfully',
                'data' => $news
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create news',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified news
     * GET /api/news/{id}
     */
    public function show(News $news)
    {
        try {
            $newsData = $this->newsService->getNewsById($news->id);

            return response()->json([
                'success' => true,
                'message' => 'News retrieved successfully',
                'data' => $newsData
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'News not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve news',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified news in database
     * PUT /api/news/{id}
     */
    public function update(Request $request, News $news)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
                'date' => 'required|date'
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }

            $updatedNews = $this->newsService->updateNews($news->id, $data);

            return response()->json([
                'success' => true,
                'message' => 'News updated successfully',
                'data' => $updatedNews
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'News not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update news',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified news from database
     * DELETE /api/news/{id}
     */
    public function destroy(News $news)
    {
        try {
            $this->newsService->deleteNews($news->id);

            return response()->json([
                'success' => true,
                'message' => 'News deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'News not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete news',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get news by category
     * GET /api/news/category/{categoryId}
     */
    public function getByCategory($categoryId)
    {
        try {
            $news = $this->newsService->getNewsByCategory($categoryId);

            return response()->json([
                'success' => true,
                'message' => 'News retrieved successfully',
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve news',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search news
     * POST /api/news/search
     */
    public function search(Request $request)
    {
        try {
            $request->validate([
                'keyword' => 'required|string|min:2'
            ]);

            $results = $this->newsService->searchNews($request->keyword);

            return response()->json([
                'success' => true,
                'message' => 'Search completed successfully',
                'query' => $request->keyword,
                'count' => count($results),
                'data' => $results
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to search news',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}