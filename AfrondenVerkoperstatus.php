<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/item_functions.php';
require_once 'php/user_functions.php';
?>
<title>Verkoperaanvraag afronden | EenmaalAndermaal</title>
</head>

<body>
<?php
include_once 'partial/menu.php';

$succes = false;

if(!empty($_POST['code'])){
    if(get_validation_code($db, $_SESSION['user']) == $_POST['code']){
        $succes = true;
        $sellerdata = get_unvalidated_seller($db, $_SESSION['user']);
        upgrade_to_seller($db, $sellerdata['Gebruiker'], $sellerdata['Bank'], $sellerdata['Bankrekening'], $sellerdata['ControleOptie'], $sellerdata['Creditcard']);
    }
}

if(empty($_SESSION['user'])){

    ?>

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

else if(check_if_seller($db, $_SESSION['user'])){
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U bent al een verkoper. </h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>

    <?php
}

else if ($succes==true){
    ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U bent nu een verkoper</h2>
            </div>
        </div>
    </main>
    <?php
}


else if(check_if_unvalidated_seller($db, $_SESSION['user'])){
?>

<main>
    <div class="container login">
        <form method="Post" action="#">
            <div class="row login-section">
                <div class="col-12">
                    <h1>Verificatie verkoper-code</h1>
                </div>
                <div class="col-md-6 center">
                    <p class="text-center">Verificatiecode:</p>
                    <input id="code" name="code" type="text" placeholder="b545392510">
                    <br>
                    <button class="btn-primary btn col-12" type="submit">Bevestigen</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php }
require_once 'partial/page_footer.php';
?>

<script src="js/img-highlight"></script>

