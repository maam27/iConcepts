<?php
function get_db_connection()
{
    require_once 'credentials.php';
    $dbh = new PDO ("sqlsrv:Server=$hostname;Database=$dbname;ConnectionPooling=0", "$username", "$pw");
    return $dbh;
}