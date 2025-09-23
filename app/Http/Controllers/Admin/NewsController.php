<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::with('author')->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $news = $query->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = [
            'program-utama' => 'Program Utama',
            'pelatihan' => 'Pelatihan',
            'prestasi' => 'Prestasi',
            'kemitraan' => 'Kemitraan',
            'event' => 'Event'
        ];

        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:program-utama,pelatihan,prestasi,kemitraan,event',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();
        $data['author_id'] = auth()->id();
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('news', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        // Set published_at if status is published
        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        $news = News::create($data);

        return redirect()->route('admin.news.index')
                        ->with('success', 'Berita berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = [
            'program-utama' => 'Program Utama',
            'pelatihan' => 'Pelatihan',
            'prestasi' => 'Prestasi',
            'kemitraan' => 'Kemitraan',
            'event' => 'Event'
        ];

        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:program-utama,pelatihan,prestasi,kemitraan,event',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('news', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        // Set published_at if status is published and wasn't published before
        if ($request->status === 'published' && $news->status !== 'published') {
            $data['published_at'] = now();
        } elseif ($request->status === 'draft') {
            $data['published_at'] = null;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
                        ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
                        ->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(News $news)
    {
        $news->update(['is_featured' => !$news->is_featured]);

        return response()->json([
            'success' => true,
            'is_featured' => $news->is_featured
        ]);
    }

    /**
     * Toggle status (publish/unpublish)
     */
    public function toggleStatus(News $news)
    {
        $newStatus = $news->status === 'published' ? 'draft' : 'published';
        
        $updateData = ['status' => $newStatus];
        
        if ($newStatus === 'published' && !$news->published_at) {
            $updateData['published_at'] = now();
        } elseif ($newStatus === 'draft') {
            $updateData['published_at'] = null;
        }

        $news->update($updateData);

        return response()->json([
            'success' => true,
            'status' => $news->status
        ]);
    }
}
