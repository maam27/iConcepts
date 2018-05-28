<?php
require_once '../php/database.php';
$db = get_db_connection();
require_once '../php/item_functions.php';

$Rubriek = get_sub_categories($_GET['rubriek'],$db);

foreach($Rubriek as $row ):?>
    <div class="col-12 no-overflow white-text">
        <i class="fa fa-plus-square" onclick="toggleSubRubirek(this);"  data-rubriek="<?php echo $row ['Rubrieknummer']; ?>"></i>
        <a href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknummer'];?>" title="<?php echo $row['Rubrieknaam']; ?>" class="hidden-link">
            <?php echo $row ['Rubrieknaam'];?>
        </a>
    </div>
<?php endforeach;?>
