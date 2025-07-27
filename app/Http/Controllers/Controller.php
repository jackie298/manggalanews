<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function home()
    {
        $firstPost = Post::orderBy('created_at', 'desc')->first();

        $secondPosts = Post::where('id', '!=', $firstPost->id)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

        $excludedIds = $secondPosts->pluck('id')->toArray();
        array_push($excludedIds, $firstPost->id);

        $thirdPosts = Post::whereNotIn('id', $excludedIds)
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();


        $categories = Category::latest()->get();
        $allNews = Post::with('categories')->latest()->get();

        $latest_posts = Post::latest()->take(6)->get();

        $breakingNews = Post::whereHas('breakingNews')
            ->latest()
            ->take(10)
            ->get();


        $mostViews = Post::orderBy('views', 'desc')->take(6)->get();


        $postsWithMostComments = Post::has('comments')
                                    ->withCount('comments as comments_count')
                                    ->orderBy('comments_count', 'desc')
                                    ->take(6)
                                    ->get();


        $videos = Video::latest()->get();

        return view('home.index', [
            'firstPost' => $firstPost,
            'secondPosts' => $secondPosts,
            'thirdPosts' => $thirdPosts,
            'categories' => $categories,
            'allNews' => $allNews,
            'latest_posts' => $latest_posts,
            'breakingNews' => $breakingNews,
            'mostViews' => $mostViews,
            'postsWithMostComments' => $postsWithMostComments,
            'videos' => $videos,
        ]);
    }

    public function detail($slug)
    {
        $breakingNews = Post::whereHas('breakingNews')->get();
        $post = Post::where('slug', $slug)->with('categories')->firstOrFail();
        $latest_posts = Post::latest()->take(6)->get();

        // Tambah view count jika post ditemukan
        if ($post) {
            $post->increment('views');
        }

        // Ambil berita terkait berdasarkan kategori yang sama
        $related_posts = Post::whereHas('categories', function ($query) use ($post) {
            $query->whereIn('categories.id', $post->categories->pluck('id'));
        })
        ->where('id', '!=', $post->id)
        ->latest()
        ->take(5)
        ->get();

        return view('home.post-detail', [
            'post' => $post,
            'breakingNews' => $breakingNews,
            'latest_posts' => $latest_posts,
            'relatedPosts' => $related_posts,
        ]);
    }

    public function about()
    {
        $about = About::first();
        $breakingNews = Post::whereHas('breakingNews')->get();
        $latest_posts = Post::latest()->take(6)->get();


        return view('home.about' , [
            'about' => $about,
            'breakingNews' => $breakingNews,
            'latest_posts' => $latest_posts
        ]);
    }

    public function categories()
    {
        // Paginasi untuk masing-masing kategori
        $categories = Category::with(['posts' => function ($query) {
            $query->latest()->take(6); // Ambil 6 postingan terbaru
        }])->get();

        // Paginasi untuk semua postingan
        $allNews = Post::latest()->paginate(6);

        $latest_posts = Post::latest()->take(6)->get();
        $breakingNews = Post::whereHas('breakingNews')->get();

        return view('home.category', [
            'categories' => $categories,
            'allNews' => $allNews,
            'breakingNews' => $breakingNews,
            'latest_posts' => $latest_posts,
        ]);
    }


}
