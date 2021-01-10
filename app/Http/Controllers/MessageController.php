<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Masseg;
use App\Models\User;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        if (!$request->accepts(['text/html', 'application/json'])) {
            return false;
        }
        $messages = [
            'text.required' => 'please fill in the value text',
        ];

        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        };
        $data = $request->all();
        $new_messag = Masseg::create([
            'text' => $data["text"],
            'massegs_id' => $data['masseg']
        ]);

        Forum::create([
            'user_id' => $data['user'],
            'theme_id' => $data['theme'],
            'messeg_id' => $new_messag->id
        ]);
        $data_success = collect(['success' => 'Message sent']);
        if ($data['masseg'] == 0) {
            return response()
                ->json($data_success, 200)
                ->header('Content-Type', 'application/json');
        } else {
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
        return view('quote', [
            'messag' => $masseg,
            'user' => $user[0]->name,
            'theme_name' => $theme[0]->name,
            'theme_id' => $theme[0]->id
        ]);
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
        $dt= Masseg::find($masseg->id);
        Masseg::where('massegs_id', '=', $dt->id)->delete();
        Forum::where('messeg_id', '=', $dt->id)->delete();
        $masseg->delete();

        return response()
            ->json('success', 200)
            ->header('Content-Type', 'application/json');
    }
}
