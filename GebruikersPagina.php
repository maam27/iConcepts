<?php
require_once 'partial/page_head.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
</head>

<body>
<?php
include_once 'partial/menu.php';
?>

<main>
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">[Naam van verkoper]</h2>
        </div>
    </div>
    <div class="container">
        <!-- Example row of columns -->
      <!-- --> <div class="row">
            <div class="col-md-6">
                <div class="border-veiling-preview d-flex flex-column justify-content-end align-items-center">
                    <h1> Broodjeeeeh kebab</h1>
                    <img class="img-thumbnail productThumbnail" src="images/Veilingproduct1.jpg">
                    <p class="kleineMargin"><strong>Prijs: </strong>10 euro</p>
                    <p class="kleineMargin"><strong>Categorie:</strong> Broodjes</p>
                    <p class="kleineMargin"><strong>Veiling eindigt:</strong> morgen</p>
                    </div>
                <div class="border-veiling-preview d-flex flex-column justify-content-end align-items-center">
                    <h1>Lekker fleischje</h1>
                    <img class="img-thumbnail productThumbnail" src="images/Veilingproduct2.jpg">
                    <p class="kleineMargin"><strong>Prijs: </strong>10 euro</p>
                    <p class="kleineMargin"><strong>Categorie:</strong> Broodjes</p>
                    <p class="kleineMargin"><strong>Veiling eindigt:</strong> morgen</p>
                </div>
                <div class="border-veiling-preview d-flex flex-column justify-content-end align-items-center">
                    <h1> hallal 24/7</h1>
                    <img class="img-thumbnail productThumbnail" src="images/Veilingproduct3.jpg">
                    <p class="kleineMargin"><strong>Prijs: </strong>10 euro</p>
                    <p class="kleineMargin"><strong>Categorie:</strong> Broodjes</p>
                    <p class="kleineMargin"><strong>Veiling eindigt:</strong> morgen</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container d-flex flex-column justify-content-start align-items-center">
                    <p class="timerText"> Timer in hoeveel tijd veiling eindigt</p>
                    <div class="d-flex flex-column justify-content-end verkoperSection">
                        <figure class="d-flex flex-column justify-content-between align-items-start">
                            <img class="img-thumbnail gebruikersImage" src="images/TrumpPlaceholder.jpg">
                            <p>Hier komt informatie over de ggebruiker te staan. Hij/zij kan zelf kiezen wat hier
                            komt te staan, vaak iets over de gebruiker zelf.</p>
                            <p><strong>Lid sinds</strong> : 14</p>
                            <p><strong>Gemiddelde beoordeling</strong>: 5</p>
                        </figure>

                    </div>
                    <div class="d-flex flex-column justify-content-end align-items-start auction-section">
                        <h4> Hier komen 'opmerkingen' te staan, gepost door andere gebruikers. </h4>
                        <ul>
                            <li>Super goede verkoper, echt blij mee. </li>
                            <li>-Chantal</li><br>
                            <li>Net een nieuw badpak gekocht, topkwaliteit en fijn communiceren </li>
                            <li>-Barry</li><br>
                            <li>Na lang overleggen eindelijk op een prijs uitgekomen. Wat een krent zeg die trump.
                            Maar hij maakt America wel weer groot, dus dat is wel goed.</li>
                            <li>-Kim Jong Un</li>
                        </ul>
                        <p class="align-self-end"><a class="btn btn-secondary" href="#" role="button">Plaats opmerking &raquo;</a></p>
                    </div>
                </div>
            </div>
        </div>
       <!-- -->
        <p>Hier komen advertenties.</p>
    </div> <!-- /container -->
</main>

<?php
require_once 'partial/page_footer.php';
?>