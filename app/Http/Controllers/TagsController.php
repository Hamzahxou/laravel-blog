<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::all();
        return view('tags', compact('tags'));
    }
    public function show(string $tag)
    {
        $getReseps = Resep::where('status', 'publish')->with('tagItems.tag')->whereHas('tagItems.tag', function ($query) use ($tag) {
            $query->where('nama_tag', $tag);
        })->get()->load('user:id,username');

        return view('view-tag', compact('getReseps'));
    }
}
