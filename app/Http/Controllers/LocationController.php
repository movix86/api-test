<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function codes($code){

        $code = Location::where('zip_code', $code)->first();

        $data =[
            "zip_code"=> $code["zip_code"],
            "locality"=> $code["locality"],
            "federal_entity"=> [
                "key"=> $code->federal_entity["key"],
                "name"=> $code->federal_entity["name"],
                "code"=> $code->federal_entity["code"]
            ]
            ,
            "settlements"=> [[
                "key"=> $code->settlements["key"],
                "name"=> $code->settlements["name"],
                "zone_type"=> $code->settlements["zone_type"],
                "settlement_type"=>[
                    "name"=>$code->settlements_type['zone_type'],
                ]

            ]]
            ,
            "municipality"=>[
                "key"=> $code->municipality["key"],
                "name"=> $code->municipality["name"]
            ]

        ];
        return response()->json($data);

    }
}
