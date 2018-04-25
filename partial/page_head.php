<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
<?php
require_once 'partial/styles.php';
require_once 'php/database.php';

$db = get_db_connection();
?>


