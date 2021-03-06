<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Masseg;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masseges = Masseg::get_masseg();
        return view('theme', ['masseges' => $masseges]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        $theme = Theme::find($theme);
        $theme_id = $theme[0]['id'];
        $masseges = Masseg::get_theme_messeg($theme_id);

        return view('theme', [
            'name' => $theme[0]["name"],
            'text' => $theme[0]["text"],
            'theme_id' => $theme[0]["id"],
            'masseges' => $masseges[0],
            'comments' => $masseges[1],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        $dt = Theme::find($theme->id);
        $mes = Forum::where('theme_id', '=', $dt->id)->pluck('messeg_id');
        Masseg::where('id', '=', $mes)->delete();
        Forum::where('theme_id', '=', $dt->id)->delete();
        $theme->delete();

        return response()
            ->json('success', 200)
            ->header('Content-Type', 'application/json');
    }
}
