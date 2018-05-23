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
$message = '';
if(isset($_SESSION['user']) AND check_if_unvalidated_seller($db, $_SESSION['user'])){
    $verkoperinformatie = get_unvalidated_seller($db, $_SESSION['user']);
}
if(isset($_POST['code']) AND !empty($_SESSION['user'])){

    if(get_validation_code_seller($db, $_SESSION['user'])==$_POST['code'] AND check_if_unvalidated_seller($db,$_SESSION['user'])){
        upgrade_to_seller($db, $verkoperinformatie['Gebruiker'], $verkoperinformatie['Bank'], $verkoperinformatie['Bankrekening'], $verkoperinformatie['ControleOptie'], $verkoperinformatie['Creditcard'] );
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
    else if(get_validation_code_seller($db, $SESSION['user'])!=$_POST['code'] AND check_if_unvalidated_seller($db, $_SESSION['user'])){
        ?>
        <main>
            <div class="container login">
                <div class="row login-section">
                    <form method="Post" action="#">
                        <div class="col-12">
                            <h1>Verificatie verkoper-code</h1>
                        </div>
                        <div class="col-md-6 center">
                            <p class="text-center">Verificatiecode:</p>
                            <input id="code" name="code" type="text" placeholder="b545392510">
                            <br>
                            <button class="btn-primary btn col-12" type="submit">Bevestigen</button>
                            <p class="error-message">Deze code is onjuist, probeer opnieuw.</p>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <?php

    }
}
else if(empty($_SESSION['user'])){
    ?>
<main>
    <div class="container error-box d-flex flex-row justify-content-center align-items-center">
        <div>
            <h2 class="error-message text-center">U bent niet ingelogd. </h2>
            <p class="text-center">Klik <a href="login.php">hier</a> om in te loggen.</p>
        </div>
    </div>
</main>

<?php }
        else if (check_if_seller($db, $_SESSION['user'])){
?>
<main>
    <div class="container error-box d-flex flex-row justify-content-center align-items-center">
        <div>
            <h2 class="error-message text-center">U bent al een verkoper. </h2>
            <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de
                beheerders.</p>
        </div>
    </div>
</main>

<?php
}


else if (check_if_unvalidated_seller($db, $_SESSION['user'])){
?>
<main>
    <div class="container login">
        <div class="row login-section">
            <form method="Post" action="#">
                <div class="col-12">
                    <h1>Verificatie verkoper-code</h1>
                </div>
                <div class="col-md-6 center">
                    <p class="text-center">Verificatiecode:</p>
                    <input id="code" name="code" type="text" placeholder="b545392510">
                    <br>
                    <button class="btn-primary btn col-12" type="submit">Bevestigen</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
}
?>

<?php
require_once 'partial/page_footer.php';
?>

<script src="js/img-highlight"></script>

