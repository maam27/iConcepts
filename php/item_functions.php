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


function get_item_bids($itemId ,$dbh){
    try{
        $statement = $dbh->prepare("SELECT TOP (10) [Bodbedrag] as 'amount', [Gebruiker] as 'user', [BodDag] as 'day',[BodTijdstip] as 'time' FROM [Bod] where Voorwerp = :item order by Bodbedrag desc ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
    return null;
}


//
//
//function get_item_diz($itemId ,$dbh){
//    try{
//        $statement = $dbh->prepare("select titel from voorwerp where voorwerpnummer = :item ");
//        $statement->execute(array(':item' => $itemId));
//        $result = $statement->fetch();
//        return $result['titel'];
//    }
//    catch(PDOException $e){
//        echo $e;
//    }
//    return null;
//}
