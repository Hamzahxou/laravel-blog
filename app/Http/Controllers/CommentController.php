<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, string $id)
    {
        $resep = Resep::findOrFail($id);
        $request->validate([
            'comment' => 'required'
        ]);
        Comments::create([
            'user_id' => Auth::user()->id,
            'resep_id' => $resep->id,
            'content' => $request->comment
        ]);
        return redirect()->back()->with('success', 'Komentar berhasil dikirim');
    }

    public function update(Request $request, string $id)
    {
        $comment = Comments::where('id', $request->comment_id)->where('user_id', Auth::user()->id)->firstOrFail();
        $comment->update([
            'content' => $request->content ?? $comment->content
        ]);
        return redirect($request->url)->with('success', 'Komentar berhasil diubah');
    }
    public function destroy(Request $request, string $id)
    {
        $comment = Comments::where('id', $request->comment_id)->where('user_id', Auth::user()->id)->firstOrFail();
        $comment->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }
}
