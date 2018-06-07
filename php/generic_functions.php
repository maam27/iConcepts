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
    $host = "http://iproject14.icasites.nl/";
    $folder = "pics/";

    if(http_file_exists($host.$folder.$img)){
        if($thumbnail) {
            $folder = "thumbnails/";
        } else{
            $folder = "pics/";
        }
    }else{
        $folder = "uploads/";
    }
    return $host.$folder.$img;
}


//
//function to test if a file exists
//found on https://www.webdeveloper.com/forum/d/91350-checking-to-see-if-an-image-exists/6
//in a post from Bokeh on Jan'06
//
function http_file_exists($url, $followRedirects = true)
{
    $url_parsed = parse_url($url);
    extract($url_parsed);
    if (!@$scheme) $url_parsed = parse_url('http://'.$url);
    extract($url_parsed);
    if(!@$port) $port = 80;
    if(!@$path) $path = '/';
    if(@$query) $path .= '?'.$query;
    $out = "HEAD $path HTTP/1.0\r\n";
    $out .= "Host: $host\r\n";
    $out .= "Connection: Close\r\n\r\n";
    if(!$fp = @fsockopen($host, $port, $es, $en, 5)){
        return false;
    }
    fwrite($fp, $out);
    while (!feof($fp)) {
        $s = fgets($fp, 128);
        if(($followRedirects) && (preg_match('/^Location:/i', $s) != false)){
            fclose($fp);
            return http_file_exists(trim(preg_replace("/Location:/i", "", $s)));
        }
        if(preg_match('/^HTTP(.*?)200/i', $s)){
            fclose($fp);
            return true;
        }
    }
    fclose($fp);
    return false;
}

function echo_html_safe($string){
    echo return_html_safe($string);
}
function return_html_safe($string){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}