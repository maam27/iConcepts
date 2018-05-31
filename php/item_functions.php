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
        $stmt = $dbh->prepare("INSERT INTO Feedback VALUES (:voorwerp, :gebruiker, :beoordeling, :datum, :tijd, :commentaar)");
        $stmt -> execute(
            [
                ':voorwerp' => $itemId,
                ':gebruiker' => $soortFeedback,
                ':beoordeling' => $beoordeling,
                ':datum' => date("Y/m/d"),
                ':tijd' => date('H:i:s'),
                ':commentaar' => $opmerking
            ]);
    }
    catch(PDOException $e){
        echo $e->getMessage();

    }
    return true;
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

function get_sellers_open_auctions($dbh, $verkoper){
    try{
        $statement = $dbh->prepare("SELECT * FROM Voorwerp where Verkoper = :verkoper AND VeilingGesloten=0");
        $statement->execute(array(':verkoper' => $verkoper));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
}

function get_sellers_closed_auctions($dbh, $verkoper){
    try{
        $statement = $dbh->prepare("SELECT * FROM Voorwerp where Verkoper = :verkoper AND VeilingGesloten=1");
        $statement->execute(array(':verkoper' => $verkoper));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
}

function get_images_for_item($itemId,$dbh){
    try{
        $statement = $dbh->prepare("SELECT top 4 filenaam from bestand where Voorwerp = :item");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
    return null;
}

function get_catagory($dbh){
    $sql = "SELECT TOP (6) * FROM Rubriek";
    $query = $dbh->prepare($sql);
    $query->execute();
    return $Rubriek = $query->fetchAll();
}

function get_sub_categories($category, $dbh){
    // ;
    $query = $dbh->prepare("select Rubrieknummer, Rubrieknaam, (select count(rub.Rubrieknummer) from Rubriek rub where rub.Volgnummer = riek.Rubrieknummer) as 'subrubrieken' from Rubriek riek where riek.Volgnummer = :followNr order by riek.Rubrieknaam asc");
    $query->execute(array(':followNr' => $category));
    return $query->fetchAll();
}

function get_category_view($dbh, $filter){
//    expirimenting multiple page results
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
    $results_per_page = 30; //  offset number of results per page
    $start_from = ($page-1) * $results_per_page;
    $sql = "select v.*, r.Rubrieknaam, r.Rubrieknummer, Filenaam from voorwerp v
inner join VoorwerpInRubriek k on v.Voorwerpnummer = k.Voorwerp
left join Rubriek r on k.RubriekOpLaagsteNiveau = r.Rubrieknummer
inner join Bestand B on v.Voorwerpnummer = b.Voorwerp  ORDER BY Voorwerpnummer asc offset " . $start_from . " ROWS FETCH NEXT " . $results_per_page . " ROWS ONLY";


    //    end expiriment

//$query = "select top 30 v.*, r.Rubrieknaam, r.Rubrieknummer, Filenaam from voorwerp v
//inner join VoorwerpInRubriek k on v.Voorwerpnummer = k.Voorwerp
//left join Rubriek r on k.RubriekOpLaagsteNiveau = r.Rubrieknummer
//inner join Bestand B on v.Voorwerpnummer = b.Voorwerp" . $filter;

    $statement = $dbh->query($sql);
    $statement->execute();
    return $result = $statement->fetchAll();
}

function get_highest_auction_number($dbh){

    try{
        $statement = $dbh -> prepare("select top 1 Voorwerpnummer from voorwerp where voorwerpnummer > 16 AND voorwerpnummer < 110301827613 order by voorwerpnummer desc");
        $statement -> execute();
        $result = $statement-> fetch();
        return $result['Voorwerpnummer'];
    }

    catch(PDOException $e){
        echo $e;
    }
}

function add_auction($dbh, $titel, $beschrijving, $looptijd, $country, $city, $start_price, $payment_method, $payment_instructions, $shipment_cost, $shipment_instructions, $verkoper, $voorwerpnummer)
{
    $date_open = date('Y-m-d H:i:s');
    $date_close = date('Y-m-d H:i:s');
    try {
        $stmt = $dbh->prepare("INSERT INTO Voorwerp VALUES (:Voorwerpnummer, :titel, :beschrijving, :startprijs, :betalingswijze, :betalingsinstructie, :plaatsnaam, :land, :looptijd, :looptijdbegindag, :looptijdbegintijdstip, 
                                 :verzendkosten, :verzendinstructies, :verkoper, :koper, :looptijdeindedag, :looptijdeindetijdstip, :veilinggesloten, :verkoopprijs)");
        $stmt->execute([
            ':Voorwerpnummer' => $voorwerpnummer,
            ':titel' => $titel,
            ':beschrijving' => $beschrijving,
            ':startprijs' => $start_price,
            ':betalingswijze' => $payment_method,
            ':betalingsinstructie' => $payment_instructions,
            ':plaatsnaam' => $city,
            ':land' => $country,
            ':looptijd' => $looptijd,
            ':looptijdbegindag' => $date_open,
            ':looptijdbegintijdstip' => $date_open,
            ':verzendkosten' => $shipment_cost,
            ':verzendinstructies' => $shipment_instructions,
            ':verkoper' => $verkoper,
            ':koper' => NULL,
            ':looptijdeindedag' => date('Y-m-d H:i:s', strtotime($date_close . ' + ' . $looptijd . ' days')),
            ':looptijdeindetijdstip' => $date_close,
            ':veilinggesloten' => 0,
            ':verkoopprijs' => NULL

        ]);

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e;
    }
}

function add_auction_to_category($dbh, $voorwerpnummer, $genre){
    try{
    $stmt = $dbh -> prepare("INSERT INTO VoorwerpInRubriek VALUES (:Voorwerp, :Rubriek)");
    $stmt -> execute([
        ':Voorwerp' => $voorwerpnummer,
        ':Rubriek' => $genre
    ]);
    }
    catch (PDOException $e) {
        echo $e;
    }
}