
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
if(isset($_SESSION['user'])){
    $data1 = get_information_user($db, $_SESSION['user']);
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
        <div class="row seperator-bottom">
            <div class="col-12">
                <div class="row margin-top">
                    <div class="col-12">
                        <h2 class="text-center">5 meest recente biedingen</h2>
                        <div class="d-flex justify-content-around flex-wrap">
                            <div class="productblock col-md-5 col-lg-2">
                                <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                                <p>Titel</p>
                            </div>
                            <div class="productblock col-md-5 col-lg-2">
                                <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                                <p>Titel</p>
                            </div>
                            <div class="productblock col-md-5 col-lg-2">
                                <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                                <p>Titel</p>
                            </div><div class="productblock col-md-5 col-lg-2">
                                <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                                <p>Titel</p>
                            </div><div class="productblock col-md-5 col-lg-2">
                                <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                                <p>Titel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 margin-top">
                            <p><strong>Voornaam:</strong>
                                <?php echo $data1['Voornaam']; ?>
                            </p>
                            <p><strong>Achternaam:</strong>
                                <?php echo $data1['Achternaam']; ?>
                            </p>
                            <p><strong>Gebruikersnaam:</strong>
                                <?php echo $data1['Gebruikersnaam']; ?>
                            </p>
                            <p><strong>Adresregel1:</strong>
                                <?php echo $data1['Adresregel1']; ?>
                            </p>
                            <?php if ($data1['Adresregel2'] != '') {
                                ?>
                                <p><strong>Adresregel2:</strong>
                                    <?php echo $data1['Adresregel2']; ?>
                                </p>
                            <?php } ?>
                            <p><strong>Postcode:</strong>
                                <?php echo $data1['Postcode']; ?>
                            </p></div>


                        <div class="col-md-6 margin-top">
                            <p><strong>Plaatsnaam:</strong>
                                <?php echo $data1['Plaatsnaam']; ?>
                            </p>
                            <p><strong>Land:</strong>
                                <?php echo $data1['Land']; ?>
                            </p>
                            <p><strong>Geboortedag:</strong>
                                <?php
                                $date = new DateTime($data1['GeboorteDag']);
                                $result = $date->format('d-m-Y');
                                echo $result ?>
                            </p>
                            <p><strong>Mailbox:</strong>
                                <?php echo $data1['Mailbox']; ?>
                            </p>
                            <p><strong>Verkoper:</strong>
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

            <form class="row d-flex justify-content-center align-items-center seperator-bottom-md" method="post">

                <a class="btn btn-primary col-md-3 user-section-button-margin"
                   href="UpdateUserInformation.php">Pas gegevens aan</a>

                <a class="btn btn-primary col-md-3 user-section-button-margin"
                   href="UpdatePassword.php">Pas wachtwoord aan</a>

                <?php
                if ($data1['Verkoper'] == 1) {
                    echo '<a class="btn btn-primary col-md-3 user-section-button-margin" href="Verkoper.php"> Mijn advertenties </a>';

                } else if(check_if_unvalidated_seller($db, $_SESSION['user'])) {
                    echo '<a class="col-md-3 btn btn-primary user-section-button-margin" href="AfrondenVerkoperstatus.php">Invullen verificatiecode</a>   ';
                }
                else{           echo '<a class="col-md-3 btn btn-primary user-section-button-margin" href="AanvraagVerkoperstatus.php"> Word Verkoper </a>   ';}
                ?>
            </form>
        </div>
</main>

<?php
}
require_once 'partial/page_footer.php';
?>