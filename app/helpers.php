<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of helpers
 *
 * @author p_kuzmin
 */

if (! function_exists('selectedCity')) {
    function selectedCity() {
        if(session(\App\Http\Middleware\IdentifyRegion::SESSION_KEY,null)){
            return \App\Models\Region::find(session(\App\Http\Middleware\IdentifyRegion::SESSION_KEY,null))->name;
        }
        return "";        
    }
}
