<?php

namespace App\Http\Controllers;

use App\Models\Masseg;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Masseg::create([
            'title' => $data["title"],
            'text' => $data["text"]
        ]);
        return response("1", 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masseg  $masseg
     * @return \Illuminate\Http\Response
     */
    public function show(Masseg $masseg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masseg  $masseg
     * @return \Illuminate\Http\Response
     */
    public function edit(Masseg $masseg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masseg  $masseg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masseg $masseg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masseg  $masseg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masseg $masseg)
    {
        //
    }
}
