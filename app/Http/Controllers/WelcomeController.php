<?php

namespace App\Http\Controllers;

use App\Models\Masseg;
use Illuminate\Http\Request;
use App\Models\Theme;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theme =Theme::join('forums', function ($join) {
                $join->on('themes.id', '=', 'forums.theme_id')
                ->where('forums.messeg_id', '=', "null");
            })
            ->select('forums.user_id', 'forums.theme_id', 'themes.name', 'themes.created_at')
            ->orderBy('themes.created_at', 'desc')
            ->get();

        return view('welcome', compact('theme'));
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
            'theme_id' => $theme[0]["id"],
            'masseges' => $masseges
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
        //
    }
}
