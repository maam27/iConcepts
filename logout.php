<?php
require_once 'php/generic_functions.php';
if (!isset($_SESSION)) {
    session_start();
}
session_destroy();
redirect('index.php');