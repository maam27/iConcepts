<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/item_functions.php';
?>
    <title></title>
</head>

<body>
<?php
include_once 'partial/menu.php';
if($_GET['voorwerp'] == null || !is_existing_product($_GET['voorwerp'], $db)){
    redirect('categorie.php');
}
$itemId = $_GET['voorwerp'];

if(isset($_POST)){
    if(isset($_POST['bid'])){
        if(!is_null($_POST['bid'])){
            if($_POST['bid'] >= get_minimum_bid_increase() + get_heighest_bid($itemId, $db)){
                if(place_bid($itemId,$_POST['bid'],$_SESSION['user'],$db)){

                }
            }
        }
    }
}
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center"><?php echo get_item_name($itemId, $db);?></h2>
        </div>
    </div>
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-6">
               <div class="row">
                   <div class="col-12">
                        <img class="img-thumbnail margin-bottom" src="images/TrumpPlaceholder.jpg"> </img>
                   </div>
                   <div class="col-12">
                        <p>
                            <strong>Hoofdcategory -> subcategory1 -> ... subcategory6</strong>
                        </p>
                   </div>
                   <div class="col-12">
                        <p>
                            <strong>Veilingnummer :</strong> <?php echo $itemId; ?>
                        </p>
                   </div>
                   <div class="col-12">
                        <p>
                            <strong>Productomschrijving :</strong><?php echo get_item_description($itemId, $db); ?>
                        </p>
                   </div>
               </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12">
                        <p class="timerText"> Timer in hoeveel tijd veiling eindigt</p>
                    </div>
                    <div class="col-12 verkoperSection">
                        <h4> Hier komt informatie over de verkoper</h4>
                        <p> En hier komt text te staan over de verkoper</p>
                        <p> Bestaand uit verschillende zinnen.</p>
                        <p>Ook komen er bepaalde attributen te staan.</p>
                    </div>
                    <div id="biddings" class="col-12 auction-section">
                        <div class="row">
                            <div class="col-12">
                                <h4> Hier komen de biedingen te staan. </h4>
                            </div>
                            <div class="col-12">
                            <?php
                            $bids = get_item_bids($itemId,$db);
                            $minimumBid = $bids[0]['amount'] + get_minimum_bid_increase();
                            for($i =0; $i< count($bids);$i++){
                                $bodNr = $i+1;
                                echo "<div class='row'>";
                                echo "<div class='col-4 col-sm-3'> bod ". $bodNr ." :</div>";
                                echo "<div class='col-4 '>". $bids[$i]['amount']. "</div>";
                                echo "<div class='col-4 col-sm-5'>". $bids[$i]['user']. "</div>";
                                echo "</div>";
                            }
                            ?>
                            </div>
                        </div>
                        <form method="post" target="">
                             <div class="row">
                                <div class="col-7">
                                    <input id="bid" name="bid" type="number" min="<?php echo $minimumBid;?>" value="<?php echo $minimumBid;?>" step="any"/>
                                </div>
                                <div class="col-5">
                                    <input id="placeBid" name="placeBid" type="submit" class="btn btn-secondary" value="Plaats bod &raquo;"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
</main>


<?php
    require_once 'partial/page_footer.php';
?>