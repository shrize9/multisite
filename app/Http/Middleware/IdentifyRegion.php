<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use \Illuminate\Support\Facades\Log;
use Closure;

/**
 * Description of IdentifyRegion
 *
 * @author p_kuzmin
 */
class IdentifyRegion {
    const SESSION_KEY ="regionId";
    
    private function updateRegion($request, $slug, $id){
            $findedRegion =null ;
            
            if($slug !=null)
                $findedRegion =\App\Models\Region::where('slug', \App\Classes\StringTranslit::translate($slug))->first();
            if($id !=null)
                $findedRegion =\App\Models\Region::find($id);
            
            if($findedRegion){
                if($request->session()->get(self::SESSION_KEY, null)){
                    Log::debug("old session ",[$request->session()->get(self::SESSION_KEY, null)]);                    
                }
                $request->session()->put(self::SESSION_KEY, $findedRegion->id);
                URL::defaults(['region' => $findedRegion->slug]);            
                return true;
            }else{
                return false;
            }
        
    }
    
    public function handle(Request $request, Closure $next)
    {
        Log::debug("has uri ",[$request->getRequestUri()]);
        $uri =explode("/", urldecode($request->getRequestUri()));        
        if(count($uri)>1 & trim($uri[1]) !=""){            
            if($this->updateRegion($request, $uri[1], null)){
            }else{
                abort(404);
            }
        }else if($request->session()->get(self::SESSION_KEY, null)){
                Log::debug("try load by session ",[$request->session()->get(self::SESSION_KEY, null)]);
                if($this->updateRegion($request, null, $request->session()->get(self::SESSION_KEY, null))){
                    Log::debug("try load by session ",[URL::getDefaultParameters()['region']]);
                    return redirect('/'. URL::getDefaultParameters()['region'].'',301);
                }else{
                    abort(404);
                }                
        }else{
                URL::defaults(['region' => '']);
        }
        
        return $next($request);
    }

}
