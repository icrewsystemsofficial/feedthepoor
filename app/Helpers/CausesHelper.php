<?php

namespace App\Helpers;

use Exception;
use App\Models\Causes;
use Illuminate\Support\Facades\Storage;


class CausesHelper {

    private static function icons(){
        return json_decode(Storage::get('icons.json'), true);
    }

    public static function getIcons(){
        $icons = '';
        $list = self::icons();
        foreach($list as $id=>$key){
            $icons = ($key['styles'][0] == 'solid') ? $icons."<option value='$id'>$id</option>" : $icons;
        }
        return $icons;
    }

    public static function getIconsForManage($icon){
        $icons = '';
        $list = self::icons();
        foreach($list as $id=>$key){
            $icons = ($key['styles'][0] == 'solid') ? $icons."<option value='$id' ".($icon == $id ? 'selected' : '').">$id</option>" : $icons;
        }
        return $icons;
    }

}

?>
