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
            $filter .= " and (Titel like '%".implode("%' or Titel like '%",$keywords)."%')";// or Beschrijving like '%".implode("%' or Beschrijving like '%",$keywords)."%')";
        }
    }
    if(isset($_GET['rubriek'])){
        if(!empty($_GET['rubriek'])) {
            $tmp = implode(",", get_all_sub_categories_of($_GET["rubriek"], $db));
            $filter .= " and Rubrieknummer in (" . $tmp . ")";
        }
    }

    if(isset($_GET['minValue'])||isset($_GET['maxValue'])) {
        $minval = 0;
        $maxval = 99999999999;
        if (isset($_GET['minValue'])) {
            if (is_numeric($_GET['minValue'])) {
                $minval = $_GET['minValue'];
            }
        }
        if (isset($_GET['maxValue'])) {
            if (is_numeric($_GET['maxValue'])) {
                $maxval = $_GET['maxValue'];
            }
        }
        $filter .= " and
        CASE WHEN EXISTS (SELECT * FROM Bod WHERE Voorwerp = Voorwerpnummer) THEN
            (SELECT top 1 Bodbedrag FROM Bod WHERE Voorwerp = Voorwerpnummer order by Bodbedrag desc)
        ELSE
            Startprijs
        END
        between ".$minval." and ".$maxval;
    }
}
?>
<!--end keywords-->

<main>
<!--    SideNavigation Bar    -->

<?php
$rows_per_page = 20;
$Rubriek = get_sub_categories(-1,$db);
$page = 1;
if (isset($_GET['page'])) {
   $page = $_GET['page'];

}
$order = "order by LooptijdbeginDag desc, LooptijdbeginTijdstip desc";
$Artikelen = get_category_view($db,$filter,$order,$page);
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
                                <h2>Er zijn geen artikelen gevonden.</h2>
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
                                        <img src="<?php echo get_image_path($imgname,false); ?>" class="img-fluid" />
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-8">
                                                <strong><?php echo_html_safe($kavel['Titel']); ?></strong>
                                            </div>
                                            <div class="col-4">
                                                <span class="timer float-right"
                                                      data-auctionEnd="<?php echo $endDate->format("Y-m-d H:i:s"); ?>"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 no-overflow">
                                                <span><?php echo_html_safe($kavel['Beschrijving']); ?></span>
                                            </div>
                                            <div class="col-4">
                                                <span class="float-right">€<?php echo number_format($currentPrice, 2, ',', '.'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <hr>
                        <?php endforeach;
                    }?>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <?php
                                $currentUrl = basename($_SERVER['REQUEST_URI']);;
                                $currentFilter = preg_replace('%.*?\?%','',$currentUrl,1);
                                $currentFilterPageless = "&". preg_replace('%page=\d*&?%','',$currentFilter,1);
                                $currentPage=1;
                                if( isset($_GET['page'])){
                                    if(!empty($_GET['page'])){
                                        if(is_numeric($_GET['page'])){
                                        $currentPage = $_GET['page'];
                                        }
                                    }
                                }
                                $showPagination = 3;
                                $totalPages = get_NPages($dbh, $filter, $rows_per_page);
                                 $minPage = ($currentPage-$showPagination>=1)?$currentPage-$showPagination:1;
                                 $maxPage = ($currentPage+$showPagination<=$totalPages)?$currentPage+$showPagination:$totalPages;
                            ?>
                            <ul class="pagination">
                                <?php
                                if ($minPage != 1) {
                                    echo "<li class='page-item'><a class='page-link' href='VeilingsOverzicht.php?page=". 1 . $currentFilterPageless . "'>First page</a></li>";
                                }
                                for($i=$minPage; $i<=$maxPage; $i++) {
                                    echo "<li class='page-item'><a class='page-link' href='VeilingsOverzicht.php?page=".$i . $currentFilterPageless."'>$i</a></li>";
                                }
                                if ($maxPage != $totalPages) {
                                    echo "<li class='page-item'><a class='page-link' href='VeilingsOverzicht.php?page=". $totalPages . $currentFilterPageless . "'>Last Page</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

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