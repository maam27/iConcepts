<?php
require_once 'partial/page_head.php';
require_once 'php/item_functions.php';
?>
    <title>Veilingen | EenmaalAndermaal</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';
?>

<?php
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
    $filter .= isset($_GET['rubriek']) ? " and Rubrieknaam = '". $_GET['rubriek']."'" : '';


}
?>
<!--end keywords-->

<main>

<!--    SideNavigation Bar    -->

<?php


$Rubriek = get_catagory($db);

$query = "select v.*, r.Rubrieknaam, r.Rubrieknummer, Filenaam from voorwerp v inner join VoorwerpInRubriek k
on v.Voorwerpnummer = k.Voorwerp
left join Rubriek r
on k.RubriekOpLaagsteNiveau = r.Rubrieknummer
inner join Bestand B
on v.Voorwerpnummer = b.Voorwerp".$filter;

$statement = $dbh->query($query);
$statement->execute ();
$Artikelen = $statement-> fetchAll();
//$categorie = isset($_GET['rubriek']) ? $_GET['rubriek'] : '';

?>

<div class="container">
    <div class="row">
        <!-- filters-->
        <div class="col-12 col-md-3 col-xl-2 search-filters">
            <form method="get" action="VeilingsOverzicht.php">
                <div class="row">
                <div class="col-12">
                    <h5><strong>filters</strong></h5>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="filter-search" value="">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    Prijs
                                </div>
                                <div class="col-5 col-md-12">
                                    <input type="number" name="minValue" value="">
                                </div>
                                <div class="col-2 col-md-12">
                                    tot
                                </div>
                                <div class="col-5 col-md-12">
                                    <input type="number" name="maxValue" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-none">
                            afstand
                        </div>
                        <div class="col-12 d-none">
                            resterende tijd
                        </div>
                        <div class="col-12 margin-top">
                            <input type="submit" value="Zoeken">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h5><strong> Alle categorieën </strong></h5>
                </div>
                <div class="col-12">
                    <ul class="list sidebar">
                        <?php foreach($Rubriek as $row ):?>
                            <li> <a href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknaam'];?>"  > <?php echo $row ['Rubrieknaam'];?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            </form>
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
                                    <img src="http://iproject14.icasites.nl/<?php echo get_image_path( $kavel['Filenaam'],  false);?>"  class="img-fluid"/>
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
                                            <?php echo $kavel['Beschrijving'];?>
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
        <!-- end results-->
    </div>
</div>
</main>

<?php
require_once 'partial/page_footer.php';
include_once 'partial/scripts.php';
require_once 'partial/timer.php';
?>
