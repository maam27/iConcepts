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
include_once 'partial/menu.php';
?>

<main>
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
                        <li>Leeg filter</li>
                        <li>Leeg Filter</li>
                    </ul>

                    <br>

                    <ul class="list">
                        <h5><strong>Alle categorieën </strong></h5>
                        <li>categorie 1</li>
                        <li>Categorie 2</li>
                        <li>Categorie 3</li>
                        <li>Categorie 4</li>
                        <li>Categorie 5</li>
                        <li>Categorie 6</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-8 main-content">
                <!--Main content code to be written here -->
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

                                        <table style="width:100%">
                                            <tr>
                                                <th><img src="images/thumb/placeholder.jpg"  class="auction-thumbnail"/></th>
                                                <th><p>hier kan een product naam of titel komen,maar komt hier dan ook de juiste informatie bij de afbeelding?</p></th>
                                                <th><p> prijs €300</p></th>
                                            </tr>
                                        </table>

                    </div>
                </div>
            </div>



<!--        <div class="row auction-section">-->
<!--            <div class="col-sm-12 col-xl-3 col-md-5">-->
<!--               <img src="images/thumb/placeholder.jpg"  class="auction-thumbnail"/>-->
<!--            </div>-->
<!--            <div class="col-sm-12 col-xl-7 col-md-9">-->
<!--                <p>hier kan een product naam of titel komen,maar komt hier dan ook de juiste informatie bij de afbeelding?</p></div>-->
<!---->
<!--            <div class="col-xl-2 col-sm-12 col-md-6">  <p> prijs €300 </p></div>-->
<!--            </div>-->
<!--        </div>-->


<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>
<?php
include_once 'partial/scripts.php';
?>
</body>
</html>
