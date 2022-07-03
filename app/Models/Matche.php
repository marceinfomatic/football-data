<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'start_date',
        'status',
        'area',
        'competition',
        'season',
        'home_team',
        'away_team',
        'score',
    ];
}
