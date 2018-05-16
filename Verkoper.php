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

if(1>1){
    }

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
        <div class="row">
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
        </div>
        <div class="row margin-top">
            <h2>Veilingen van deze verkoper.</h2>
            <div class="col-12">
                <div class="d-flex justify-content-around flex-wrap">
                    <div class="productblock">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-sm-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-md-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-lg-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-xl-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-sm-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-md-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-lg-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-xl-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-sm-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-md-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-lg-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                    <div class="productblock d-none d-xl-block">
                        <img src="images/thumb/placeholder.jpg" alt="" class="img-thumbnail"/>
                        <div>
                            <p>hier kan een product naam of titel komen maar de lengte is niet altijd even lang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

        <?php } ?>
<?php
require_once 'partial/page_footer.php';
?>