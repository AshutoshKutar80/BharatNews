<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        $news = News::with(['category', 'subcategory', 'author'])
            ->latest()
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store news
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'short_description' => 'nullable|max:500',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'source' => 'nullable|max:255',
            'location' => 'nullable|max:255',
            'tags' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'meta_keywords' => 'nullable|max:255',
            'status' => 'required|in:draft,published',
        ]);

        $image = null;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image')->store('news', 'public');
        }

        News::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'] ?? null,
            'author_id' => auth()->id(),
            'short_description' => $validated['short_description'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $image,
            'source' => $validated['source'] ?? null,
            'location' => $validated['location'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'status' => $validated['status'],
            'is_breaking' => $request->boolean('is_breaking'),
            'is_featured' => $request->boolean('is_featured'),
            'is_trending' => $request->boolean('is_trending'),
            'published_at' => $validated['status'] == 'published'
                ? now()
                : null,
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }

    // view in popup model
    public function show(News $news)
    {
        $news->load(['category', 'subcategory', 'author']);

        return response()->json([
            'id' => $news->id,
            'title' => $news->title,
            'slug' => $news->slug,
            'short_description' => $news->short_description,
            'content' => $news->content,
            'featured_image' => $news->featured_image ? asset('storage/' . $news->featured_image) : null,
            'category' => $news->category->name ?? null,
            'subcategory' => $news->subcategory->name ?? null,
            'author' => $news->author->name ?? null,
            'source' => $news->source,
            'location' => $news->location,
            'tags' => $news->tags,
            'status' => $news->status,
            'is_breaking' => (bool) $news->is_breaking,
            'is_featured' => (bool) $news->is_featured,
            'is_trending' => (bool) $news->is_trending,
            'views' => $news->views,
            'published_at' => optional($news->published_at)->format('d M Y, h:i A'),
            'created_at' => optional($news->created_at)->format('d M Y, h:i A'),
        ]);
    }

    /**
     * Show edit form
     */
    public function edit(News $news)
    {
        $categories = Category::where('status', 'active')->get();

        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update news
     */
    public function update(Request $request, News $news)
    {
        // dd($request->toArray(), $news->toArray());
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'short_description' => 'nullable|max:500',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'source' => 'nullable|max:255',
            'location' => 'nullable|max:255',
            'tags' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'meta_keywords' => 'nullable|max:255',
            'status' => 'required|in:draft,published',
        ]);

        $image = $news->featured_image;

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
                Storage::disk('public')->delete($news->featured_image);
            }

            $image = $request->file('featured_image')->store('news', 'public');
        }

        $news->update([
            'title' => $validated['title'],
            'slug' => $news->title !== $validated['title']
                ? Str::slug($validated['title']) . '-' . time()
                : $news->slug,
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $image,
            'source' => $validated['source'] ?? null,
            'location' => $validated['location'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'status' => $validated['status'],
            'is_breaking' => $request->boolean('is_breaking'),
            'is_featured' => $request->boolean('is_featured'),
            'is_trending' => $request->boolean('is_trending'),
            'published_at' => $validated['status'] === 'published'
                ? ($news->published_at ?? now())
                : null,
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News updated successfully.');
    }

    /**
     * Delete news
     */
    public function destroy(News $news)
    {
        if ($news->featured_image && Storage::disk('public')->exists($news->featured_image)) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return back()->with('success', 'News deleted successfully.');
    }

    /**
     * using ajax take sub category
     */
    public function subcategoriesByCategory($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)
            ->where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($subcategories);
    }
}
