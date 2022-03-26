<?php

namespace App\Helpers;

use Exception;
use App\Models\FaqCategories;
use App\Models\FaqEntries;

class FaqHelper {

    public static function getCategoryName($id){
        $category = FaqCategories::find($id);
        if($category) {
            return $category->category_name;
        } else {
            return "Unknown";
        }

    }

    public static function getAllCategories(){
        $categories = FaqCategories::all();
        $html = '';
        foreach ($categories as $category) {
            if ($category->category_status == 1) { // Displaying only active categories
                $html .= '<option value="'.$category->id.'">'.$category->category_name.'</option>';
            }
        }
        return $html;
    }

}

?>
