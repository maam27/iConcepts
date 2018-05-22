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

<div class="container">
    <div class="row">
        <div class="col-2" style="background-color: #F2552C;">
            <div class="row">
                <div class="col-12">
                    <h5><strong>filters</strong></h5>
                </div>
                <div class="col-12">
                    <ul class="list">
                        <li>Prijs</li>
                        <li>Afstand</li>
                        <li>Staat</li>
                        <li>Sorteren op</li>
                    </ul>
                </div>
                <div class="col-12">
                    <h5><strong> Alle categorieën </strong></h5>
                </div>
                <div class="col-12">
                    <ul class="list">
                        <?php foreach($Rubriek as $row ):?>
                            <li> <a href="categorie.php?rubriek=<?php echo $row ['Rubrieknaam'];?>"  > <?php echo $row ['Rubrieknaam'];?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>


            </div>


        </div>
        <div class="col-10">
            <div class="row">
                <?php foreach($Artikelen as $kavel ): ?>
                    <div class="col-3">
                        <img src="http://iproject14.icasites.nl/<?php echo get_image_path( $kavel['Filenaam'],  false);?>"  class="auction-thumbnail"/>
                    </div>
                <div class="col-6">
                    <p><?php echo $kavel ['Voorwerpnummer']; ?> &nbsp <?php echo $kavel['Titel'];?></p>
                </div>


                    <div class="col-3">
                        <p> Start prijs <?php echo $kavel ['Startprijs'];?></p>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</div>




    <!--    SideNavigation Bar    -->
<div class="categorie-content">
    <div class="container-fluid">


            <!--    advertentie Sectie   -->

        <div class="auction-section">
           <table style="width:100%">

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


