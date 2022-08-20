<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SettlementType;

class Settlements extends Model
{
    use HasFactory;
    protected $table = "settlements";

    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];


    protected $hidden = [
        'id', 'created_at', 'updated_at', 'location_id',
    ];

    public function settlement_type(){

        return hasOne(SettlementType::class);
    }
}
