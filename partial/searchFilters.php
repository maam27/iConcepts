<form id="filters" method="get" action="VeilingsOverzicht.php">
    <div class="row">
        <div class="col-12">
            <h5><strong>filters</strong></h5>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    Zoek op keywords
                </div>
                <div class="col-12">
                    <input type="text" id="keywords" name="search" value="">
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
                <div class="col-12 margin-top">
                    <input type="hidden" id="rubriekFilter" name="rubriek" value="<?php echo if_set("rubriek","get")?>">
                </div>
            </div>
        </div>
        <div class="col-12">
            <h5><strong> Rubrieken </strong></h5>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 no-overflow white-text" href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknummer'];?>"  >
                    <i class="fa fa-plus-square invisible"></i>
                    <a href="VeilingsOverzicht.php?rubriek=-1" title="<?php echo $row['Rubrieknaam']; ?>" class="hidden-link rubriek">
                        Alle categorieën
                    </a>
                </div>
                <?php foreach($Rubriek as $row ):?>
                    <div class="col-12 no-overflow white-text">
                    <i class="fa fa-plus-square  <?php if($row['subrubrieken'] <=0) echo "invisible"; ?>" onclick="toggleSubRubriek(this);" data-rubriek="<?php echo $row ['Rubrieknummer']; ?>"></i>
                    <a href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknummer'];?>" title="<?php echo $row['Rubrieknaam']; ?>" class="hidden-link rubriek">
                        <?php echo $row ['Rubrieknaam'];?>
                    </a>
                 </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</form>

<script>
    function toggleSubRubriek(e){
        if($(e).parent().children().length > 2){
            hideSubCategory(e);
        } else {
            $(e).parent().siblings().each(function(){
                hideSubCategory(this);
            });
          getSubCategory(e);
        }
    }

    function getSubCategory(e){
        $rubrieknr = $(e).data('rubriek');
        $url = "partial/sub-rubrieken.php?rubriek="+$rubrieknr;

        $.ajax({
            type: 'get',
            url: $url,
            success: function (data) {
                $(e).removeClass('fa-plus-square').addClass('fa-minus-square');
                if(data.length <=0){
                    $(e).addClass('invisible');
                }
                $(e).parent().append(data);
            }
        });
    }

    function hideSubCategory(e){
        if($(e).is("i")){
            $(e).addClass('fa-plus-square').removeClass('fa-minus-square');
        }else{
            $(e).find("i").addClass('fa-plus-square').removeClass('fa-minus-square');
        }
        $("div.row",$(e).parent()).remove();
    }
</script>