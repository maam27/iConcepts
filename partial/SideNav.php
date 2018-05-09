
<!--    SideNavigation Bar    -->

<?php
$sql = ("SELECT Rubrieknaam FROM Rubriek");

$query = $dbh->prepare($sql);
$query->execute();
$Rubriek = $query->fetchAll();

$SideNav.=<<<categorie
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
                   <?php foreach($Rubriek as $row ):?>
                        <li><a href="categorie.php?id=$row ['Rubrieknaam'];"></a></li>
                     <?php endforeach; ?>
                     
                     
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
categorie;
echo $SideNav;
?>
/**
 * Created by PhpStorm.
 * User: ryanp
 * Date: 09/05/2018
 * Time: 14:55
 */