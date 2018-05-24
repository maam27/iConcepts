<?php
function redirect($location){
    header("Location: ".$location);
}

function if_set($var, $method){
    if(isset($_GET[$var])||isset($_POST[$var])){
        switch($method){
            case 'get':
                return $_GET[$var];
            case 'post':
                return $_POST[$var];
            default:
                return "";
        }
    }
}

function post_set($name, $method){
    if(isset($_GET[$name])||isset($_POST[$name])){
        switch($method){
            case 'get':
                return "value=$_GET[$name]";
            case 'post':
                return "value='".$_POST[$name]."'";
            default:
                return "";
        }
    }
}

function user_is_logged_in(){
    if(isset($_SESSION['user'])){
        return true;
    }
    return false;
}

function currency($amount){
    return number_format($amount,2,',','.');
}

function floor_with_precision($val, $precision)
{
    $mult = pow(10, $precision); // Can be cached in lookup table
    return floor($val * $mult) / $mult;
}

function get_image_path($img,$thumbnail = false){
    if($thumbnail)
        return "http://iproject14.icasites.nl/thumbnails/".$img;
    return "http://iproject14.icasites.nl/pics/".$img;

}
