<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VideoController extends Controller
{
    public function index()
    {
        if (Gate::denies('admin-fitur')) {
            abort(403, 'Lagi Mencari APA Bro!.');
        }
        $videos = Video::paginate(10);
        return view('app.video.index', compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required',
        ]);

        $video = Video::create($validatedData);

        return redirect()->route('videos.index')->with('success', 'Video berhasil ditambahkan');
    }
}
