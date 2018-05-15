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


function is_existing_product($itemId ,$dbh){
    try{
        $statement = $dbh->prepare("select titel from voorwerp where voorwerpnummer = :item ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();
        if(!empty($result['titel'])){
            return true;
        }
        return false;
    }
    catch(PDOException $e){
        echo $e;
    }
    return false;
}

function get_heighest_bid($itemId, $dbh){
    try{
        $statement = $dbh->prepare("select top 1 Bodbedrag from bod where Voorwerp = :item order by Bodbedrag ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();
        if(!empty($result['Bodbedrag'])){
            return $result['Bodbedrag'];
        }
    }
    catch(PDOException $e){
        echo $e;
    }
    return "0.00";
}

function get_minimum_bid_increase(){
    return 1;
}

function place_bid($itemId,$bid,$user,$dbh){
    try{
    $statement = $dbh->prepare("SELECT count(*) FROM Gebruiker join Vraag on vraag.Vraagnummer = Gebruiker.Vraag where Mailbox = :email and Antwoordtekst = :antwoord ");
    $statement->execute(array(':email' => $email, ':antwoord' => $answer));
    $result = $statement->fetchColumn();
    if($result == 1)
        return true;
    }
    catch(PDOException $e){
        echo $e;
    }
    return false;
}

//try{

//catch(PDOException $e){
//    echo $e;
//}
//return false;

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
