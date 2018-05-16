<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="favicon.ico">-->

    <title>Categorie</title>
    <?php
    require_once 'partial/styles.php';

    ?>

</head>

<body>
<?php
//include_once 'partial/menu.php';
require_once 'php/database.php';
$dbh = get_db_connection();

?>

<main>
<!--    SideNavigation Bar    -->

    <?php
$sql = ("SELECT * FROM Rubriek");
$advertenties =( "select v.*, r.Rubrieknaam, r.Rubrieknummer from voorwerp v inner join VoorwerpInRubriek k
on v.Voorwerpnummer = k.Voorwerp
left join Rubriek r
on k.RubriekOpLaagsteNiveau = r.Rubrieknummer
"
);
    $query = $dbh->prepare($sql);
    $query->execute();
    $Rubriek = $query->fetchAll();


    $statement = $dbh->prepare($advertenties);
    $statement->execute ();
    $Artikelen = $statement-> fetchAll();


?>

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
                       <li> <a href="categorie.php?id=<?php echo $row ['Rubrieknaam'];?>" name="Rubriek" onclick="<?php$tellert= $row ['Rubrieknummer']; echo $tellert;?>"><?php echo $row ['Rubrieknaam'];?></a> </li>
                     <?php endforeach;?>
                     
                     
                    </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-8 main-content">
                <!--    Main content    -->
                <br><br><br>
                    <div class="row">
                        <h2>  Categorie: <?php echo $Rubriek [2]['Rubrieknaam'] ;?></h2>
                        <div class="col-12">
                            <div class="d-flex justify-content-around flex-wrap">
                                <div class="" style="background:salmon;width:200px;">altijd<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                                <div class="" style="background:salmon;width:200px;">altijd<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                                <div class="d-none d-md-block" style="background:salmon;width:200px;">tablet+<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                                <div class="d-none d-lg-block" style="background:salmon;width:200px;">laptop+<img src="images/thumb/placeholder.jpg" class="img-thumbnail"/></div>
                            </div>
                        </div>
                    </div>
                    <div class="auction-section">


    <!--    advertentie Sectie   -->

                <table style="width:100%">
                    <tr>
                        <th><p><?php echo $Artikelen [5]['Voorwerpnummer']  ?> &nbsp <?php echo $Artikelen [5]['Titel'];?></p></th>
                    </tr>
                    <tr>
                        <th><img src="images/thumb/placeholder.jpg"  class="auction-thumbnail"/></th>
                        <th><?php
                            echo htmlspecialchars($_GET["Rubrieknaam"]);
                            ?></th>
                        <th><p> Start prijs <?php echo $Artikelen [5]['Startprijs'];?></p></th>
                    </tr>
                </table>

</main>



<footer class="container rubriekfooter">
    <p>&copy; Company 2017-2018</p>
</footer>
<?php
include_once 'partial/scripts.php';
?>
</body>
</html>


                                    <!-- Expirimental Code, not applicable -->


<!--                        --><?php //foreach($Voorwerp as $key=>$value): ?>
<!--                            <div class="d-flex justify-content-around flex-wrap">-->
<!--                                <a href="veilingspagina.php?Voorwerpnummer=--><?php //echo $Voorwerp[$key] ['Voorwerpnummer'];?><!--">-->
<!--                                    <table style="width:100%">-->
<!--                                        <tr>-->
<!--                                            <th><img src="images/thumb/placeholder.jpg"  class="auction-thumbnail"/></th>-->
<!--                                            <th><p>hier kan een product naam of titel komen,maar komt hier dan ook de juiste informatie bij de afbeelding?</p></th>-->
<!--                                            <th><p> prijs €300</p></th>-->
<!--                                        </tr>-->
<!--                                    </table><img src="--><?php //echo "images/thumb/" .$Voorwerp[$key] ['image']; ?><!--" alt="--><?php //echo $Voorwerp[$key] ['image']; ?><!--"/></a>-->
<!--                            </div>-->
<!--                        --><?php //endforeach; ?>