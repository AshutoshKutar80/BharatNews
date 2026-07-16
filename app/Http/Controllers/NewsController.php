<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function home()
    {
        $news = News::where('status', 'published')
            ->with(['category', 'author'])
            ->latest()
            ->take(6)
            ->get();

        return view('pages.home', compact('news'));
    }

    public function news(Request $request)
    {
        $query = News::where('status', 'published')
            ->with(['category', 'author']);

        // Filter by type
        if ($request->has('type') && $request->type !== 'all') {
            switch ($request->type) {
                case 'breaking':
                    $query->where('is_breaking', true);
                    break;
                case 'trending':
                    $query->where('is_trending', true);
                    break;
                case 'featured':
                    $query->where('is_featured', true);
                    break;
            }
        }

        // Check if it's an AJAX request for load more
        if ($request->ajax()) {
            $perPage = 3; // Load 3 items per request
            $page = $request->get('page', 1);

            $news = $query->latest()->paginate($perPage, ['*'], 'page', $page);

            // Get counts for each type
            $counts = [
                'all' => News::where('status', 'published')->count(),
                'breaking' => News::where('status', 'published')->where('is_breaking', true)->count(),
                'trending' => News::where('status', 'published')->where('is_trending', true)->count(),
                'featured' => News::where('status', 'published')->where('is_featured', true)->count(),
            ];

            $html = view('news.items', ['news' => $news])->render();

            return response()->json([
                'success' => true,
                'data' => $html,
                'has_more' => $news->hasMorePages(),
                'current_page' => $news->currentPage(),
                'total_pages' => $news->lastPage(),
                'current_count' => $news->count(),
                'total' => $news->total(),
                'counts' => $counts,
            ]);
        }

        // Initial load - 6 items
        $news = $query->latest()->paginate(6);

        // Get counts for each type
        $counts = [
            'all' => News::where('status', 'published')->count(),
            'breaking' => News::where('status', 'published')->where('is_breaking', true)->count(),
            'trending' => News::where('status', 'published')->where('is_trending', true)->count(),
            'featured' => News::where('status', 'published')->where('is_featured', true)->count(),
        ];

        $currentType = $request->get('type', 'all');

        return view('news.index', compact('news', 'counts', 'currentType'));
    }

    /**
     * Display the specified news article.
     */
    public function show($id)
    {
        $news = News::where('status', 'published')
            ->with(['category', 'author'])
            ->findOrFail($id);

        // Increment view count
        $news->increment('views');

        // Get related news
        $relatedNews = News::where('status', 'published')
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(4)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
