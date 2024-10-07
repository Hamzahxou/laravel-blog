<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required',
            'comment' => 'required'
        ]);
        // dd($request->reply);
        // die();

        $resep = Comments::findOrFail($request->comment_id);
        Reply::create([
            'user_id' => Auth::user()->id,
            'parent_reply_id' => $request->reply ?? null,
            'comment_id' => $request->comment_id,
            'content' => $request->comment
        ]);
        return redirect()->back()->with('success', 'Komentar Balasan berhasil dikirim');
    }
    public function update(Request $request)
    {

        $reply = Reply::where('id', $request->reply_id)->where('user_id', Auth::user()->id)->firstOrFail();
        $reply->update([
            'content' => $request->content ?? $reply->content
        ]);
        return redirect($request->url)->with('success', 'Komentar Balasan berhasil diubah');
    }
    public function destroy(Request $request)
    {
        $reply = Reply::where('id', $request->reply_id)->where('user_id', Auth::user()->id)->firstOrFail();
        $reply->delete();
        return redirect()->back()->with('success', 'Komentar Balasan berhasil dihapus');
    }
}
