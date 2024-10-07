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
        if ($request->q || $request->status) {
            $getReseps = Resep::query()->where('user_id', Auth::user()->id)->where('nama_resep', 'LIKE %' . $request->q . '%')->orWhere('status', $request->status)->orderBy('created_at', 'desc')->get();
        } else {
            $getReseps = Resep::query()->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
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
        $getReseps = Resep::query()->with('user:id,username')->whereHas('user', function ($query) use ($pembuat) {
            $query->where('username', $pembuat);
        })->get();
        // return response()->json(count($getReseps));
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
