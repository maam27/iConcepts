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
include_once 'partial/menu.php';
$verkoperId = 'aaa';
if(isset($_GET['id'])) {
    $verkoperId = $_GET['id'];
}

if($verkoperId == 'aaa') {
    ?>

    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U heeft niet op een verkoper gezocht. </h2>
                <p>Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>

    <?php
}

else if(check_if_seller($db, $_GET['id'])== false){
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">Deze gebruiker is geen verkoper.</h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>

<?php }
else if(check_if_seller($db, $_GET['id'])){
    $data=get_information_user($db, $_GET['id']);
    $phone=get_phonenumber($db, $_GET['id'])
    ?>

    <main>
        <div class="container">
            <div class="grey-background-bar row">
                <h1><?php echo $data['Gebruikersnaam']; ?></h1>
            </div>
            <div class="white-background-bar row d-flex flex-row justify-content-around">
                <p class="col-md-4"><strong>Mail-adres:</strong> <?php echo $data['Mailbox']; ?></p>
                <p class="col-md-4"><strong>Locatie: </strong><?php echo $data['Land'].', '.$data['Plaatsnaam']; ?></p>
                <p class="col-md-4"><strong>Feedback: </strong><?php echo calculate_average_feedback_seller($db, $_GET['id']);?></p>
            </div>
            <div class="row seperator-bottom-md">
                <div class="col-md-6 margin-top margin-bottom">
                    <div class="row">
                        <div class="col-md-5 d-flex flex-row justify-content-center">
                            <img class="img-thumbnail user-image" src="images/TrumpPlaceholder.jpg">
                        </div>
                        <div class="col-md-7 d-flex flex-column justify-content-center justify-content-md-start">
                            <p><strong>Voornaam: </strong><?php echo $data['Voornaam'];?></p>
                            <p><strong>Achternaam: </strong><?php echo $data['Achternaam'];?></p>
                            <p><strong>Actieve veilingen:</strong> <?php echo get_active_auctions_from_seller($db, $_GET['id']);?> </p>
                            <p><strong>Land:</strong> <?php echo $data['Land'];?></p>
                            <p><strong>Stad:</strong> <?php echo $data['Plaatsnaam'];?></p>
                            <p><strong>Geboorte datum:</strong>  <?php
                                $date = new DateTime($data['GeboorteDag']);
                                $result = $date->format('d-m-Y');
                                echo $result ?></p>
                            <p><strong>E-Mail: </strong><?php echo $data['Mailbox'];?></p>
                            <?php
                            if(check_if_phonenumber($db, $_GET['id'])){
                                echo '<p><strong>Telefoon:</strong>'.$phone['Telefoon'].'</p>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 margin-top margin-bottom">
                    <h4>Meest recente feedback</h4>
                    <?php if(check_if_seller_has_feedback($db, $_GET['id'])){
                        $feedback = get_feedback_seller($db, $_GET['id']);
                        for ($i = 0; $i < count($feedback); $i++) {

                            echo '<p>"'.$feedback[$i]['Commentaar'].'" - '.$feedback[$i]['Feedbacksoort'].'/5 </p>';
                            echo '<p class="eindeFeedback">'.'-'.$feedback[$i]['Koper']. ',  ' . $feedback[$i]['Dag'];
                            echo '<p> </p>';
                        }
                    }
                    ?>
                </div>
            </div>


            <?php
            $data = get_sellers_open_auctions($db, $_GET['id']);
            $data2 = get_sellers_closed_auctions($db, $_GET['id']);

            if(!empty($data)){?>
                <div class="row margin-top">
                    <div class="col-12">
                    <h2>Actieve veilingen van deze verkoper.</h2>
                                            <div class="d-flex justify-content-around flex-wrap">
                            <?php
                            for($i = 0; $i <count($data); $i++){
                                echo '<div class="productblock col-md-5 col-lg-2">';
                                echo '<img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>';
                                //  echo '<img src="images/thumb/'.$data['plaatje'].' class="img-thumbnail"/>';
                                echo '<p>' .$data[$i]['Titel'].'</p></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php }

            if(!empty($data2)){?>
                <div class="row margin-top">
                    <div class="col-12">
                    <h2>Gesloten veilingen van deze verkoper.</h2>

                        <div class="d-flex justify-content-around flex-wrap">
                            <?php
                            for($i = 0; $i <count($data2); $i++) {
                                echo '<div class="productblock col-md-5 col-lg-2">';
                                echo '<img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>';
                                //  echo '<img src="images/thumb/'.$data['plaatje'].' class="img-thumbnail"/>';
                                echo '<p>' . $data2[$i]['Titel'] . '</p></div>';
                            }?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

<?php } ?>
<?php
require_once 'partial/page_footer.php';
?>