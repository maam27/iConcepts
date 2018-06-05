<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/item_functions.php';
require_once 'php/user_functions.php';
?>

    <title>Verkoper | EenmaalAndermaal</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php'; ?>

<br><br><br>

    <br>
<div class="container">
    <div class="row">
        <div class="col-12">
    <nav class="beheeromgeving">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Uitleg</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-Gebruiker" role="tab" aria-controls="nav-Gebruiker" aria-selected="false">Gebruiker</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-Veiling" role="tab" aria-controls="nav-Veiling" aria-selected="false">Veiling</a>
            <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-Verkoper" role="tab" aria-controls="nav-Verkoper" aria-selected="false">Verkoper</a>
        </div>
    </nav>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <h2 class="error-message">De beheeromgeving</h2>
            <p>Welkom administrator, op de beheeromgeving van EenmaalAndermaal.</p>
            <p class="no-margin">Op deze pagina, bent u in staat om gebruikers te blokkeren en/of verwijderen. Dit kunt u doen onder de het tabblad 'Gebruiker'.</p>
            <p class="no-margin">Dit tabblad kunt U openen, door bovenin, in het menu op 'Gebruiker' te klikken. Dit geeft de mogelijkheid om meer te doen. </p>
            <br>
            <p class="no-margin">Verder hebben we ook nog een tabblad voor de veilingen. U heeft hier de mogelijkheid om een veiling te sluiten, op basis van een veilingnummer.</p>
            <p class="no-margin"></p>
        </div>
        <div class="tab-pane fade" id="nav-Gebruiker" role="tabpanel" aria-labelledby="nav-Gebruiker-tab">
            jood
        </div>
        <div class="tab-pane fade" id="nav-Veiling" role="tabpanel" aria-labelledby="nav-Veiling-tab">
            mexicans
        </div>
        <div class="tab-pane fade" id="nav-Verkoper" role="tabpanel" aria-labelledby="nav-Verkoper-tab">
            Dit is een test.
        </div>
    </div>
</div>


<?php
require_once 'partial/page_footer.php';
?>