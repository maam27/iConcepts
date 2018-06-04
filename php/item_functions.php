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

function get_auctions_with_open_bid($dbh, $user){
    try{
        $statement = $dbh->prepare("select * from voorwerp where voorwerpnummer in (select DISTINCT voorwerp from bod where gebruiker=:user) AND VeilingGesloten = 0");
        $statement->execute(array(':user' => $user));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
}

function get_auctions_with_closed_bid($dbh, $user){
    try{
        $statement = $dbh->prepare("select * from voorwerp where voorwerpnummer in (select DISTINCT voorwerp from bod where gebruiker=:user) AND VeilingGesloten = 1");
        $statement->execute(array(':user' => $user));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
}

function get_sellers_auctions($dbh, $verkoper){
    try{
        $statement = $dbh->prepare("SELECT * FROM Voorwerp where Verkoper = :verkoper");
        $statement->execute(array(':verkoper' => $verkoper));
        $result = $statement->fetchall();
        return $result;
    }
    catch(PDOException $e){
        echo $e;
    }
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

function get_won_auctions($dbh, $gebruiker){
    try{
        $statement = $dbh->prepare("SELECT * FROM Voorwerp where Koper = :gebruiker AND VeilingGesloten=1");
        $statement->execute(array(':gebruiker' => $gebruiker));
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
    $query = $dbh->prepare("select Rubrieknummer, Rubrieknaam, (select count(rub.Rubrieknummer) from Rubriek rub where rub.Volgnummer = riek.Rubrieknummer) as 'subrubrieken' from Rubriek riek where riek.Volgnummer = :followNr order by riek.Rubrieknaam asc");
    $query->execute(array(':followNr' => $category));
    return $query->fetchAll();
}


function get_all_sub_categories_of($category, $dbh){
    if(!is_numeric($category)){
        return null;
    }
    $categories = array($category);
    $lowest = array($category);

    while(1==1) {
        $tmp = implode(",",$lowest);
        $query = "select Rubrieknummer from Rubriek where Volgnummer in (".$tmp.")";

        $query = $dbh->prepare($query);
        $query->execute();
        $result = $query->fetchAll();

        if(sizeof($result) <= 0 ){
            break;
        }else{
            $lowest = array();
            foreach($result as $r){
                array_push($categories, $r['Rubrieknummer']);
                array_push($lowest, $r['Rubrieknummer']);
            }
        }
    }
    return $categories;
}

function get_category_view($dbh, $filter, $pageNr, $rows = 20){
    if(!is_numeric($pageNr))
        $pageNr=1;
    if(!is_numeric($rows))
        $rows=20;
    $offset = ($pageNr-1)*$rows;

    $query = "select distinct * from Voorwerp where Voorwerpnummer in (
	select Voorwerpnummer from voorwerp v 
	inner join VoorwerpInRubriek k on v.Voorwerpnummer = k.Voorwerp
	left join Rubriek r on k.RubriekOpLaagsteNiveau = r.Rubrieknummer".$filter.") ORDER BY Voorwerpnummer asc offset ".$offset." ROWS FETCH NEXT ".$rows." ROWS ONLY ";

//    echo $query;

    $statement = $dbh->query($query);
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

    if($payment_instructions==''){
        $payment_instructions=NULL;
    }

    if($shipment_instructions==''){
        $shipment_instructions=NULL;
    }

    if($shipment_cost==0.00){
        $shipment_cost=NULL;
    }
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

function get_bottom_category($dbh){
    try{
        $stmt = $dbh -> prepare("select * from rubriek r left join rubriek k on r.Rubrieknummer = k.volgnummer 
where k.volgnummer IS NULL order by r.Rubrieknaam asc ");
        $stmt -> execute();
        $result = $stmt->fetchall();
        return $result;
    }
    catch (PDOException $e) {
        echo $e;
    }
}

function add_image_to_database($dbh, $filenaam, $voorwerpnummer){
    try{
        $stmt = $dbh -> prepare("INSERT INTO bestand VALUES (:filenaam, :voorwerpnummer)");
        $stmt -> execute([
            ':filenaam' => $filenaam,
            ':voorwerpnummer' => $voorwerpnummer
        ]);
    }
    catch (PDOException $e) {
        echo $e;
    }
}

//This function separates the extension from the rest of the file name and returns it
function get_extension($filename)
{
    $filename = strtolower($filename) ;
    $exts = explode('.', $filename);
    $n = sizeof($exts);
    $exts = $exts[$n-1];
    return $exts;
}

function add_image($inputveld_naam, $voorwerpnummer, $letter){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES[$inputveld_naam]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$inputveld_naam]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES[$inputveld_naam]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    echo print_r($_FILES);
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    }

    else {
        $extension = get_extension($target_file);
        $imageName = $voorwerpnummer.'_'.$letter.'.'. pathinfo($_FILES[$inputveld_naam]['name'], PATHINFO_EXTENSION);
        if (move_uploaded_file($_FILES[$inputveld_naam]["tmp_name"], $target_dir.$imageName)) {
            echo "The file ". $imageName. " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function get_image_name($dbh, $itemId){
    try{
        $statement = $dbh->prepare("select top 1 * from bestand  where voorwerp = :item order by filenaam");
        $statement->execute(array(':item' => $itemId));
        $result = $statement->fetch();

        return $result['Filenaam'];


    }
    catch (PDOException $e) {
        echo $e;
    }

}

function get_feedback_1($dbh, $user)
{

    try {
        $statement = $dbh->prepare("select Voorwerp, Feedbacksoort, Commentaar,  Dag, Tijdstip, Titel, Koper from feedback f left join voorwerp v on f.voorwerp = v.voorwerpnummer where soortgebruiker = 'koper' and verkoper = :gebruiker");
        $statement->execute(array(':gebruiker' => $user));
        $result = $statement->fetchall();
        return $result;
    }

    catch (PDOException $e) {
        echo $e;

    }

}

function get_feedback_2($dbh, $user){

    try {
        $statement = $dbh->prepare("select Voorwerp, Feedbacksoort, Commentaar,  Dag, Tijdstip, Titel, Verkoper  from feedback f left join voorwerp v on f.voorwerp = v.voorwerpnummer where soortgebruiker = 'verkoper' and koper=:gebruiker ");
        $statement->execute(array(':gebruiker' => $user));
        $result = $statement->fetchall();
        return $result;
    }

    catch (PDOException $e) {
        echo $e;

    }

}