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

    public function store(Request $request)
    {
        $request->validate([
            'nama_tag' => ['required', 'string', 'max:255', 'unique:tags,nama_tag'],
        ]);
        Tags::create([
            'nama_tag' => $request->nama_tag,
        ]);
        return redirect()->route('tags.view')->with('success', 'Tag berhasil ditambahkan');
    }

    public function view()
    {
        $tags = Tags::all();
        return view('admin.tags', compact('tags'));
    }

    public function update(Request $request, string $id)
    {
        $tag = Tags::findOrFail($id);
        $tag->update([
            'nama_tag' => $request->nama_tag,
        ]);
        return redirect()->route('tags.view')->with('success', 'Tag berhasil diubah');
    }

    public function destroy(string $id)
    {
        $tag = Tags::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.view')->with('success', 'Tag berhasil dihapus');
    }
}
