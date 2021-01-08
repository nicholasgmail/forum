<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'text'
    ];
    /**
     * All theme
     *
     * @var array
     */
    public static function get_theme()
    {
        $themes = Theme::orderBy('id', 'desc')->paginate(10);

        return $themes;
    }
}
