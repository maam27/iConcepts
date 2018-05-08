<?php
function get_item_name($itemId ,$dbh){
    try{
        $statement = $dbh->prepare("select titel from voorwerp where voorwerpnummer = :item ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();
        return $result['titel'];
    }
    catch(PDOException $e){
        echo $e;
    }
    return null;
}

function get_item_description($itemId ,$dbh){
    try{
        $statement = $dbh->prepare("select beschrijving from voorwerp where voorwerpnummer = :item ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();
        return $result['beschrijving'];
    }
    catch(PDOException $e){
        echo $e;
    }
    return null;
}

function get_item_diz($itemId ,$dbh){
    try{
        $statement = $dbh->prepare("select titel from voorwerp where voorwerpnummer = :item ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();
        return $result['titel'];
    }
    catch(PDOException $e){
        echo $e;
    }
    return null;
}

function reset_password($email, $password, $dbh){
    try{
        $statement = $dbh->prepare("update Gebruiker set Wachtwoord = :password where Mailbox = :email ");
        $statement->execute(array(':password' => $password, ':email' => $email));
        $result = $statement->rowCount();
        if($result == '1')
            return true;
        return false;
    }
    catch(PDOException $e){
        echo $e;
    }
    return false;
}