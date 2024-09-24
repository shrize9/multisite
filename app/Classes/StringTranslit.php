<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Classes;

/**
 * Description of StringTranslit
 *
 * @author p_kuzmin
 */
class StringTranslit {
    private const CHARS = array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>'');

    
    public static function translate($cyrillic){
        $result ="";
        foreach (preg_split('//u', mb_strtolower($cyrillic), -1, PREG_SPLIT_NO_EMPTY) as $index=>$value) {            
            if(array_key_exists($value, self::CHARS)){
                $result .= self::CHARS[$value];
            }else{
                $result .= $value;
            }
        }
        return $result;
    }
}
