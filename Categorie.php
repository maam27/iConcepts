<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="favicon.ico">-->

    <title>Categorie | EenmaalAndermaal</title>
    <?php
    require_once 'partial/styles.php';
    ?>

</head>

<body>
<?php
include_once 'partial/menu.php';

$Rubriek = isset($_GET['Rubrieknaam']) ? $_GET['Rubrieknaam'] : '';
?>

<main>
<!--    SideNavigation Bar    -->

    <?php
    $query = $db->prepare("SELECT [rubrieknaam] FROM Rubriek ");
    $query->execute(array(':rubrieknaam' => $Rubriek));
    $result = $query->fetch();

    $Categorie.=<<<rubriek
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
                    <h5><strong>Alle categorieën </strong></h5>
                   <?php foreach($Rubriek as $key=>$value){
                        <li><a href="categorie.php?id=$Rubriek[$key] ['Rubrieknaam'];"></a></li>
                     } 
                     
                    </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-8 main-content">
                <!--    Main content    -->
                <br><br><br>
                    <div class="row">
                        <h2>Categorie: TRUMP</h2>
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
rubriek;
    echo $Categorie;
?>

    <!--    advertentie Sectie   -->

                <table style="width:100%">
                    <tr>
                        <th><img src="images/thumb/placeholder.jpg"  class="auction-thumbnail"/></th>
                        <th><p>hier kan een product naam of titel komen,maar komt hier dan ook de juiste informatie bij de afbeelding?</p></th>
                        <th><p> prijs €300</p></th>
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