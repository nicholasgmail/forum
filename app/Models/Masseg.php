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

        $masseges = Forum::where('theme_id', '=', $theme)
            ->join('massegs', function ($join) {
                $join->on('forums.messeg_id', '=', 'massegs.id')->select('text', 'id', 'massegs_id');
            })
            ->join('users', function ($join) {
                $join->on('forums.user_id', '=', 'users.id')->select('name');
            })            
            ->paginate(3);
        return $masseges;
    }
}
