<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Masseg;
use App\Models\User;
use App\Models\Theme;
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
        $masseges = Masseg::get_masseg();

        return view('home', ['masseges' => $masseges]);
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
        $massegs_id = $data['masseg'] ? $data['masseg'] : 0;
        $new_messag = Masseg::create([
            'text' => $data["text"],
            'massegs_id' => $massegs_id
        ]);
        
        Forum::create([
            'user_id' => $data['user'],
            'theme_id' => $data['theme'],
            'messeg_id' => $new_messag->id
        ]);
        if ($data['masseg'] == 0){
        return response("1", 200)
            ->header('Content-Type', 'text/plain');
        }else{
            return redirect('/theme' . '/' . $data['theme']);
        }
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
     * Display the specified resource.
     *
     * @param  \App\Models\Masseg  $masseg
     * @return \Illuminate\Http\Response
     */
    public function quote(Masseg $masseg)
    {        
         $forum = Forum::where('messeg_id', $masseg->id)->get();
         $user = User::where('id', $forum[0]->user_id)->get();
         $theme = Theme::where('id', $forum[0]->theme_id)->get();
         return view('quote', ['messag' => $masseg, 
                               'user'=> $user[0]->name, 
                               'theme_name'=>$theme[0]->name,
                               'theme_id'=>$theme[0]->id]);
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
