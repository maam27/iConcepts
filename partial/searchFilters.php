<form method="get" action="VeilingsOverzicht.php">
    <div class="row">
        <div class="col-12">
            <h5><strong>filters</strong></h5>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <input type="text" name="filter-search" value="">
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
            </div>
        </div>
        <div class="col-12">
            <h5><strong> Rubrieken </strong></h5>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 no-overflow white-text" href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknummer'];?>"  >
                    <i class="fa fa-plus-square invisible"></i>
                    Alle categorieën
                </div>

                <?php foreach($Rubriek as $row ):?>
                    <div class="col-12 no-overflow white-text">
                    <i class="fa fa-plus-square" onclick="toggleSubRubriek(this);" data-rubriek="<?php echo $row ['Rubrieknummer']; ?>"></i>
                    <a href="VeilingsOverzicht.php?rubriek=<?php echo $row ['Rubrieknummer'];?>" title="<?php echo $row['Rubrieknaam']; ?>" class="hidden-link">
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
                if($(this).children().length > 2){
                    $(this).children().remove();
                }
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
        $(e).addClass('fa-plus-square').removeClass('fa-minus-square');
        $("div",$(e).parent()).remove();
    }

</script>