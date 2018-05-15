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
