<?php
namespace App\Helpers;

use Exception;

class SettingsHelper {
    //The types of settings that we support.
    public const TEXT = '1';
    public const TEXTAREA = '2';
    public const RICHTEXT = '3';
    public const IMAGE = '4';
    public const BOOLEAN = '5';

    public function types() : array {
        $types = array(
            self::TEXT => 'Input Box',
            self::TEXTAREA => 'Text Area',
            self::RICHTEXT => 'Rich Text editor',
            self::IMAGE => 'File',
            self::BOOLEAN => 'Switch',
        );

        // $types[] = self::TEXT;
        // $types[] = self::TEXTAREA;
        // $types[] = self::RICHTEXT;
        // $types[] = self::IMAGE;
        // $types[] = self::BOOLEAN;

        return $types;
    }

    public function getType(int $type_input) {
        if($type_input == '') {
            throw new Exception('Setting type not provided');
        }

        foreach(self::types() as $type) {
            if($type_input == $type) {
                return $type;
            }
        }

        //If there are no matches
        return new Exception('Unknown settings type');
    }
}

?>