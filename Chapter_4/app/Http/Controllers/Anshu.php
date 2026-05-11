<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Anshu extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Index method called',
            'routes' => [
                'create' => route('Anshu.create'),
                'store' => route('Anshu.store'),
                'update' => route('Anshu.update', 1),
                'destroy' => route('Anshu.destroy', 1),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('simpleForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        return response()->json([
            'action' => 'store',
            'data' => $request->only(['name', 'email']),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'action' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json([
            'action' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        return response()->json([
            'action' => 'update',
            'id' => $id,
            'data' => $request->only(['name', 'email']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'action' => 'destroy',
            'id' => $id,
        ]);
    }
}
