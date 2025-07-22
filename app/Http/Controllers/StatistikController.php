<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class StatistikController extends Controller
{
    public function index()
    {
         // Menghitung total views semua berita
        $totalViews = Post::sum('views');

        // Mengambil daftar berita beserta jumlah views (urutkan dari yang paling banyak)
        $postViews = Post::select('id', 'title', 'views')
                         ->orderByDesc('views')
                         ->get();
        
        $author = Post::select('user_id', DB::raw('SUM(views) as total_views'))
                            ->groupBy('user_id')
                            ->with('user') // Relasi user
                            ->orderByDesc('total_views')
                            ->take(5)
                            ->get();

        return view('app.statistik.index', compact('totalViews', 'postViews','author'));
    }
}
