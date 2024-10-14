<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CopyController extends Controller
{
    public function __invoke(Request $request, string $id)
    {
        $resep = Resep::findOrFail($id);
        Resep::create([
            'nama_resep' => $resep->nama_resep . ' - Copy',
            'gambar' => $resep->gambar,
            'deskripsi' => $resep->deskripsi,
            'content' => $resep->content,
            'status' => 'draft',
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('dashboard')->with('success', 'Resep berhasil disalin');
    }
}
