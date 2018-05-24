<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/user_functions.php';
?>
    <title>Wachtwoord Vergeten</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';
$question = null;
$questionCorrect = false;
$openverzoek = false;
if(isset($_POST['email'])){
    $question = get_user_question($_POST['email'],$db);
    $openverzoek = check_if_open_request_forgotten_password($db, $_POST['email']);
}
if(isset($_POST['answer'])) {
    if (check_user_answer($_POST['email'], $_POST['answer'], $db) == true) {
        $questionCorrect = true;
        insert_password_forgotten_code($db, $_POST['email']);

    }
}
$code_matches=false;
if(isset($_GET['code'])){
    if(check_if_code_exists_forgotten_password($db, $_GET['code'])){
        $code_matches=true;
    }
}




if(isset($_POST['nWachtwoord1'])){
    if($_POST['nWachtwoord1'] == $_POST['nWachtwoord2']){
        $mailadress = get_mail_with_code($db, $_GET['code']);
        $password = md5($_POST['nWachtwoord1']);
        if(reset_password($mailadress['Mailbox'], $password, $db, $_GET['code'])){
            redirect("login.php");
        }
    }
}

if($questionCorrect == true){
    $openverzoek = get_request_forgotten_password($db, $_POST['email']);
    /*
    * Enable error reporting
    */
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    /*
     * Setup email addresses and change it to your own
     */
    $from = "EenmaalAndermaal@supportmail.com";
    $to = $_POST['email'];
    $subject = 'Wachtwoord Vergeten - EenmaalAndermaal';
    $code = $openverzoek[0]['Activeringscode'];
    $message = "Hallo,\r\n
    Er is recent een poging gedaan het wachtwoord van dit account te resetten op eenmaal andermaal.\r\n 
    
    Om dit process af te ronden, klik op de volgende link: \r\n
    http://iproject14.icasites.nl/afrondenregistratie.php?validatiecode=".$code;
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
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U verzoek is ontvangen.</h2>
                <p class="text-center">Als het goed is ontvangt u spoedig een mailtje met instructies.</p>
            </div>
        </div>
    </main>
    <?php
}
else if(isset($_GET['code']) AND $code_matches==false){ ?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U heeft een verkeerde link gevolgd.</h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>
    <?php

}
else if ($openverzoek){?>
    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U heeft een verkeerde link gevolgd.</h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>

    <?php
}
else{
?>

<main>
    <div class="container login">
        <form method="Post" action="">
        <?php if($questionCorrect == false AND !$code_matches) {?>
            <div class="row login-section">
                <div class="col-12">
                    <h1>Wachtwoord vergeten</h1>
                </div>
                <div class="col-12 col-sm-3">
                    <p>email:</p>
                </div>
                <div class="col-12 col-sm-9">
                    <input id="email" name="email" type="email" placeholder="email" required value="<?php echo if_set('email','post');?>" <?php if(!is_null($question) || !empty($question)) { echo 'readonly'; } else {echo 'autofocus';} ?>>
                </div>
                <?php if(!is_null($question) || !empty($question)) { ?>
                <div class="col-12">
                    <p>
                        <?php echo $question; ?>
                    </p>
                </div>
                <div class="col-12 col-sm-3">
                    <p>Antwoord:</p>
                </div>
                <div class="col-12 col-sm-9">
                    <input autofocus id="answer" name="answer" type="text" placeholder="antwoord" required value="<?php echo if_set('answer','post'); ?>"   >
                </div>
                <?php } ?>
                <div class="col-12">
                    <button class="btn btn-primary float-right">Verzenden</button>
                </div>
            </div>
        <?php } else if ($code_matches) { ?>
            <div class="row login-section">
                <div class="col-12">
                    <h1>Wachtwoord vergeten</h1>
                </div>
                <div id="passwordMatchWarning" class="col-12 error-message hide">
                    <p>De ingevoerde wachtwoorden komen niet overeen.</p>
                </div>
                <div class="col-12 col-sm-5">
                    <p>nieuw wachtwoord:</p>
                </div>
                <div class="col-12 col-sm-7">
                    <input autofocus id="nWachtwoord1" name="nWachtwoord1" type="password" required  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8." >
                </div>
                <div class="col-12 col-sm-5">
                    <p>nieuw wachtwoord:</p>
                </div>
                <div class="col-12 col-sm-7">
                    <input id="nWachtwoord2" name="nWachtwoord2" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8." >
                </div>
                <input id="email" name="email" type="hidden" required value="<?php echo $_POST['email']; ?>">
                <input id="answer" name="answer" type="hidden" required value="<?php echo $_POST['answer']; ?>">
                <div class="col-12">
                    <button class="btn btn-primary float-right">Verzenden</button>
                </div>
            </div>
        <?php } ?>
        </form>
    </div>
</main>

<?php }
require_once 'partial/page_footer.php';
?>

<script>
    $("form").submit(function(e){
        $pw1 = $('#nWachtwoord1');
        $pw2 = $('#nWachtwoord2');
        $pwMatchWarning = $('#passwordMatchWarning');
        if($pw1 != null && $pw2 != null){
            if($pw1.val() != $pw2.val()){
                $pwMatchWarning.show();
                e.preventDefault();
            }else{
                $pwMatchWarning.hide();
            }
        }
    });
</script>