<?php
require_once 'partial/page_head.php';
require_once 'php/item_functions.php';
$path = "pics/dt_1_110301836051.jpg";

if (file_exists($path)) echo "test"; else "test2";
if (getimagesize($path)) echo "test"; else "test2";