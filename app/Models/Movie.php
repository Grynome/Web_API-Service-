<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'list_movie';

    public $primaryKey = 'mov_id';

    protected $fillable = [
        'judul', 'release_date', 'producer', 'rating'
    ];
}
