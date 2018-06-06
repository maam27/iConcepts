
<!-- https://stackoverflow.com/questions/27546071/how-to-toggle-div-visibility-using-radio-buttons -->
<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/item_functions.php';
require_once 'php/user_functions.php';
?>

    <title>Beheeromgeving | EenmaalAndermaal</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';

if (isset($_POST['beheertype'])) {
    switch ($_POST['beheertype']) {
        case 'Gebruiker':
            if ($_POST['Actie'] == 'Blokkeren') {
                if (block_user($db, $_POST['Gebruikersnaam'])) {
                    redirect('beheeromgeving.php?succes1=true');
                }
                else{
                    redirect('beheeromgeving.php?succes1=false');
                }
            }
            else if ($_POST['Actie'] == 'Deblokkeren') {
                if (unblock_user($db, $_POST['Gebruikersnaam'])) {
                    redirect('beheeromgeving.php?succes1=true');
                }
                else{
                    redirect('beheeromgeving.php?succes1=false');
                }
            }
            break;
        case 'Veiling':
            if(verwijder_veiling($db, $_POST['Voorwerpnummer'])){
                redirect('beheeromgeving.php?succes2=true');
            }
            else{
                redirect('beheeromgeving.php?succes2=false');
            }
            break;
    }
}

if($_SESSION['user']=='Admin'){
if (isset($_GET['succes1']) and $_GET['succes1'] == 'true') { ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">Het is gelukt!</h2>
                <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te voeren.</p>
            </div>
        </div>
    </main>
    <?php
} else if (isset($_GET['succes1']) and $_GET['succes1']=='false') {
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">Er is iets fout gegaan!</h2>
                <p class="text-center">U probeert een gebruiker te blokkeren die niet bestaat (of de admin).</p>
                <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te voeren.</p>
            </div>
        </div>
    </main>
<?php
}
else if(isset($_GET['succes2']) and $_GET['succes2']=='true'){
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">De veiling is verwijdert!</h2>
                <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te voeren.</p>
            </div>
        </div>
    </main>
    <?php
}

else if(isset($_GET['succes2']) AND $_GET['succes2'] == 'false'){
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">Er is iets fout gegaan!</h2>
                <p class="text-center">U probeert een veiling te verwijderen die niet bestaat.</p>
                <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te voeren.</p>
            </div>
        </div>
    </main>
    <?php
}

else{
    ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="beheeromgeving">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center nav nav-tabs"
                             id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                               role="tab" aria-controls="nav-home" aria-selected="true">Uitleg</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-Gebruiker"
                               role="tab" aria-controls="nav-Gebruiker" aria-selected="false">Gebruiker</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-Veiling"
                               role="tab" aria-controls="nav-Veiling" aria-selected="false">Veiling</a>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <h2 class="error-message">De beheeromgeving</h2>
                    <p>Welkom administrator, op de beheeromgeving van EenmaalAndermaal.</p>
                    <p class="no-margin">Op deze pagina, bent u in staat om gebruikers te blokkeren en/of verwijderen.
                        Dit kunt u doen onder de het tabblad 'Gebruiker'.</p>
                    <p class="no-margin">Dit tabblad kunt U openen, door bovenin, in het menu op 'Gebruiker' te klikken.
                        Dit geeft de mogelijkheid om meer te doen. </p>
                    <br>
                    <p class="no-margin">Verder hebben we ook nog een tabblad voor de veilingen. U heeft hier de
                        mogelijkheid om een veiling te sluiten, op basis van een veilingnummer.</p>
                    <p class="no-margin">U hoeft hiervoor enkel een veilingsnummer te weten.</p>
                    <br>
                    <p class="margin-bottom no-margin">Ten slotte hebben we nog een verkoper tabblad. In dit tabblad
                        kunt U de verkoperstatus van een gebruiker ontnemen.</p>
                    <br>
                </div>
                <div class="tab-pane fade" id="nav-Gebruiker" role="tabpanel" aria-labelledby="nav-Gebruiker-tab">
                    <h2 class="error-message">Gebruiker (de)blokkeren</h2>
                    <p>Op deze pagina kunt U een gebruiker blokkeren</p>

                    <p> Vul in het onderstaande formulier een gebruikersnaam in, en kies of U de gebruiker wilt
                        blokkeren, of deblokkeren.</p>

                    <div class="register-section">
                        <form method="Post" action="#" class="col-6">
                            <label for="Gebruikersnaam"><strong>Gebruikersnaam</strong></label>
                            <input id="Gebruikersnaam" name="Gebruikersnaam" type="text" pattern="([^<>])+"
                                   placeholder="Gebruikersnaam" maxlength="100" required>
                            <br> <label for="Actie">Wat wilt U hiermee doen?</label><br>
                            <select id="Actie" name="Actie">
                                <option value="Blokkeren">Blokkeren</option>
                                <option value="Deblokkeren">Deblokkeren</option>
                            </select>
                            <input id="beheertype" name="beheertype" type="hidden" required
                                   value="Gebruiker">
                            <br>
                            <button class="btn btn-primary" type="submit">Wijzig status</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-Veiling" role="tabpanel" aria-labelledby="nav-Veiling-tab">
                    <h2 class="error-message">Veiling verwijderen</h2>
                    <p>Op deze pagina kunt U een veiling verwijderen.</p>

                    <p> Vul in het onderstaande formulier het betreffende nummer in.</p>

                    <div class="register-section">
                        <form method="Post" action="#" class="col-6">
                            <label for="Voorwerpnummer"><strong>Voorwerpnummer</strong></label>
                            <input id="Voorwerpnummer" name="Voorwerpnummer" type="text" pattern="([^<>])+"
                                   placeholder="Voorwerpnummer" maxlength="100" required>
                            <input id="beheertype" name="beheertype" type="hidden" required
                                   value="Veiling">
                            <button class="btn btn-primary" type="submit">Verwijder veiling</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
}
}
else{
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U zit niet op een juist account!</h2>
                <p class="text-center">Daarom mag u deze pagina niet gebruiken.</p>
            </div>
        </div>
    </main>
<?php
}
require_once 'partial/page_footer.php';
?>