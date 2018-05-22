<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/item_functions.php';
require_once 'php/user_functions.php';
?>
<title>Veilingspagina | EenmaalAndermaal</title>
</head>

<body>
<?php
include_once 'partial/menu.php';
?>

<?php
if (isset($_GET['validatiecode']) AND empty($_SESSION['user'])) {
    if (check_for_validatiecode($db, $_GET['validatiecode'])) {
        if (is_validation_in_time($db, $_GET['validatiecode'])) {
            ?>
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 user-section d-flex align-items-center flex-column">
                            <h2 class="error-message text-center">De bevestiging is succesvol verlopen.</h2>
                            <?php
                            $aanvraag_gegevens = get_gegevens_registratieaanvraag($db, $_GET['validatiecode']);
                            register_user($db, $aanvraag_gegevens['Gebruikersnaam'], $aanvraag_gegevens['Voornaam'], $aanvraag_gegevens['Achternaam'], $aanvraag_gegevens['Adresregel1'], $aanvraag_gegevens['Adresregel2'], $aanvraag_gegevens['Postcode'], $aanvraag_gegevens['Plaatsnaam'], $aanvraag_gegevens['Land'], $aanvraag_gegevens['GeboorteDag'], $aanvraag_gegevens['Mailbox'], $aanvraag_gegevens['Wachtwoord'], $aanvraag_gegevens['Vraag'], $aanvraag_gegevens['Antwoordtekst'], $_GET['validatiecode']) ?>
                        </div>
                    </div>
                </div> <!-- /container -->
            </main>
            <?php
        } else {
            ?>
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 user-section d-flex align-items-center flex-column">
                            <h2 class="error-message text-center">U heeft te lang gedaan over het activeren van U account.</h2>
                            <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
                        </div>
                    </div>
                </div> <!-- /container -->
            </main>
            <?php
        }

        ?>

    <?php } else {
        ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 user-section d-flex align-items-center flex-column">
                        <h2 class="error-message text-center">U heeft een onjuiste link gevolgd</h2>
                        <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
                    </div>
                </div>
            </div> <!-- /container -->
        </main>
        <?php
    }
} else if (isset($_SESSION['user'])) {
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 user-section d-flex align-items-center flex-column">
                    <h2 class="error-message text-center">U bent al ingelogd.</h2>
                    <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
                </div>
            </div>
        </div> <!-- /container -->
    </main>
<?php } else { ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 user-section d-flex align-items-center flex-column">
                    <h2 class="error-message text-center">Er is iets fout gegaan</h2>
                    <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
                </div>
            </div>
        </div> <!-- /container -->
    </main>

    <?php
}
?>
<?php
require_once 'partial/page_footer.php';
?>

<script src="js/img-highlight"></script>

