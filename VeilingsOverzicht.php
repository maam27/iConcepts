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
$filter = ' where VeilingGesloten = 0';
if(isset($_GET)){
    if(isset($_GET['search'])){
        if(!empty($_GET["search"])){
            $keywords = explode(' ',$_GET['search']);
           $filter .= " and (Titel like '%".implode("%' or Titel like '%",$keywords)."%' or Beschrijving like '%".implode("%' or Beschrijving like '%",$keywords)."%')";
        }
    }
    if(isset($_GET['rubriek'])){
        if(!empty($_GET['rubriek'])) {
            $tmp = implode(",", get_all_sub_categories_of($_GET["rubriek"], $db));
            $filter .= " and Rubrieknummer in (" . $tmp . ")";
        }
    }

}
?>
<!--end keywords-->

<main>
<!--    SideNavigation Bar    -->

<?php
$Rubriek = get_sub_categories(-1,$db);
$Artikelen = get_category_view($db,$filter);

//for($i =0; $i < sizeof($Artikelen); $i++){
//    $Artikelen[$i]['Beschrijving'] = str_replace("<","&lt;",$Artikelen[$i]['Beschrijving']);
//    $Artikelen[$i]['Beschrijving'] = str_replace(">","&gt;",$Artikelen[$i]['Beschrijving']);
//    $Artikelen[$i]['Beschrijving'] = str_replace("\"","&quot;",$Artikelen[$i]['Beschrijving']);
//    $Artikelen[$i]['Beschrijving'] = str_replace("\'","&#44",$Artikelen[$i]['Beschrijving']);
//
//    $Artikelen[$i]['Titel'] = str_replace("<","&lt;",$Artikelen[$i]['Titel']);
//    $Artikelen[$i]['Titel'] = str_replace(">","&gt;",$Artikelen[$i]['Titel']);
//    $Artikelen[$i]['Titel'] = str_replace("\"","&quot;",$Artikelen[$i]['Titel']);
//    $Artikelen[$i]['Titel'] = str_replace("\'","&#44",$Artikelen[$i]['Titel']);
//}

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
                    <?php
                    if(sizeof($Artikelen) <= 0){?>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center margin-top">
                                <h2>Er zijn geen artiekelen gevonden.</h2>
                            </div>
                        </div>
                    <?php } else
                    {

                        foreach ($Artikelen as $kavel):
                            $endDate = new DateTime($kavel['LooptijdeindeDag'] . " " . $kavel['LooptijdeindeTijdstip']);
                            $currentPrice = get_heighest_bid($kavel['Voorwerpnummer'], $dbh);
                            $currentPrice = ($currentPrice == 0) ? $kavel['Startprijs'] : $currentPrice;
                            ?>
                            <a class="hidden-link"
                               href="Veilingspagina.php?voorwerp=<?php echo $kavel['Voorwerpnummer'] ?>">
                                <div class="row margin-top productblock-large">
                                    <div class="col-3">
                                        <?php
                                        $img = get_images_for_item($kavel['Voorwerpnummer'],$db);
                                        $imgname = (!empty($img))? $imgname = $img[0]['filenaam']: $imgname = "";
                                        ?>
                                        <img src="<?php echo get_image_path($imgname,false); ?>"
                                             class="img-fluid"/>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-8">
                                                <strong><?php echo $kavel['Titel']; ?></strong>
                                            </div>
                                            <div class="col-4">
                                                <span class="timer float-right"
                                                      data-auctionEnd="<?php echo $endDate->format("Y-m-d H:i:s"); ?>"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 no-overflow">
                                                <span><?php echo $kavel['Beschrijving']; ?></span>
                                            </div>
                                            <div class="col-4">
                                                <span class="float-right">€<?php echo number_format($currentPrice, 2, ',', '.'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach;
                    }?>
                </div>
            </div>
        </div>
    </div>
        <!-- end results-->
</div>
</main>


<?php
require_once 'partial/page_footer.php';
include_once 'partial/scripts.php';
require_once 'partial/timer.php';
?>

<script>
    $("#SearchEngine").submit(
        function(form){
            form.preventDefault();
            $value = $("#search").val();
           $filters = $("#filters");
           $filters.find("#keywords").val($value);
            $($filters).submit();
        }
    );
</script>