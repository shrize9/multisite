<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
namespace App\Http\Controllers\Api;

use \Illuminate\Support\Facades\Response;
use \Illuminate\Http\Request;
use \App\Classes\ApiHH;
use App\Classes\StringTranslit;
use \App\Models\Region;

/**
 * Description of RegionController
 *
 * @author p_kuzmin
 */
class RegionController {
    
    public function create(Request $request){
        $jsBody =json_decode($request->getContent(),true);
        
        if(!$jsBody){
            throw new \Exception("body is empty");
        }
        
        if(!count(array_intersect(["id","name"],array_keys($jsBody)))){
            throw new \Exception("body " .$request->getContent() ." not contains fields: id, name");
        }
        
        $count =Region::updateOrCreate([
            "id"=>$jsBody["id"]
        ],[
            "name"=>$jsBody["name"],
            "slug"=>StringTranslit::translate($jsBody["name"])
        ]);
        
        
        return Response::json(["error"=>false, "count"=>$count]);
    }    
    
    public function list(Request $request){        
        return Response::json(["error"=>false, "data"=>Region::all()]);
    }    
    
    public function remove(Request $request, String $regionId){        
        $count =Region::destroy($regionId);
        return Response::json(["error"=>false, "deleted"=>$count]);
    }    
    
    public function load(Request $request){
        foreach(ApiHH::load("113") as $region){
            Region::updateOrCreate([
                "id"=>$region["id"]
            ],[
                "name"=>$region["name"],
                "slug"=>StringTranslit::translate($region["name"])
            ]);
        }
        
        return Response::json(["error"=>false]);
    }    
}
