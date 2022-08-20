<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementType extends Model
{
    use HasFactory;
    protected $table = "settlements_type_";

    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];


    protected $hidden = [
        'id', 'created_at', 'updated_at', 'settlements_id',
    ];
}
