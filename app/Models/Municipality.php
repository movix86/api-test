<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $table = "municipality";

    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];


    protected $hidden = [
        'id', 'created_at', 'updated_at', 'location_id',
    ];
}
