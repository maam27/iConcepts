
<!--    SideNavigation Bar    -->
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
                        <li> <a href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknaam'];?>"  > <?php echo $row ['Rubrieknaam'];?></a></li>
                    <?php endforeach;?>


                </ul>
            </div>
        </div>