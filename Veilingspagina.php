<?
require_once 'partial/page_head.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
    <?php
        require_once 'partial/styles.php';
    ?>
</head>

<body>
<?php
include_once 'partial/menu.php';
?>

<main>
<br><br>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">[Naam van wat er wordt geveildtdt]</h2>
        </div>
    </div>
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-6">
                <figure class="d-flex flex-column justify-content-between align-items-start">
                    <img class="img-thumbnail auction-page-image" src="images/TrumpPlaceholder.jpg"> </img>
                    <p>Hier komt de productsomschrijving te staan, dit kan natuurlijk een heel lang verhaal zijn. Daarom moet je
                        er goed voor zorgen dat je de breedte aan laat passen. Want voor je het weet heb je een hele muur aan text,
                        en verandert de pagina niet goed mee. Dat zou zeer jammer zijn, en daarom proberen we dit ook te
                        voorkomen, zodat de pagina er leuk uitziet.</p>
                    <p><strong>Veilingnummer</strong> : 14</p>
                    <p>Hoofdcategory -> subcategory1 -> ... subcategory6</p>
                </figure>
            </div>
            <div class="col-md-6">
                <div class="container d-flex flex-column justify-content-start align-items-center">
                    <p class="timerText"> Timer in hoeveel tijd veiling eindigt</p>
                    <div class="d-flex flex-column justify-content-end verkoperSection">
                        <h4> Hier komt informatie over de verkoper</h4>
                        <p> En hier komt text te staan over de verkoper</p>
                        <p> Bestaand uit verschillende zinnen.</p>
                        <p>Ook komen er bepaalde attributen te staan.</p>
                    </div>
                    <div class="d-flex flex-column justify-content-end align-items-start auction-section">
                        <h4> Hier komen de biedingen te staan. </h4>
                        <ul>
                            <li>Bod 1 - Barry</li>
                            <li>Bod 2 - Barry</li>
                            <li>Bod 3 - Barry</li>
                            <li>Bod 4 - Barry</li>
                            <li>Bod 5 - Barry</li>
                            <li>Bod 6 - Barry</li>
                            <li>Bod 7 - Barry</li>
                            <li>Bod 8 - Barry</li>
                            <li>Bod 9 - Barry</li>
                            <li>Bod 10 - Barry</li>
                        </ul>
                        <p class="align-self-end"><a class="btn btn-secondary" href="#" role="button">Plaats bod &raquo;</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
</main>

<?
require_once 'partial/page_footer.php';
?>