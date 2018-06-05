<?php

$result = $db->prepare('UpdateTabel');

try{
    $result->execute();
    }
    catch (PDOException $e) {
    die ( "Fout met de database: {$e->getMessage()} " );
    }

?>
