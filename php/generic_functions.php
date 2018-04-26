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