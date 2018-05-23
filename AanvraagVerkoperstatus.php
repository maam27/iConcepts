<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
?>
<title>Verkoper worden | EenmaalAndermaal</title>
</head>

<body>
<?php
include_once 'partial/menu.php';
$aanvraag = false;
if (isset($_SESSION['user'])) {
    $data2 = get_user($db, $_SESSION['user']);
}


if (!empty($_POST['username']) AND !empty($_POST['bank']) AND !empty($_POST['rekening']) AND !empty($_POST['controle-optie'])) {
    if (!check_if_unvalidated_seller($db, $_SESSION['user']) AND !check_if_seller($db, $_SESSION['user'])) {
        if (request_seller_status($db, $_POST['username'], $_POST['bank'], $_POST['rekening'], $_POST['controle-optie'], $_POST['Creditcard'])) {
            $aanvraag = true;
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

<?php } else if (!check_if_unvalidated_seller($db, $_SESSION['user']) AND !check_if_seller($db, $_SESSION['user'])) {
    ?>

    <main>
        <div class="container">
            <div class="login-section">
                <h1>Word verkoper</h1>
                <form method="Post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Gebruikersnaam:</p>
                            <input id="username" name="username" type="text" placeholder="BarryBadpak"
                                   value='<?php echo $data2['Gebruikersnaam'] ?>' readonly required>
                            <br>
                            <p>Bank:</p>
                            <select name="bank">
                                <option value="ABN AMRO">ABN AMRO</option>
                                <option value="ASN Bank">ASN Bank</option>
                                <option value="bunq">bunq</option>
                                <option value="ING">ING</option>
                                <option value="Knab">Knab</option>
                                <option value="Moneyou">Moneyou</option>
                                <option value="Rabobank">Rabobank</option>
                                <option value="RegioBank">RegioBank</option>
                                <option value="SNS">SNS</option>
                                <option value="Triodos Bank">Triodos Bank</option>
                                <option value="Van Lanschot">Van Lanschot</option>

                            </select>
                            <br>
                            <p>Bankrekening:</p>
                            <input id="rekening" name="rekening" type="text" placeholder="NL11REGB2354781234"
                                   pattern="^NL\d{2}[A-Z]{4}\d{10}$">
                            <br>
                            <p>Controleoptie:</p>
                            <select name="controle-optie">
                                <option value="Brief">Brief</option>
                                <option value="PinPas">Andere</option>
                            </select>
                            <br>
                            <p>Creditcard:</p>
                            <input id="Creditcard" name="Creditcard" type="text" placeholder="aaaaa">
                            <br>

                            <button type="submit" class="btn btn-primary">Word verkoper</button>
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
    <?php

} else if ($aanvraag == true) {
   $UnvalidatedSeller = get_unvalidated_seller($db, $_SESSION['user']);
   $gebruikerinformatie = get_user($db, $_SESSION['user']);

    /*
     * Enable error reporting
     */
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    /*
     * Setup email addresses and change it to your own
     */
    $from = "EenmaalAndermaal@supportmail.com";
    $to = $gebruikerinformatie['Mailbox'];
    $subject = 'Verkoperaanvraag EenmaalAndermaal';
    $message = "Hallo ".$gebruikerinformatie['Voornaam']." ".$gebruikerinformatie['Achternaam'].",\r\n
    U heeft recent een aanvraag gedaan om verkoper te worden.\r\n 
    Wij zijn blij om te vertellen dat we het verzoek hebben goedgekeurd! \r\n
    
    Om een verkoper te worden op EenmaalAndermaal, zult u nog een paar stappen moeten ondernemen. \r\n
    \r\n U moet naar uw persoonlijke profiel gaan, en op de knop 'invullen verificatiecode' klikken. \r\n
    Eenmaal hier, moet U de volgende code invullen ".substr($UnvalidatedSeller['Activeringscode'], 0, 10)." \r\n
    
    Als alternatief, kunt U ook de volgende link in de browser invullen: \r\n
    http://iproject14.icasites.nl/AfrondenVerkoperstatus.php \r\n
    \r\n Wij hopen dat U veel plezier heeft van EenmaalAndermaal als verkoper!
    
    \r\n \r\n 
    Met vriendelijke groet,
    \r\n EenmaalAndermaal";
    $headers = "From:" . $from;

    /*
     * Test php mail function to see if it returns "true" or "false"
     * Remember that if mail returns true does not guarantee
     * that you will also receive the email
     */
    if(mail($to,$subject,$message, $headers))
    {
        echo "Test email send.";
    }
    else
    {
        echo "Failed to send.";
    }


    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 user-section d-flex align-items-center flex-column">
                    <h2 class="error-message text-center">U aanvraag is ontvangen.</h2>
                    <p class="text-center">U zult binnenkort een mail ontvangen waarin een code staat.</p>
                    <p class="text-center">Deze kunt u op uw profiel activeren, onder de knop 'invullen verificatiecode'</p>
                    <?php
                    echo $to, $subject, $message, $headers
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
}

else if(check_if_seller($db, $_SESSION['user'])){
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 user-section d-flex align-items-center flex-column">
                    <h2 class="error-message text-center">U bent al een verkoper.</h2>
                    <p class="text-center">Als u denkt dat dit een fout is, neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
                </div>
            </div>
        </div>
    </main>
    <?php

}
else if (check_if_unvalidated_seller($db, $_SESSION['user'])) {
    ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 user-section d-flex align-items-center flex-column">
                    <h2 class="error-message text-center">U heeft al een openstaande aanvraag.</h2>
                    <p class="text-center">Er is een brief naar U verstuurt. Als deze niet binnen 7 dagen van uw aanvraag aankomt, neem dan <a href="OverOns.php">contact</a> op met de beheerders.</p>
                </div>
            </div>
        </div>
    </main>
    <?php
}?>
   <?php
require_once 'partial/page_footer.php';
?>
