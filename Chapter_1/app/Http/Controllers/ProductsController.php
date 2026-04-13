<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "This is Index Function";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "This is Create Function";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "This is Store Function";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "This is Show Function". $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "This is Edit Function";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        return "This is update Function";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "This is Destroy Function";
    }
}
