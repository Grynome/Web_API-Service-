<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\Models\Genres;

class Mov_Genres extends Model
{
    protected $table = 'mov_genres';

    public $primaryKey = 'id';

    protected $fillable = [
        'mov_id', 'genres_id'
    ];

    public function get_mov(){
        return $this->belongsTo(Movie::class, 'mov_id', 'mov_id');
    }
    public function get_genre(){
        return $this->belongsTo(Genres::class, 'genres_id', 'genres_id');
    }
}
