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
$legecategorieën = get_empty_category($db);
$categorieën = get_bottom_category($db);

if (isset($_POST['beheertype'])) {
    switch ($_POST['beheertype']) {
        case 'Gebruiker':
            if ($_POST['Actie'] == 'Blokkeren') {
                if (block_user($db, $_POST['Gebruikersnaam'])) {
                    redirect('beheeromgeving.php?succes1=true');
                } else {
                    redirect('beheeromgeving.php?succes1=false');
                }
            } else if ($_POST['Actie'] == 'Deblokkeren') {
                if (unblock_user($db, $_POST['Gebruikersnaam'])) {
                    redirect('beheeromgeving.php?succes1=true');
                } else {
                    redirect('beheeromgeving.php?succes1=false');
                }
            }
            break;
        case 'Veiling':
            if (verwijder_veiling($db, $_POST['Voorwerpnummer'])) {
                redirect('beheeromgeving.php?succes2=true');
            } else {
                redirect('beheeromgeving.php?succes2=false');
            }
            break;
        case 'Rubriek-toevoegen':
            if(add_category($db, $_POST['Rubrieknaam'], $_POST['Parentrubriek'])){
                redirect('beheeromgeving.php?succes3=true');
            }
            else{
                redirect('beheeromgeving.php?succes3=false');
            }
            break;
        case 'Rubriek-uitfaseren':
            if(fase_out_category($db, $_POST['Rubrieknaam'])){
                redirect('beheeromgeving.php?succes3=true');
            }
            else{
                redirect('beheeromgeving.php?succes3=false');
            }
            break;
        case 'Rubriek-hernoemen':
            if(rename_category($db, $_POST['Rubrieknaam'], $_POST['nieuwe-naam'])){
                redirect('beheeromgeving.php?succes3=true');
            }
            else{
                redirect('beheeromgeving.php?succes3=false');
            }
            break;
        case 'Rubriek-verwijderen':
            if(delete_category($db, $_POST['Rubrieknaam'])){
                redirect('beheeromgeving.php?succes3=true');
            }
            else{
                redirect('beheeromgeving.php?succes3=false');
            }

    }
}

if ($_SESSION['user'] == 'Admin') {
    if (isset($_GET['succes1']) and $_GET['succes1'] == 'true') { ?>
        <main>
            <div class="container error-box d-flex flex-row justify-content-center align-items-center">
                <div>
                    <h2 class="error-message text-center">Het is gelukt!</h2>
                    <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te
                        voeren.</p>
                </div>
            </div>
        </main>
        <?php
    } else if (isset($_GET['succes1']) and $_GET['succes1'] == 'false') {
        ?>
        <main>
            <div class="container error-box d-flex flex-row justify-content-center align-items-center">
                <div>
                    <h2 class="error-message text-center">Er is iets fout gegaan!</h2>
                    <p class="text-center">U probeert een gebruiker te blokkeren die niet bestaat (of de admin).</p>
                    <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te
                        voeren.</p>
                </div>
            </div>
        </main>
        <?php
    } else if (isset($_GET['succes2']) and $_GET['succes2'] == 'true') {
        ?>
        <main>
            <div class="container error-box d-flex flex-row justify-content-center align-items-center">
                <div>
                    <h2 class="error-message text-center">De veiling is verwijdert!</h2>
                    <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te
                        voeren.</p>
                </div>
            </div>
        </main>
        <?php
    } else if (isset($_GET['succes2']) AND $_GET['succes2'] == 'false') {
        ?>
        <main>
            <div class="container error-box d-flex flex-row justify-content-center align-items-center">
                <div>
                    <h2 class="error-message text-center">Er is iets fout gegaan!</h2>
                    <p class="text-center">U probeert een veiling te verwijderen die niet bestaat.</p>
                    <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te
                        voeren.</p>
                </div>
            </div>
        </main>
        <?php
    } else if (isset($_GET['succes3']) and $_GET['succes3'] == 'true') {
        ?>
        <main>
            <div class="container error-box d-flex flex-row justify-content-center align-items-center">
                <div>
                    <h2 class="error-message text-center">Uw verandering aan de rubrieken is geslaagd!</h2>
                    <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te
                        voeren.</p>
                </div>
            </div>
        </main>
        <?php
    } else if (isset($_GET['succes3']) AND $_GET['succes3'] == 'false') {
        ?>
        <main>
            <div class="container error-box d-flex flex-row justify-content-center align-items-center">
                <div>
                    <h2 class="error-message text-center">Er is iets fout gegaan!</h2>
                    <p class="text-center">Klikt u <a href="beheeromgeving.php">hier</a> om meer beheerdersacties uit te
                        voeren.</p>
                </div>
            </div>
        </main>
        <?php
    } else {
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
                                <a class="nav-item nav-link" id="nav-gebruiker-tab" data-toggle="tab"
                                   href="#nav-Gebruiker"
                                   role="tab" aria-controls="nav-Gebruiker" aria-selected="false">Gebruiker</a>
                                <a class="nav-item nav-link" id="nav-veiling-tab" data-toggle="tab" href="#nav-Veiling"
                                   role="tab" aria-controls="nav-Veiling" aria-selected="false">Veiling</a>
                                <a class="nav-item nav-link" id="nav-rubriek-tab" data-toggle="tab" href="#nav-Rubriek"
                                   role="tab" aria-controls="nav-Veiling" aria-selected="false">Rubrieken</a>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <h2 class="error-message">De beheeromgeving</h2>
                        <p>Welkom administrator, op de beheeromgeving van EenmaalAndermaal.</p>
                        <p class="no-margin">Op deze pagina, bent u in staat om gebruikers te blokkeren en/of
                            verwijderen.
                            Dit kunt u doen onder de het tabblad 'Gebruiker'.</p>
                        <p class="no-margin">Dit tabblad kunt U openen, door bovenin, in het menu op 'Gebruiker' te
                            klikken.
                            Dit geeft de mogelijkheid om meer te doen. </p>
                        <br>
                        <p class="no-margin">Verder hebben we ook nog een tabblad voor de veilingen. U heeft hier de
                            mogelijkheid om een veiling te sluiten, op basis van een veilingnummer.</p>
                        <p class="no-margin">U hoeft hiervoor enkel een veilingsnummer te weten.</p>
                        <br>
                        <p class="margin-bottom no-margin">Ten slotte hebben we nog een Rubrieken tabblad. In dit tabblad
                            kunt U kleine aanpassingen aan de rubriekenboom maken.</p>
                        <br>
                    </div>
                    <div class="tab-pane fade" id="nav-Gebruiker" role="tabpanel" aria-labelledby="nav-gebruiker-tab">
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
                    <div class="tab-pane fade" id="nav-Rubriek" role="tabpanel" aria-labelledby="nav-Rubriek-tab">
                        <h2 class="error-message">Rubrieken beheren</h2>
                        <p>Op deze pagina kunt U de rubrieken beheren</p>
                        <p>Kies uw actie met behulp van de checkbox hier onder, en vul het formulier in.</p>
                        <div class="d-flex justify-content-around align-items-center">
                            <div class="col-3"><label><input type="radio" name="type" value="1"><strong>Toevoegen</strong></label></div>
                            <div class="col-3"><label><input type="radio" name="type" value="2"><strong>Uitfaseren</strong></label></div>
                            <div class="col-3"><label><input type="radio" name="type" value="3"><strong>Hernoemen</strong></label></div>
                            <div class="col-3"><label><input type="radio" name="type" value="4"><strong>Verwijderen</strong></label></div>
                        </div>
                        <div class="toevoegen-fields">
                            <div class="register-section">
                                <form method="Post" action="#">
                                    <label for="Rubrieknaam"><strong>Naam rubriek</strong></label><br>
                                    <input class="col-6" id="Rubrieknaam" name="Rubrieknaam" type="text"
                                           pattern="([^<>])+"
                                           placeholder="Rubrieknaam" maxlength="100" required><br>
                                    <input class="col-6" id="beheertype" name="beheertype" type="hidden" required
                                           value="Rubriek-toevoegen">
                                    <label for="Parentrubriek"><strong>Parent-rubriek</strong></label><br>
                                    <select id="Parentrubriek" name="Parentrubriek">
                                        <?php
                                        foreach ($legecategorieën as $key => $value) {

                                            echo '<option value="' . $value[0] . '">' . $value[2] . ' --> ' . $value['1'] . '</option>';
                                        }
                                        ?>
                                    </select><br>
                                    <button class="btn btn-primary" type="submit">Rubriek toevoegen</button>
                                </form>
                            </div>
                        </div>
                        <div class="uitfaseren-fields row">
                            <div class="register-section">
                                <form method="Post" action="#">
                                    <label for="Rubrieknaam"><strong>Rubriek</strong></label> <br>
                                    <select  id="Rubrieknaam" name="Rubrieknaam">
                                        <?php
                                        foreach ($categorieën as $key => $value) {

                                            echo '<option value="' . $value[0] . '">' . $value[2] . ' --> ' . $value['1'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <input class="col-6" id="beheertype" name="beheertype" type="hidden" required
                                           value="Rubriek-uitfaseren">
                                    <br>
                                    <button class="btn btn-primary" type="submit">Faseer uit</button>
                                </form>
                            </div>
                        </div>
                        <div class="hernoemen-fields row">
                            <div class="register-section">
                                <form method="Post" action="#">
                                    <label for="nieuwe-naam"><strong>Nieuwe naam</strong></label><br>
                                    <input class="col-6" id="nieuwe-naam" name="nieuwe-naam" type="text"
                                           placeholder="Nieuwe naam rubriek" pattern="([^<>])+"
                                           maxlength="100" required>
                                    <input lass="col-6" id="beheertype" name="beheertype" type="hidden" required
                                           value="Rubriek-hernoemen">
                                    <br>
                                    <label for="Rubrieknaam"><strong>Rubriek</strong></label> <br>
                                    <select id="Rubrieknaam" name="Rubrieknaam">
                                        <?php
                                        foreach ($categorieën as $key => $value) {

                                            echo '<option value="' . $value[0] . '">' . $value[2] . ' --> ' . $value['1'] . '</option>';
                                        }
                                        ?>
                                    </select><br>

                                    <button class="btn btn-primary" type="submit">Hernoem</button>
                                </form>
                            </div>
                        </div>
                        <div class="verwijderen-fields row">
                            <div class="register-section">
                                <form method="Post" action="#">
                                    <label for="Rubrieknaam"><strong>Rubriek</strong></label> <br>
                                    <select id="Rubrieknaam" name="Rubrieknaam">
                                        <?php
                                        foreach ($categorieën as $key => $value) {

                                            echo '<option value="' . $value[0] . '">' . $value[2] . ' --> ' . $value['1'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <input class="col-6" id="beheertype" name="beheertype" type="hidden" required
                                           value="Rubriek-verwijderen">
                                    <br>
                                    <button class="btn btn-primary" type="submit">Verwijder rubriek</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
    }
} else {
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

<script>
    $('input[name="type"]').on('change', function () {
// this, in the anonymous function, refers to the changed-<input>:
// select the element(s) you want to show/hide:
        $('.toevoegen-fields')
        // pass a Boolean to the method, if the numeric-value of the changed-<input>
        // is exactly equal to 2 and that <input> is checked, the .business-fields
        // will be shown:
            .toggle(+this.value === 1 && this.checked);
// trigger the change event, to show/hide the .business-fields element(s) on
// page-load:
    }).change();

    $('input[name="type"]').on('change', function () {
// this, in the anonymous function, refers to the changed-<input>:
// select the element(s) you want to show/hide:
        $('.uitfaseren-fields')
        // pass a Boolean to the method, if the numeric-value of the changed-<input>
        // is exactly equal to 2 and that <input> is checked, the .business-fields
        // will be shown:
            .toggle(+this.value === 2 && this.checked);
// trigger the change event, to show/hide the .business-fields element(s) on
// page-load:
    }).change();


    //select the relevant <input> elements, and using on() to bind a change event-handler:
    $('input[name="type"]').on('change', function () {
// this, in the anonymous function, refers to the changed-<input>:
// select the element(s) you want to show/hide:
        $('.hernoemen-fields')
        // pass a Boolean to the method, if the numeric-value of the changed-<input>
        // is exactly equal to 2 and that <input> is checked, the .business-fields
        // will be shown:
            .toggle(+this.value === 3 && this.checked);
// trigger the change event, to show/hide the .business-fields element(s) on
// page-load:
    }).change();


    //select the relevant <input> elements, and using on() to bind a change event-handler:
    $('input[name="type"]').on('change', function () {
// this, in the anonymous function, refers to the changed-<input>:
// select the element(s) you want to show/hide:
        $('.verwijderen-fields')
        // pass a Boolean to the method, if the numeric-value of the changed-<input>
        // is exactly equal to 2 and that <input> is checked, the .business-fields
        // will be shown:
            .toggle(+this.value === 4 && this.checked);
// trigger the change event, to show/hide the .business-fields element(s) on
// page-load:
    }).change();

</script>