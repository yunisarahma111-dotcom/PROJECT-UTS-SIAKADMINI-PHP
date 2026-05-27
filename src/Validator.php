<?php

class Validator{

    public static function required($value){

        return trim($value) != "";
    }

    public static function email($value){

        return filter_var(
            $value,
            FILTER_VALIDATE_EMAIL
        );
    }
}