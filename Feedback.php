<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
require_once 'php/item_functions.php';
?>
<title>Jumbotron Template for Bootstrap Lool</title>
</head>

<body>

<?php
include_once 'partial/menu.php';

$soortGebruiker = "Koper";
$voorwerpNummer = $_GET['voorwerp'];

$statement = $db->prepare("SELECT * FROM Gebruiker where Gebruikersnaam = :gebruiker");
$statement->execute(array(':gebruiker' => $_SESSION['user']));
$data1 = $statement->fetch();

$statement = $db->prepare("SELECT * FROM Voorwerp where Voorwerpnummer = :voorwerp");
$statement->execute(array(':voorwerp' => $voorwerpNummer));
$data2 = $statement->fetch();

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


<main>
    <div class="container">
        <div class="register-section">
            <?php

            if(empty($_SESSION['user'])){
                redirect('login.php');
            }

            else if (empty($_GET['voorwerp'])){
                echo '<p> Deze pagina bestaat niet </p>';

            }

            else if ($feedbackGegeven == true) {
                echo '<p> U heeft succesvol feedback gegeven </p>';
            }

            else if ($data2['VeilingGesloten'] == 0) {
                ?>

                <p>Deze veiling is nog niet voorbij, en u kunt hier geen feedback op geven.</p>
                <p>Klik <a href="index.php">hier</a> om terug te gaan naar de homepage.</p>

                <?php
            }

            else if ($data2['Verkoper'] != $_SESSION['user'] AND $data2['Koper'] != $_SESSION['user']) { ?>
                <p>Je hebt niks met deze veiling te maken.</p>
                <p>Daarom mag je geen feedback geven.</p>
            <?php }

            else if(seller_feedback_given($db, $voorwerpNummer)==true AND $soortGebruiker == 'Verkoper'){
                echo '<p> Je hebt al feedback gegeven als verkoper </p>';
            }

            else if(buyer_feedback_given($db, $voorwerpNummer)==true AND $soortGebruiker == 'Koper'){
                echo '<p> Je hebt al feedback gegeven als koper </p>';
            }

            else {
                ?>
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


