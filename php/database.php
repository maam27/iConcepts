<?php
function get_db_connection()
{
    try{
    require_once 'credentials.php';
    $dbh = new PDO ("sqlsrv:Server=$hostname;Database=$dbname;ConnectionPooling=0", "$username", "$pw");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
    }catch(PDOException $e){
        echo 'Connection failed: ' . $e->getMessage();
    }
}

/* function update_auction ($dbh)
{
 try{
    require_once 'credentials.php';

  }

}*/
?>
