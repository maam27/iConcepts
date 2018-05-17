<?php
function get_item($itemId ,$dbh){
    try{
        $statement = $dbh->prepare("select [Titel]      ,[Beschrijving]      ,[Startprijs]      ,[Betalingswijze]      ,[Plaatsnaam]      ,[Land]      ,[Verzendkosten]      ,[Verzendinstructies]      ,[Verkoper], [Koper]      ,[LooptijdeindeDag]      ,[LooptijdeindeTijdstip]      ,[VeilingGesloten] from voorwerp where voorwerpnummer = :item ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();
        return $result;
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

function provide_feedback($dbh, $itemId, $soortFeedback, $beoordeling, $opmerking){

    try{
        $stmt = $dbh->prepare("INSERT INTO Feedback (Voorwerp, SoortGebruiker, Feedbacksoort, Dag, Tijdstip, Commentaar)
        VALUES (:voorwerp, :gebruiker, :beoordeling, :datum, :tijd, :commentaar)");
        $stmt -> execute(
            [
                ':voorwerp' => $itemId,
                ':gebruiker' => $soortFeedback,
                ':beoordeling' => $beoordeling,
                ':datum' => date("Y/m/d"),
                ':tijd' => date('H:i:s'),
                ':commentaar' => $opmerking
            ]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
    return false;
}

function buyer_feedback_given($dbh, $itemId){

    try{ $statement = $dbh->prepare("SELECT count(*) FROM Feedback WHERE Voorwerp = :item AND SoortGebruiker = 'Koper'");
    $statement -> execute(array(':item' => $itemId));
    $result = $statement->fetchColumn();

    if($result ==1)
        return true;
    return false;
    }

    catch(PDOException $e){
       echo $e;
   }
}



function seller_feedback_given($dbh, $itemId){
    try{ $statement = $dbh->prepare("SELECT count(*) FROM Feedback WHERE Voorwerp = :item AND SoortGebruiker = 'Verkoper'");
        $statement -> execute(array(':item' => $itemId));
        $result = $statement->fetchColumn();

        if($result ==1)
            return true;
        return false;
    }

    catch(PDOException $e){
        echo $e;
    }
}

function get_heighest_bid($itemId, $dbh){
    try{
        $statement = $dbh->prepare("select top 1 Bodbedrag from bod where Voorwerp = :item order by Bodbedrag desc ");
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

function get_heighest_bidder($itemId, $dbh){
    try{
        $statement = $dbh->prepare("select top 1 [Gebruiker] from bod where Voorwerp = :item order by Bodbedrag desc ");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();
        if(!empty($result['Gebruiker'])){
            return $result['Gebruiker'];
        }
    }
    catch(PDOException $e){
        echo $e;
    }
    return null;
}


function get_minimum_bid_increase($currentBid){
    if($currentBid < 50)
        return 0.50;
    if($currentBid < 500)
        return 1;
    if($currentBid < 1000)
        return 5;
    if($currentBid < 1000)
        return 10;
    return 50;

}

function place_bid($itemId,$bid,$user,$dbh){
    try{
    $statement = $dbh->prepare("  insert into Bod (Voorwerp, Bodbedrag, Gebruiker, BodDag, BodTijdstip) values (:item, :bid, :user, :bidDay, :bidTime) ");
    $statement->execute(array(':item' => $itemId, ':bid' => $bid, ':user' => $user, ':bidDay' => date('Y/m/d'), ':bidTime' => date('H:i:s')));
    $result = $statement->rowCount();
    if($result == 1)
        return true;
    }
    catch(PDOException $e){
      //  echo $e;
    }
    return false;
}


function get_images_for_item($itemId,$dbh){
    try{
        $statement = $dbh->prepare("SELECT filenaam from bestand where Voorwerp = :item");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
    return null;
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
