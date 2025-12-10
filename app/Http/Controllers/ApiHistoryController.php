<?php

namespace App\Http\Controllers;

use App\Models\ApiHistory;
use Illuminate\Http\Request;

class ApiHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApiHistory::orderBy('created_at', 'desc')->get();
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
    public function show($id)
    {
        return ApiHistory::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApiHistory $apiHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApiHistory $apiHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ApiHistory::destroy($id);

        return ['message' => 'deleted'];
    }

    public function clear()
    {
        ApiHistory::truncate();

        return ['message' => 'all history cleared'];
    }

}
