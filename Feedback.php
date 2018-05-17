<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
require_once 'php/item_functions.php';
?>
<title>Feedback Formulier | EenmaalAndermaal</title>
</head>

<body>

<?php
include_once 'partial/menu.php';

$soortGebruiker = "Koper";
$voorwerpNummer = 0;
if(!empty($_GET['voorwerp']) AND is_numeric($_GET['voorwerp'])){
    $voorwerpNummer = $_GET['voorwerp'];
}

if(isset($_SESSION['user'])){
    $data1 = get_user($db, $_SESSION['user']); /* Informatie over de gebruiker */
}

$data2 = get_item($voorwerpNummer, $db); /* Informatie over het item */



$soortGebruiker;
if ($data2['Verkoper'] == $_SESSION['user']) {
    $soortGebruiker = 'Verkoper';
} else {
    $soortGebruiker = 'Koper';
}


$feedbackGegeven = false;
if (!empty($_POST['beoordeling'])){
    if (provide_feedback($db, $voorwerpNummer, $soortGebruiker, $_POST['beoordeling'], $_POST['opmerking'])) {
        $feedbackGegeven = true;
    };
}

else{
?>



<?php

if(empty($_SESSION['user'])){?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U bent niet ingelogd. </h2>
                <p class="text-center">Klik <a href="login.php">hier</a> om in te loggen.</p>
            </div>
        </div>
    </main>
    <?php

}


else if (empty($data2)){ ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">Deze pagina bestaat niet. </h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>

    <?php
}

else if ($feedbackGegeven == true) { ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U heeft succesvol feedback gegeven </h2>
                <p class="text-center">Bedankt voor beoordelen van deze gebruiker.</p>
            </div>
        </div>
    </main>

    <?php
}

else if ($data2['VeilingGesloten'] == 0) {
    ?>

    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">Deze veiling is nog niet gesloten. </h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>

    <?php
}

else if ($data2['Verkoper'] != $_SESSION['user'] AND $data2['Koper'] != $_SESSION['user']) { ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U kunt hier geen feedback geven. </h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>
<?php }

else if(seller_feedback_given($db, $voorwerpNummer)==true AND $soortGebruiker == 'Verkoper'){?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U heeft al feedback gegeven.</h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>
    <?php
}

else if(buyer_feedback_given($db, $voorwerpNummer)==true AND $soortGebruiker == 'Koper'){
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U heeft al feedback gegeven.</h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>
    <?php
}

else {
?>
<main>
    <div class="container">
        <div class="register-section">
            <h2>Feedback formulier</h2>
            <p><strong>U beoordeelt het als een:</strong> <?php echo $soortGebruiker ?></p>
            <p><strong>U beoordeelt het volgende product:</strong> <?php echo $data2['Titel'] ?> </p>

            <form role="form" method="post" action="#">

                <div class="row">
                    <div class="col-md-6">
                        <label><strong>Uw beoordeling:</strong></label>
                        <p>
                            <label class="radio-inline">
                                <input type="radio" name="beoordeling" id="radio_experience" value="1"
                                       required>
                                Zeer slecht
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="beoordeling" id="radio_experience" value="2">
                                Slecht
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="beoordeling" id="radio_experience" value="3">
                                Gemiddeld
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="beoordeling" id="radio_experience" value="4">
                                Goed
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="beoordeling" id="radio_experience" value="5">
                                Zeer goed
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="opmerking">
                            <strong>Opmerkingen:</strong></label>
                        <textarea class="form-control" type="textarea" name="opmerking" id="opmerking"
                                  placeholder="Plaats hier uw opmerking (100 karakters max)." maxlength="100"
                                  rows="7"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">
                            Gebruikersnaam:</label>
                        <input type="text" value=<?php echo '"' . $_SESSION['user'] . '"' ?> class="form-control"
                               id="name" name="name" placeholder="Gebruikersnaam" readonly required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">
                            Email:</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value=<?php echo '"' . $data1['Mailbox'] . '"' ?> readonly required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Post</button>
                    </div>
                </div>

            </form>


            <?php
            if (isset($melding)) {
                echo '<p class="error-message">' . $melding . '</p>';
            }
            }
            }
            ?>


        </div>
    </div>
</main>

<?php
require_once 'partial/page_footer.php';
?>


