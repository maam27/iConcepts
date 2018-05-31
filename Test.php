<?php
require_once 'partial/page_head.php';
require_once 'php/item_functions.php';

foreach(get_all_sub_categories_of(38850, $db) as $val){
    echo $val."<br>";
}
?>

<form method="get" action="#">
    <input name="yo" type="text">
    <input name="bo" type="text">
    <input name="ho" type="text">
    <input type="submit">
</form>