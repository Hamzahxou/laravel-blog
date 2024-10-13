<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembuatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $getReseps = Resep::where('user_id', Auth::user()->id);

        if ($request->q) {
            $getReseps->where('nama_resep', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->status) {
            $getReseps->where('status', $request->status);
        }

        $getReseps = $getReseps->orderBy('created_at', 'desc')->paginate(2);

        // return response()->json($getReseps);

        return view('dashboard', compact('getReseps'));
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
    public function show(string $pembuat)
    {
        $getReseps = Resep::query()->where('status', 'publish')->with('user:id,username')->whereHas('user', function ($query) use ($pembuat) {
            $query->where('username', $pembuat);
        })->get();

        $getReseps->load(['tagItems' => function ($query) {
            $query->take(3);
        }, 'tagItems.tag']);
        return view('beranda', compact('pembuat', 'getReseps'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
