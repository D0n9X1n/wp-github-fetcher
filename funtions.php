<?php

if (!function_exists('d')) {
    function d($value)
    {
        if(is_array($value)) {
            header("Content-type: application/json");
            echo json_encode($value, JSON_UNESCAPED_UNICODE);
        } else {
            echo '<pre>';var_dump($value);echo '</pre>';
        }
    }
}

if(!function_exists('dd')) {
    function dd($value)
    {
        d($value);
        die(0);
    }
}

if (!function_exists('json_return')) {
    function json_return($value)
    {
        dd($value);
    }
}
