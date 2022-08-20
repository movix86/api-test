<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settlements;

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

    public function settlements(){

        return belongsTo(Settlements::class, 'id');
    }
}

