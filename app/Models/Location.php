<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FederalEntity;
use App\Models\Settlements;
use App\Models\Municipality;
use App\Models\SettlementType;

class Location extends Model
{
    use HasFactory;
    protected $table = "location";

    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];


    protected $hidden = [
        'id', 'created_at', 'updated_at',
    ];

    public function federal_entity(){

        return $this->hasOne(FederalEntity::class);
    }
    public function settlements(){

        return $this->hasOneThrough(SettlementType::class, Settlements::class);
    }

    public function municipality(){

        return $this->hasOne(Municipality::class);
    }
}
