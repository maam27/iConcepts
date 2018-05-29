<?php
require_once 'partial/page_head.php';
require_once 'php/item_functions.php';
?>
    <title>Veilingen | EenmaalAndermaal</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';
$dbh = $db;
?>

<!--keywords-->
<?php
$filter = ' where 1 = 1';
if(isset($_GET)){
    if(isset($_GET['search'])){
        if(!empty($_GET["search"])){
            $keywords = explode(' ',$_GET['search']);
           $filter .= "and (Titel like '%".implode("%' or Titel like '%",$keywords)."%' or Beschrijving like '%".implode("%' or Beschrijving like '%",$keywords)."%')";
        }
    }
    $filter .= isset($_GET['rubriek']) ? " and Rubrieknummer = '". $_GET['rubriek']."'" : '';

}
?>
<!--end keywords-->

<main>
<!--    SideNavigation Bar    -->

<?php
$Rubriek = get_sub_categories(-1,$db);
$Artikelen = get_category_view($db,$filter);

for($i =0; $i < sizeof($Artikelen); $i++){
    $Artikelen[$i]['Beschrijving'] = str_replace("<","&lt;",$Artikelen[$i]['Beschrijving']);
    $Artikelen[$i]['Beschrijving'] = str_replace(">","&gt;",$Artikelen[$i]['Beschrijving']);
    $Artikelen[$i]['Beschrijving'] = str_replace("\"","&quot;",$Artikelen[$i]['Beschrijving']);
    $Artikelen[$i]['Beschrijving'] = str_replace("\'","&#44",$Artikelen[$i]['Beschrijving']);


    $Artikelen[$i]['Titel'] = str_replace("<","&lt;",$Artikelen[$i]['Titel']);
    $Artikelen[$i]['Titel'] = str_replace(">","&gt;",$Artikelen[$i]['Titel']);
    $Artikelen[$i]['Titel'] = str_replace("\"","&quot;",$Artikelen[$i]['Titel']);
    $Artikelen[$i]['Titel'] = str_replace("\'","&#44",$Artikelen[$i]['Titel']);
}

?>

<div class="container">
    <div class="row">
        <!-- filters-->
        <div class="col-12 col-md-3 col-xl-2 search-filters">
            <?php include_once 'partial/searchFilters.php'; ?>
        </div>
        <!-- end filters-->
        <!-- results-->
        <div class="col-12 col-md-9 col-xl-10">
            <div class="row">
                <div class="col-12">
                    <?php foreach($Artikelen as $kavel ):
                        $endDate = new DateTime($kavel['LooptijdeindeDag']." ". $kavel['LooptijdeindeTijdstip']);
                        $currentPrice = get_heighest_bid($kavel['Voorwerpnummer'],$dbh);
                        $currentPrice = ($currentPrice == 0)? $kavel['Startprijs']:$currentPrice;
                        ?>
                        <a class="hidden-link" href="Veilingspagina.php?voorwerp=<?php echo $kavel['Voorwerpnummer'] ?>">
                            <div class="row margin-top productblock-large">
                                <div class="col-3">
                                    <img src="<?php echo get_image_path( $kavel['Filenaam'],  false);?>"  class="img-fluid"/>
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-8">
                                            <strong><?php echo $kavel['Titel'];?></strong>
                                        </div>
                                        <div class="col-4">
                                            <span class="timer float-right" data-auctionEnd="<?php echo $endDate->format("Y-m-d H:i:s");  ?>"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 no-overflow">
                                            <span><?php echo $kavel['Beschrijving'];?></span>
                                        </div>
                                        <div class="col-4">
                                            <span class="float-right">€<?php echo number_format($currentPrice,2,',','.');?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
        <!-- end results-->
</div>
</main>
<script>
    $('#SearchEngine').submit(

        function(form){
            alert(this);
            form.preventDefault()
    }
    );
    </script>

<?php
require_once 'partial/page_footer.php';
include_once 'partial/scripts.php';
require_once 'partial/timer.php';
?>
