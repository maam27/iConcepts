<?php
require_once 'partial/page_head.php';
require_once 'php/item_functions.php';



$img1 = "20_a.png";
$img = "dt_1_110302040582.jpg";
$path = "http://iproject14.icasites.nl/";
$folder = "uploads/";
if(file_exists($path.$folder.$img))
    echo "true";
else
    echo "false";
echo "<br>";
echo $path.$folder.$img;




echo '<pre>';
var_dump(http_file_exists($path.$folder.$img)); // file exists
var_dump(http_file_exists($path.$folder.$img1)); // file does not exist
echo '</pre>';