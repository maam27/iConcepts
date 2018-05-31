<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
require_once 'php/item_functions.php';
?>
    <title>Gebruikersprofiel | EenmaalAndermaal</title>
    </head>
    <body>
<?php
include_once 'partial/menu.php';
if (isset($_SESSION['user'])) {
    $data1 = get_information_user($db, $_SESSION['user']);
    $queryResultaat = 1;

    if (isset($_GET['QuerySoort'])) {
        switch ($_GET['QuerySoort']) {
            case 'MijnVeilingenOpen':
                $queryResultaat = get_sellers_open_auctions($db, $_SESSION['user']);
                $text=false;
                break;
            case 'MijnVeilingenGesloten':
                $queryResultaat = get_sellers_closed_auctions($db, $_SESSION['user']);
                $text=false;
                break;
            case 'MijnBiedingenOpen':
                $queryResultaat = get_auctions_with_open_bid($db, $_SESSION['user']);
                $text=false;
                break;
            case 'MijnBiedingenGesloten':
                $queryResultaat = get_auctions_with_closed_bid($db, $_SESSION['user']);
                $text=false;
                break;
            case 'MijnFeedback':
                $queryResultaat = get_feedback_1($db, $_SESSION['user']);
                $queryResultaat2 = get_feedback_2($db, $_SESSION['user']);
                $text=true;
                break;
            case 'FeedbackGeven':
                $queryResultaat = get_ungiven_feedback($db, $_SESSION['user']);
                $text = false;
                break;
            case 'MijnGewonnenVeilingen':
                $queryResultaat = get_won_auctions($db, $_SESSION['user']);
                $text=false;
                break;
        }
    }
}
if (empty($_SESSION['user'])) {
    ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 user-section d-flex align-items-center flex-column">
                    <p>U bent niet ingelogd en kan deze pagina dus niet bekijken.</p>
                    <a class="btn btn-primary" href=login.php>login</a>
                </div>
            </div>
        </div>
    </main>

<?php } else {
    ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 margin-top">

                            <ul class="hyperlinklijst d-md-block d-flex flex-column justify-content-center align-items-center">
                                <?php if ($data1['Verkoper'] == 1) { ?>
                                    <li><a href="Gebruikersprofiel.php?QuerySoort=MijnVeilingenOpen#Jump">Mijn
                                            veilingen(open)</a></li>
                                    <li><a href="Gebruikersprofiel.php?QuerySoort=MijnVeilingenGesloten#Jump">Mijn
                                            veilingen(gesloten)</a></li><?php } ?>
                                <li><a href="Gebruikersprofiel.php?QuerySoort=MijnBiedingenOpen#Jump">Mijn
                                        biedingen(open)</a>
                                </li>
                                <li><a href="Gebruikersprofiel.php?QuerySoort=MijnBiedingenGesloten#Jump">Mijn
                                        biedingen(gesloten)</a></li>
                                <li><a href="Gebruikersprofiel.php?QuerySoort=MijnFeedback#Jump">Mijn ontvangen feedback</a>
                                </li>
                                <li><a href="Gebruikersprofiel.php?QuerySoort=FeedbackGeven#Jump">Feedback geven</a></li>
                                <li><a href="Gebruikersprofiel.php?QuerySoort=MijnGewonnenVeilingen#Jump">Mijn gewonnen
                                        veilingen</a></li>
                            </ul>

                        </div>


                        <div class="col-md-6 margin-top">
                            <p class="text-center text-md-left"><strong>Voornaam:</strong>
                                <?php echo $data1['Voornaam']; ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Achternaam:</strong>
                                <?php echo $data1['Achternaam']; ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Gebruikersnaam:</strong>
                                <?php echo $data1['Gebruikersnaam']; ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Adresregel1:</strong>
                                <?php echo $data1['Adresregel1']; ?>
                            </p>
                            <?php if ($data1['Adresregel2'] != '') {
                                ?>
                                <p class="text-center text-md-left"><strong>Adresregel2:</strong>
                                    <?php echo $data1['Adresregel2']; ?>
                                </p>
                            <?php } ?>
                            <p class="text-center text-md-left"><strong>Postcode:</strong>
                                <?php echo $data1['Postcode']; ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Plaatsnaam:</strong>
                                <?php echo $data1['Plaatsnaam']; ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Land:</strong>
                                <?php echo $data1['Land']; ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Geboortedag:</strong>
                                <?php
                                $date = new DateTime($data1['GeboorteDag']);
                                $result = $date->format('d-m-Y');
                                echo $result ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Mailbox:</strong>
                                <?php echo $data1['Mailbox']; ?>
                            </p>
                            <p class="text-center text-md-left"><strong>Verkoper:</strong>
                                <?php
                                if ($data1['Verkoper'] == 0) {
                                    echo 'Nee';
                                } else {
                                    echo 'Ja';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <form class="row d-flex justify-content-center align-items-center" method="post">

                <a class="btn btn-primary col-md-3 user-section-button-margin"
                   href="UpdateUserInformation.php">Pas gegevens aan</a>

                <a class="btn btn-primary col-md-3 user-section-button-margin"
                   href="UpdatePassword.php">Pas wachtwoord aan</a>

                <?php
                if ($data1['Verkoper'] == 1) {
                    echo '<a class="btn btn-primary col-md-3 user-section-button-margin" href="Verkoper.php"> Mijn advertenties </a>';

                } else if (check_if_unvalidated_seller($db, $_SESSION['user'])) {
                    echo '<a class="col-md-3 btn btn-primary user-section-button-margin" href="AfrondenVerkoperstatus.php">Invullen verificatiecode</a>   ';
                } else {
                    echo '<a class="col-md-3 btn btn-primary user-section-button-margin" href="AanvraagVerkoperstatus.php"> Word Verkoper </a>   ';
                }
                ?>
            </form>
            <div class="row seperator-bottom">
                <div class="col-12">
                    <div class="row margin-top">
                        <div class="col-12">
                            <?php if (is_array($queryResultaat)) {
                                if($text == true){
                                    echo '<h1 class="error-message text-center">Gevonden feedback</h1>';
                                }
                                else{?>

                                <h1 class="error-message text-center" id="Jump">Gevonden Veiling(en)</h1>
                                <?php }
                                $size = sizeof($queryResultaat);
                                if ($size == 0 AND $text==false) {
                                    ?>

                                    <p> Er zijn geen resultaten gevonden met deze specifieke zoekopdracht.</p>
                                    <?php
                                }

                                else if ($text==false){

                                    echo '<div class="d-flex justify-content-around flex-wrap">';
                                    for($i =0; $i < sizeof($queryResultaat); $i++){
                                        echo '<div class="productblock">';
                                        if($queryResultaat[$i]['Voorwerpnummer']>=20 AND $queryResultaat[$i]['Voorwerpnummer']<110301827613){
                                            $locatie = "http://iproject14.icasites.nl/uploads/".get_image_name($db, $queryResultaat[$i]['Voorwerpnummer']);
                                            echo '<img src="'.$locatie.'" alt="a" class="hardcoded-thumbnail"/>';
                                        }
                                        else if($queryResultaat[$i]['Voorwerpnummer']<20){
                                            $locatie = "http://iproject14.icasites.nl/images/".get_image_name($db, $queryResultaat[$i]['Voorwerpnummer']);
                                            echo '<img src="'.$locatie.'" alt="a" class="hardcoded-thumbnail"/>';
                                        }
                                        else{
                                            $locatie= "http://iproject14.icasites.nl/pics/".get_image_name($db, $queryResultaat[$i]['Voorwerpnummer']);
                                            echo '<img src="'.$locatie.'" alt="a"" class="hardcoded-thumbnail"/>';
                                        }

                                        echo '<div><p><a class="black-text" href="Veilingspagina.php?voorwerp='.$queryResultaat[$i]['Voorwerpnummer'].'"> '.$queryResultaat[$i]['Titel'].'</a></p></div></div>';
                                    }


                                    ?>
                                <?php }

                                else{echo '<div class="d-flex justify-content-around flex-wrap">';
                                    $size1 = sizeof($queryResultaat);
                                    $size2 = sizeof($queryResultaat2);
                                    if($size1 == 0 and $size2 == 0){
                                        echo '<p> Er zijn geen resultaten gevonden met deze specifieke zoekopdracht.</p>';
                                    }

                                    if(!empty($queryResultaat)){
                                        echo '<div class="col-md-6 feedbackBlock seperator-bottom seperator-none-md seperator-right-md">';
                                        echo '<h5>Van kopers ontvangen:</h5>';
                                    for($i=0; $i<sizeof($queryResultaat); $i++){


                                        echo '<p class="text-center">"'.$queryResultaat[$i]['Commentaar'].'" - '.$queryResultaat[$i]['Feedbacksoort'].'/5 </p>';
                                        echo '<p class="eindeFeedback text-center">'.'-'.$queryResultaat[$i]['Koper']. ',  ' . $queryResultaat[$i]['Dag'];
                                        echo '<p class="margin-bottom"> </p>';
                                        echo '</div>';
                                        }
                                    }

                                    if(!empty($queryResultaat2)){
                                        echo '<div class="col-md-6 feedbackBlock">';
                                        echo '<h5>Van verkopers ontvangen:</h5>';
                                        for($i=0; $i<sizeof($queryResultaat2); $i++){

                                            echo '<p class="text-center">"'.$queryResultaat2[$i]['Commentaar'].'" - '.$queryResultaat2[$i]['Feedbacksoort'].'/5 </p>';
                                            echo '<p class="text-center eindeFeedback">'.'-'.$queryResultaat2[$i]['Verkoper']. ',  ' . $queryResultaat2[$i]['Dag'];
                                            echo '<p> </p>';
                                            echo '</div>';
                                        }
                                    }
                                }
                                echo '</div>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
}
require_once 'partial/page_footer.php';
?>