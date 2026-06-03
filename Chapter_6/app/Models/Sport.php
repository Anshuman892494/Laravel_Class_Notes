<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;
    protected $fillable=[
        'sports_name',
        'category',
        'no_of_players',
        'description',
        'is_olympic',
        'date_of_sport',

    ];
}
