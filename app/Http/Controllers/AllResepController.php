<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllResepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $users = User::where('role', '!=', 'admin')->get();
        $getReseps = Resep::where('user_id', '!=', $user);
        if ($request->q) {
            $getReseps->where('nama_resep', 'LIKE', '%' . $request->q . '%');
        }
        if ($request->user) {
            $getReseps->where('user_id', $request->user);
        }
        if ($request->status) {
            $getReseps->where('status', $request->status);
        }
        $getReseps = $getReseps->orderBy('user_id', 'asc')->with('user')->paginate(10);
        return view('admin.resep.all', compact('getReseps', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $resep = Resep::findOrFail($id);
        $resep->update([
            'status' => $request->status,
        ]);
        return redirect()->route('all_reseps.index')->with('success', 'Status Resep berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();
        return redirect()->route('all_reseps.index')->with('success', 'Resep berhasil dihapus');
    }
}
