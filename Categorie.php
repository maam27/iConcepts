<?php
require_once 'partial/page_head.php';
?>
    <title>Categorie | EenmaalAndermaal</title>
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

$sql = "SELECT * FROM Rubriek";
$query = $dbh->prepare($sql);
$query->execute();
$Rubriek = $query->fetchAll();

$query = "select v.*, r.Rubrieknaam, r.Rubrieknummer, Filenaam from voorwerp v inner join VoorwerpInRubriek k
on v.Voorwerpnummer = k.Voorwerp
left join Rubriek r
on k.RubriekOpLaagsteNiveau = r.Rubrieknummer
inner join Bestand B
on v.Voorwerpnummer = b.Voorwerp".$filter;

$statement = $dbh->query($query);
$statement->execute ();
$Artikelen = $statement-> fetchAll();
$categorie = isset($_GET['rubriek']) ? $_GET['rubriek'] : '';

?>

    <!--    SideNavigation Bar    -->
<div class="categorie-content">
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar1">

                <div class="left-navigation">
                    <ul class="list">
                        <h5><strong>filters</strong></h5>
                        <li>Prijs</li>
                        <li>Afstand</li>
                        <li>Staat</li>
                        <li>Sorteren op</li>
                    </ul>

                    <br>

                    <ul class="list">
                        <h5><strong> Alle categorieën </strong></h5>
                        <?php foreach($Rubriek as $row ):?>
                            <li> <a href="categorie.php?rubriek=<?php echo $row ['Rubrieknaam'];?>"  > <?php echo $row ['Rubrieknaam'];?></a></li>
                        <?php endforeach;?>


                    </ul>
                </div>
            </div>
        </div>

        <!--    Main content    -->
        <br><br><br>
            <div class="row">
                <h2>  Categorie: <?php echo $categorie ;?></h2>
                <div class="col-12">
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="" style="background:salmon;width:200px;">altijd<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                        <div class="" style="background:salmon;width:200px;">altijd<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                        <div class="d-none d-md-block" style="background:salmon;width:200px;">tablet+<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                        <div class="d-none d-lg-block" style="background:salmon;width:200px;">laptop+<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                    </div>
                </div>
            </div>


            <!--    advertentie Sectie   -->

        <div class="auction-section">
           <table style="width:100%">
                <?php foreach($Artikelen as $kavel ):?>
                <tr>
                    <th><p><?php echo $kavel ['Voorwerpnummer']; ?> &nbsp <?php echo $kavel['Titel'];?></p></th>
                </tr>
                <tr>
                    <th><img src="http://iproject14.icasites.nl/<?php echo get_image_path( $kavel['Filenaam'],  false);?>"  class="auction-thumbnail"/></th>

                    <th><p> Start prijs <?php echo $kavel ['Startprijs'];?></p></th>
                </tr>
                <?php endforeach; ?>
           </table>
        </div>
    </div>
</div>

</main>




<?php
require_once 'partial/page_footer.php';
include_once 'partial/scripts.php';
?>
</body>
</html>


