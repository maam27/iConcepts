<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/item_functions.php';
require_once 'php/user_functions.php';
?>
    <title>Veilingspagina | EenmaalAndermaal</title>
</head>

<body>
<?php
include_once 'partial/menu.php';
if($_GET['voorwerp'] == null || !is_existing_product($_GET['voorwerp'], $db)){
    redirect('VeilingsOverzicht.php');
}
$itemId = $_GET['voorwerp'];
$veilinginformatie = get_seller_and_auction_info($db, $itemId);
$item = get_item($itemId,$db);
$images = get_images_for_item($itemId,$db);
$heighestBid = get_heighest_bid($itemId, $db);
$endDate = new DateTime($item['LooptijdeindeDag']." ". $item['LooptijdeindeTijdstip']);

/* place new bid*/
$errorMessage = "";
if(isset($_POST)){
    if(isset($_POST['bid'])){
        if(!user_is_logged_in()){
            redirect('login.php');
        }
        if(!is_null($_POST['bid'])){
            if($item['VeilingGesloten'] == 1){
                $errorMessage ="Deze veiling is gesloten";
            }else if(get_heighest_bidder($itemId,$db) == $_SESSION['user']){
                $errorMessage = "het is niet toegestaan uwzelf te overbieden.";
            }
            else if($_SESSION['user'] == $veilinginformatie['Gebruikersnaam']){
                $errorMessage = "U mag niet op uw eigen producten bieden.";
            }
            else if($_POST['bid'] < get_minimum_bid_increase($heighestBid) + $heighestBid) {
                $errorMessage = "U moet mininaal €". get_minimum_bid_increase($heighestBid) ." meer bieden dan het hoogste bod.";
            }
            else if(!place_bid($itemId,floor_with_precision($_POST['bid'],2),$_SESSION['user'],$db)){
                $errorMessage = "Er is iets fout gegaan tijdens het bieden, probeert u het later opnieuw";
            }
        }
    }
}
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center"><?php echo_html_safe($item['Titel']);?></h2>
        </div>
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <h3>
                            <strong>
                                <span class="timer" data-auctionEnd="<?php echo $endDate->format("Y-m-d H:i:s");  ?>"></span>
                            </strong>
                        </h3>
                    </div>
                </div>
               <div class="row margin-top">
                   <div class="col-12 d-flex justify-content-around">
                        <img id="bigImage" class="img-thumbnail margin-bottom product-image" src="<?php echo get_image_path($images[0]['filenaam'])?>"> </img>
                   </div>
                   <div class="col-12 d-flex justify-content-center margin-bottom">
                       <?php foreach($images as $img){ ?>
                            <img class="img-thumbnail miniature margin-bottom product-image" onmouseover="moveToLarge(this);" src="<?php echo get_image_path($img['filenaam'],false)?>" >
                       <?php }
                       ?>
                   </div>
                   <div class="col-12">
                        <p>
                            <strong>
<!--                                Hoofdcategory -> subcategory1 -> ... subcategory6-->
                            </strong>
                        </p>
                   </div>
                   <div class="col-12">
                        <p>
                            <strong>Veilingnummer : </strong> <?php echo $itemId ; ?>
                        </p>
                   </div>
                   <div class="col-12">
                        <p>
                            <strong>Productomschrijving :</strong><?php echo_html_safe($item['Beschrijving']); ?>
                        </p>
                   </div>
               </div>
            </div>
            <div class="col-md-6 seperator-none seperator-left-md">
                <div class="row">
                    <div class="col-12 verkoperSection margin-bottom seperator-bottom-md">
                        <h3>Verkoper: <?php echo '<a href="Verkoper.php?id='. return_html_safe($veilinginformatie['Gebruikersnaam']).'">'.return_html_safe($veilinginformatie['Gebruikersnaam']).'</a>';?></h3>
                        <p><strong>Voornaam:</strong> <?php echo_html_safe($veilinginformatie['Voornaam']); ?></p>
                        <p><strong>Achternaam:</strong> <?php echo_html_safe($veilinginformatie['Achternaam']); ?></p>
                        <p><strong>Land: </strong><?php echo_html_safe($veilinginformatie['Verkoopland']);?></p>
                        <p><strong>Plaats: </strong><?php echo_html_safe($veilinginformatie['Verkoopplaats']);?></p>
                        <p><strong>Betalingswijze: </strong><?php echo_html_safe($veilinginformatie['Betalingswijze']);?></p>
                        <?php if(!empty($veilinginformatie['Betalingsinstructie'])){
                            echo '<p><strong>Betalingsinstructie:</strong> '.return_html_safe($veilinginformatie['Betalingsinstructie']).'</p>';
                        } ?>
                        <p><strong>Gemiddelde beoordeling:</strong> <?php echo calculate_average_feedback_seller($db, $veilinginformatie['Gebruikersnaam'])?></p>
                        <a class="btn btn-primary" href="mailto:<?php echo_html_safe($veilinginformatie['Mailbox']);?>?Subject=Veiling%20<?php echo_html_safe($item['Titel']);?>">Mail de verkoper</a>
                    </div>
                    <div id="biddings" class="col-12 auction-section">
                        <div class="row">
                            <div class="col-12">
                                <h4>Meest recente biedingen: </h4>
                            </div>
                            <div class="col-12">
                            <?php
                            $bids = get_item_bids($itemId,$db);
                            if($bids != null) {
                                $minimumBid = $bids[0]['amount'] + get_minimum_bid_increase($heighestBid);
                            }
                            else{
                                $minimumBid = $item['Startprijs'];
                                echo "<div class='row'><div class='col-12'>Er zijn nog geen biedingen voor dit product.</div></div>";
                            }

                            for ($i = 0; $i < count($bids); $i++) {
                                $bodNr = $i + 1;
                                echo "<div class='row'>";
                                echo "<div class='d-none d-lg-block d-xl-block col-lg-1'>" . $bodNr . ":</div>";
                                echo "<div class='col-6 col-lg-6 no-overflow'>€" . number_format((float) $bids[$i]['amount'],2,',','.') . "</div>";
                                echo "<div class='col-6 col-lg-5 no-overflow'>" . $bids[$i]['user'] . "</div>";
                                echo "</div>";
                            }
                            ?>
                            </div>
                        </div>
                        <form method="post" target="">
                             <div class="row">
                                <div class="col-7">
                                    <input id="bid" name="bid" type="number" min="<?php echo $minimumBid;?>" value="<?php echo number_format((float) $minimumBid,2,'.','');?>" step="any"/>
                                </div>
                                <div class="col-5">
                                    <input id="placeBid" name="placeBid" type="submit" class="btn btn-secondary" value="Plaats bod &raquo;" <?php if($item['VeilingGesloten']==1) echo 'disabled';?>/>
                                </div>
                            </div>
                        </form>
                        <row>
                            <div class="col-12">
                                <p class="error-message">
                                    <?php echo $errorMessage; ?>
                                </p>
                            </div>
                        </row>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
</main>

<?php
    require_once 'partial/page_footer.php';
?>

<script src="js/img-highlight"></script>
<?php require_once 'partial/timer.php';?>