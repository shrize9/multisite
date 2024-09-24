<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Classes;

/**
 * Description of ApiHH
 *
 * @author p_kuzmin
 */
class ApiHH {
    
    private static function getCity($areas){
        $accum =[];
        foreach ($areas as $item){
            if(count($item["areas"])>0){
                $accum =array_merge($accum, self::getCity($item["areas"]));
            }else{
                array_push($accum, $item);
            }
        }
        return $accum;
    }
    
    public static function load($byCountryId){
        if(!is_numeric($byCountryId))
            throw new \Exception("$byCountryId not a number");
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.hh.ru/areas");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = json_decode(curl_exec($ch),true);
        curl_close($ch);
        
        $result =[];
        foreach ($response as $key=>$item){
            if($item["id"] ==$byCountryId){
                $result =$item["areas"];
                break;
            }
        }
        
        return self::getCity($result,[]);
    }
}
