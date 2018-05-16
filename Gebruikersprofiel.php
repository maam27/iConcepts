<?php
require_once 'partial/page_head.php';
?>
    <title>Gebruikersprofiel | EenmaalAndermaal</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';


$statement = $db->prepare("SELECT * FROM Gebruiker where Gebruikersnaam = :gebruiker");
$statement->execute(array(':gebruiker' => $_SESSION['user']));
$data1 = $statement->fetch();

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
                <div class="col-md-6"><h2>Veiling waarop je hebt geboden.</h2>
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="productblock">
                            <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                            <div>
                                <p>hier kan een product naam of titel komen maar de lengte is niet altijd even
                                    lang</p>
                            </div>
                        </div>
                        <div class="productblock d-none d-sm-block">
                            <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                            <div>
                                <p>hier kan een product naam of titel komen maar de lengte is niet altijd even
                                    lang</p>
                            </div>
                        </div>
                        <div class="productblock d-none d-md-block">
                            <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                            <div>
                                <p>hier kan een product naam of titel komen maar de lengte is niet altijd even
                                    lang</p>
                            </div>
                        </div>
                        <div class="productblock d-none d-lg-block">
                            <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                            <div>
                                <p>hier kan een product naam of titel komen maar de lengte is niet altijd even
                                    lang</p>
                            </div>
                        </div>
                        <div class="productblock d-none d-xl-block">
                            <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                            <div>
                                <p>hier kan een product naam of titel komen maar de lengte is niet altijd even
                                    lang</p>
                            </div>
                        </div>
                        <div class="productblock">
                            <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                            <div>
                                <p>hier kan een product naam of titel komen maar de lengte is niet altijd even
                                    lang</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center  user-section">

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
                    </p>
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

                    <form class="row" method="post">

                        <a class="btn btn-primary col-md-5 user-section-button-margin"
                           href="UpdateUserInformation.php">Pas gegevens aan</a>

                        <?php
                        if ($data1['Verkoper'] == 1) {
                            echo '<a class="btn btn-primary col-md-5 user-section-button-margin" href="Verkoper.php"> Mijn advertenties </a>';

                        } else {
                            echo '<a class="col-md-5 btn btn-primary user-section-button-margin" href="AanvraagVerkoperstatus.php"> Wordt Verkoper </a>   ';
                        }
                        ?>


                    </form>

                </div>

            </div>
        </div>
    </main>

    <?php
}
require_once 'partial/page_footer.php';
?>