<?php
require_once '../php/database.php';
$db = get_db_connection();
require_once '../php/item_functions.php';

$Rubriek = get_sub_categories($_GET['rubriek'],$db);

if(sizeof($Rubriek)) { ?>
    <div class="row sub-categorie">
        <?php
        foreach ($Rubriek as $row):?>
            <div class="col-12 no-overflow white-text">
                <i class="fa fa-plus-square cursor-pointer <?php if($row['subrubrieken'] <=0) echo "invisible"; ?>" onclick="toggleSubRubriek(this);"
                   data-rubriek="<?php echo $row ['Rubrieknummer']; ?>"></i>
                <a href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknummer']; ?>"
                   title="<?php echo $row['Rubrieknaam']; ?>" class="hidden-link rubriek">
                    <?php echo $row ['Rubrieknaam']; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}
?>