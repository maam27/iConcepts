<?php
require_once 'partial/page_head.php';
require_once 'php/item_functions.php';

foreach(get_all_sub_categories_of(38851, $db) as $val){
    echo $val."<br>";
}
