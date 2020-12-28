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
        'title',
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

        $masseges_id = Forum::where('theme_id', '=', $theme)
            ->pluck('messeg_id');

        $masseges = Masseg::whereIn('id', $masseges_id)->paginate(3);
        return $masseges;
    }
}
