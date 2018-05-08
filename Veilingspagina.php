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
if($_GET['item'] == null){
    redirect('categorie.php');
}
$itemId = $_GET['item'];

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
            <div class="col-md-6 d-flex flex-column justify-content-between align-items-start">
               <div class="row">
                   <div class="col-12">
                        <img class="img-thumbnail auction-page-image" src="images/TrumpPlaceholder.jpg"> </img>
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
                    <div class="col-12 auction-section">
                        <h4> Hier komen de biedingen te staan. </h4>
                        <ul>
                            <?php
                            $bids = get_item_bids($itemId,$db);
                            print_r($bids);
                            ?>
                            <li>Bod 1 - Barry</li>
                            <li>Bod 2 - Barry</li>
                            <li>Bod 3 - Barry</li>
                            <li>Bod 4 - Barry</li>
                            <li>Bod 5 - Barry</li>
                            <li>Bod 6 - Barry</li>
                            <li>Bod 7 - Barry</li>
                            <li>Bod 8 - Barry</li>
                            <li>Bod 9 - Barry</li>
                            <li>Bod 10 - Barry</li>
                        </ul>
                        <p class="float-right"><a class="btn btn-secondary" href="#" role="button">Plaats bod &raquo;</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
</main>


<?php
    require_once 'partial/page_footer.php';
?>