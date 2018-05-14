<?php
$hostname = "mssql2.iproject.icasites.nl";
$dbname = "iproject14";
$username = "iproject14";
$pw = "	e5aQSbD2uH";
$dbh = new PDO ("sqlsrv:Server=$hostname;Database=$dbname;
            ConnectionPooling=0", "$username", "$pw");
?>
