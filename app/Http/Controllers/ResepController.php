<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\TagItems;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar untuk resep dengan status publish
        $query = Resep::where('status', 'publish')->with('tagItems.tag');

        // Filter berdasarkan tag jika ada
        // if ($request->tag) {
        //     $tag = $request->tag;
        //     $query->whereHas('tagItems.tag', function ($query) use ($tag) {
        //         $query->where('nama_tag', $tag);
        //     });
        // }

        // Filter pencarian berdasarkan nama resep jika ada
        if ($request->q) {
            $q = $request->q;
            $query->where('nama_resep', 'LIKE', '%' . $q . '%');
        }
        if (is_numeric($request->per_page)) {
            $perPage = $request->input('per_page', 4);
        }
        // Eksekusi query untuk mengambil resep
        $getReseps = $query->orderBy('created_at', 'desc')->paginate($perPage ?? 4);


        $getReseps->load(['tagItems' => function ($query) {
            $query->take(3);
        }, 'tagItems.tag']);

        // Eager load data user (optional, jika dibutuhkan)
        $getReseps->load('user:id,username');

        // return response()->json($getReseps);

        // Mengembalikan view dengan data resep

        $getLatestReseps = Resep::where('status', 'publish')->orderBy('created_at', 'desc')->take(5)->get(['id', 'gambar']);
        return view('beranda', compact('getReseps', 'getLatestReseps'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tags::pluck('nama_tag')->toArray();
        return view('tambah', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'nama_resep' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'mimes:png,jpg,jpeg'],
            'deskripsi' => ['required', 'string', 'min:10'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string', 'max:255'],
            'tags' => ['required'],
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time() . "_" . $gambar->getClientOriginalName();
        $penyimpanan_gambar = public_path('storage/assets/gambar');
        $gambar->move($penyimpanan_gambar, $nama_gambar);

        $resep = Resep::create([
            'nama_resep' => $request->nama_resep,
            'gambar' => $nama_gambar,
            'deskripsi' => $request->deskripsi,
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);


        $tagsReq = json_decode($request->tags);
        $tags = array_column($tagsReq, 'value');
        foreach ($tags as $tag) {
            $tagsTerdaftar = Tags::where('nama_tag', $tag)->first();
            $tagItems = $tagsTerdaftar;
            if (!$tagsTerdaftar) {
                $tagItems = Tags::create([
                    'nama_tag' => $tag,
                ]);
            }
            TagItems::create([
                'resep_id' => $resep->id,
                'tag_id' => $tagItems->id,
            ]);
        }


        return redirect()->route('dashboard')->with('success', 'Resep berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $pembuat, string $id)
    {
        $getResep = Resep::findOrFail($id)->load('comment.user:id,username,avatar', 'comment.replies.user:id,username,avatar', 'comment.replies.parentReply.user:id,username,avatar', 'user:id,username', 'tagItems.tag',);
        if ($getResep->status == 'draft' && Auth::user()->id != $getResep->user->id) {
            return abort(404, 'Resep tidak ditemukan');
        }
        // return response()->json($getResep);
        $jumlah_reply = 0;
        foreach ($getResep->comment as $comment) {
            $jumlah_reply += $comment->replies->count();
        }
        $jumlah_komentar = $getResep->comment->count() + $jumlah_reply;

        return view('view-resep', compact('getResep', 'jumlah_komentar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tags = Tags::pluck('nama_tag')->toArray();
        $getResep = Resep::where('id', $id)->where('user_id', Auth::user()->id)->with('tagItems.tag')->first();
        // return response()->json($getResep);
        return view('edit', compact('getResep', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'nama_resep' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'min:10'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string', 'max:255'],
            'tags' => ['required'],
        ]);

        $nama_gambar = $request->old_gambar;

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => ['required', 'mimes:png,jpg,jpeg'],
            ]);

            if (file_exists(public_path('storage/assets/gambar/' . $nama_gambar))) {
                unlink(public_path('storage/assets/gambar/' . $nama_gambar));
            }

            $gambar = $request->file('gambar');
            $nama_gambar = time() . "_" . $gambar->getClientOriginalName();
            $penyimpanan_gambar = public_path('storage/assets/gambar');
            $gambar->move($penyimpanan_gambar, $nama_gambar);
        }

        $getResep = Resep::where('id', $id)->where('user_id', Auth::user()->id)->first();

        $resep = $getResep->update([
            'nama_resep' => $request->nama_resep,
            'gambar' => $nama_gambar,
            'deskripsi' => $request->deskripsi,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        // Ambil tag yang diinputkan oleh pengguna
        $tagsReq = json_decode($request->tags);
        $tagsBaru = array_column($tagsReq, 'value');

        // Ambil tag lama yang sudah tersimpan di database untuk resep ini
        $tagItemsLama = TagItems::where('resep_id', $getResep->id)->with('tag')->get();
        $tagsLama = $tagItemsLama->pluck('tag.nama_tag')->toArray();

        // 1. Hapus tag lama yang tidak ada di input baru
        $tagsUntukDihapus = array_diff($tagsLama, $tagsBaru);
        foreach ($tagsUntukDihapus as $tagHapus) {
            $tagTerdaftar = Tags::where('nama_tag', $tagHapus)->first();
            if ($tagTerdaftar) {
                TagItems::where('resep_id', $getResep->id)
                    ->where('tag_id', $tagTerdaftar->id)
                    ->delete();
            }
        }

        // 2. Tambahkan tag baru yang belum ada di database
        foreach ($tagsBaru as $tagBaru) {
            $tagTerdaftar = Tags::where('nama_tag', $tagBaru)->first();

            // Jika tag belum ada, buat tag baru
            if (!$tagTerdaftar) {
                $tagTerdaftar = Tags::create([
                    'nama_tag' => $tagBaru,
                ]);
            }

            // Cek apakah tag sudah terdaftar di TagItems untuk resep ini
            $tagItem = TagItems::where('resep_id', $getResep->id)
                ->where('tag_id', $tagTerdaftar->id)
                ->first();

            // Jika belum, tambahkan ke TagItems
            if (!$tagItem) {
                TagItems::create([
                    'resep_id' => $getResep->id,
                    'tag_id' => $tagTerdaftar->id,
                ]);
            }
        }
        return redirect()->route('dashboard')->with('success', 'Resep berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getResep = Resep::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $getResep->delete();
        return redirect()->route('dashboard')->with('success', 'Resep berhasil dihapus');
    }

    public function status(Request $request, string $id)
    {
        $getResep = Resep::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $getResep->update([
            'status' => $request->status
        ]);
        return redirect()->route('dashboard')->with('success', 'Status Resep berhasil diubah');
    }
}
