<?php
namespace Config\Constants; 

class Messages{
    static function getMessage($code, $options = [],$length=[]) {
        return isset(self::messages($options,$length)[$code]) ? self::messages($options,$length)[$code] : '';
    }

    static function messages($options)
    {
        $params1 = $options[0] ?? 'Field';
        $lengths= $options[1] ?? '';
        $ex= $options[2] ?? '';
        return [
            'E001' => "{$params1} is required field.",
            'E002' => "{$params1} must be less than {$lengths} characters.",
            'E003' => "{$params1} must be more than {$lengths} characters.",
            'E004' => "Please enter your email address correctly.",
            'E006' => "The file size limit {$params1} has been exceeded.",
            'E007' => "File extension is incorrect. Please use {$params1}.",
            'E011' => "Re-password is not the same as Password.",
            'E012' => "{$params1} format is not correct. Please enter {$ex} only.",
            'E017' => "Enter the date correctly for {$params1}.",
            'E018' => "{$params1} must be a number",
            'E021' => "The list value of {$params1} is incorrect.",
            'E022' => "Enter {$params1} in double-byte hiragana.",
        ];
    }
}
