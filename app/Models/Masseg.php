<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masseg extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'massegs_id',
        'text',
    ];

    /**
     * All entries
     *
     * @var array
     */
    public static function get_masseg()
    {
        $masseges = Masseg::paginate(3);

        return $masseges;
    }
    /**
     * All theme messag
     * @var array
     */
    public static function get_theme_messeg($theme)
    {

        $masseges_coment = Forum::where('theme_id', '=', $theme)
            ->join('massegs', function ($join) {
                $join->on('forums.messeg_id', '=', 'massegs.id')
                    ->where('massegs_id', '>', '0');
            })
            ->join('users', function ($join) {
                $join->on('forums.user_id', '=', 'users.id');
            })
            ->select('users.name', 'massegs.text', 'massegs.massegs_id', 'massegs.created_at')->get();


        $masseges = Forum::where('theme_id', '=', $theme)
            ->join('massegs', function ($join) {
                $join->on('forums.messeg_id', '=', 'massegs.id')
                    ->where('massegs_id', '=', '0');
            })
            ->join('users', function ($join) {
                $join->on('forums.user_id', '=', 'users.id');
            })
            ->select('forums.messeg_id', 'forums.user_id', 'forums.theme_id', 'users.name', 'massegs.text', 'massegs.created_at')
            ->orderBy('massegs.created_at', 'desc')
            ->paginate(10);
        $collection = collect([$masseges, $masseges_coment]);

        return $collection;
    }
}
