<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $theme = Theme::get_theme();

        return view('home', [
            'themes' => $theme
        ]);
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
            'name.required' => 'please fill in the value name',
            'name.max' => 'value greater than 255',
            'name.unique' => 'the theme exists',
            'text.required' => 'please fill in the value text',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:themes',
            'text' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        };
        $data = $request->all();
        $new_theme = Theme::create([
            'name' => $data["name"],
            'text' => $data["text"],
        ]);
        Forum::create([
            'user_id' => $data['user'],
            'theme_id' => $new_theme->id,
            'messeg_id' => "null"
        ]);

        $data = collect(['id' => $new_theme->id]);
        return response()
            ->json($data)
            ->header('Content-Type', 'application/json');
    }
}
