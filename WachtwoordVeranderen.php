<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
?>
<title>Updaten Profiel | EenmaalAndermaal</title>
</head>

<body>
<?php
include_once 'partial/menu.php';
$message = '';
if (isset($_SESSION['user'])) {
    $data = get_information_user($db, $_SESSION['user']);
    if(isset($_POST['old-password'])){
    $hashed_password = md5($_POST['old-password']);
    if (!empty($_POST['old-password']) and !empty($_POST['new-password']) and !empty($_POST['new-password2'])) {
        if ($hashed_password != $data['Wachtwoord']) {
            $message = 'U heeft een onjuist wachtwoord ingevoerd.';
        } else if ($_POST['new-password'] != $_POST['new-password2']) {
            $message = 'Het nieuwe wachtwoord komt niet overeen. Probeer het opnieuw';
        }
        else{
            if(change_password($db, md5($_POST['new-password']), $data['Mailbox'])){
                $message = 'U heeft succesvol uw wachtwoord veranderd';
            }
        }
    }
}
}


if (isset($_SESSION['user'])){
    ?>
    <main>
        <div class="container">
            <div class="register-section">
                <h1>Gegevens aanpassen</h1>
                <form method="Post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Huidig wachtwoord:</p>
                            <input id="old-password" name="old-password" type="password" placeholder="" required>
                            <br>
                            <p>Nieuwe wachtwoord:</p>
                            <input id="new-password" name="new-password" type="password" placeholder="" required>
                            <br>
                            <p>Confirmatie nieuwe wachtwoord:</p>
                            <input id="new-password2" name="new-password2" type="password" placeholder="" required>
                            <br>
                            <button class="btn btn-primary" type="submit">Pas aan</button>
                            <?php
                            if (isset($message)) {
                                echo '<p class="error-message">' . $message . '</p>';
                            }
                            ?>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($melding)) {
                    echo '<p class="error-message">' . $melding . '</p>';
                }
                ?>

            </div>
        </div>
    </main>
<?php }

else{
?>
<main>
    <div class="container error-box d-flex flex-row justify-content-center align-items-center">
        <div>
            <h2 class="error-message text-center">U bent niet ingelogd. </h2>
            <p class="text-center">Klik <a href="login.php">hier</a> om in te loggen</p>
        </div>
    </div>
</main>


<?php
}
require_once 'partial/page_footer.php';
?>
