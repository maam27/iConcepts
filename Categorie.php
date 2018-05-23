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
                <div class="col-12">
                    <?php foreach($Artikelen as $kavel ): ?>
                        <div class="row margin-top productblock-large">
                            <div class="col-3">
                                <img src="http://iproject14.icasites.nl/<?php echo get_image_path( $kavel['Filenaam'],  false);?>"  class="img-fluid"/>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-8">
                                        <strong><?php echo $kavel['Titel'];?></strong>
                                    </div>
                                    <div class="col-4">
                                        <span class="timer float-right" data-auctionEnd="<?php echo $kavel['LooptijdeindeDag']." ". $kavel['LooptijdeindeTijdstip']; ?>">00:00:00 resterend</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 no-overflow">
                                        <?php echo $kavel['Beschrijving'];?></p>
                                    </div>
                                    <div class="col-4">
                                        <span class="float-right">prijs <?php echo $kavel ['Startprijs'];?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
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

<script>
    window.setInterval(function(){
        $(".timer").each(function(){
            $endTime = new Date($(this).data('auctionend'));
            //some have a diffrent timezone, thus lasting 1 hour longer/shorter
            $currentTime = new Date($.now());
            $timeDiffrence = $endTime - $currentTime;

            if ($timeDiffrence <= 0) {
                $(this).text("Verlopen");
                $(this).removeClass( "timer" )
            }
            else {
                $sec = Math.floor($timeDiffrence / 1000);
                $min = Math.floor($sec / 60);
                $hour = Math.floor($min / 60);
                $days = Math.floor($hour / 24);

                $hour %= 24;
                $min %= 60;
                $sec %= 60;

                uren = ("0" + $hour).slice(-2);
                minuten = ("0" + $min).slice(-2);
                $sec = ("0" + $sec).slice(-2);

                if($days >= 2){
                    $(this).text($days + " dagen");
                }else {
                    $(this).text(($days * 24 + $hour) + ":" + $min + ":" + $sec);
                }
            }
                //eind test
        });

    }, 1000);
</script>