<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';

$stmt = $db-> prepare ("SELECT * FROM Vraag");
$stmt->execute();
$data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$melding = '';

if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['password2']) AND !empty($_POST['first-name'])
    AND !empty($_POST['last-name']) AND !empty($_POST['birth-date']) AND !empty($_POST['e-mail']) AND !empty($_POST['country'])
    AND !empty($_POST['city']) AND !empty($_POST['address-field']) AND !empty($_POST['postcode']) AND !empty($_POST['security-question'])
    AND !empty($_POST['answer'])
)
{
if( email_exists($db, $_POST['e-mail']) ){
    $melding = 'Het opgegeven mail-adres is al in gebruik.';
}

else if(username_exists($db, $_POST['username'])){
    $melding = 'De opgegeven gebruikersnaam is al in gebruik.';
}

else if($_POST['password'] != $_POST['password2']){
    $melding = 'Het wachtwoord komt niet overeen met de verificatie.';
}

else {register_user($db, $_POST['username'], $_POST['first-name'],$_POST['last-name'],$_POST['address-field'],
    $_POST['address-field2'],$_POST['postcode'], $_POST['city'],$_POST['country'],$_POST['birth-date'],$_POST['e-mail'],
    $_POST['password'],$_POST['security-question'], $_POST['answer']);
    redirect('login.php');
}
}






?>

    <main>
        <div class="container">
            <div class="register-section">
                <h1>Registreer</h1>
                <form method="Post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Gebruikersnaam:</p>
                            <input id="username" name="username" type="text" placeholder="BarryBadpak" <?php echo post_set('username', 'post');?> required>
                            <br>
                            <p>Wachtwoord:</p>
                            <input id="password" name="password" type="password" placeholder="Wachtwoord" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8." required>
                            <br>
                            <p>Bevestig wachtwoord:</p>
                            <input id="password2" name="password2" type="password" placeholder="Wachtwoord" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8." required>
                            <br>
                            <p>Voornaam:</p>
                            <input id="first-name" name="first-name" type="text" placeholder="Barry" <?php echo post_set('first-name', 'post');?> required>
                            <br>
                            <p>Achternaam:</p>
                            <input id="last-name" name="last-name" type="text" placeholder="Badpak" <?php echo post_set('last-name', 'post');?> required>
                            <br>
                            <p>Geboortedatum:</p>
                            <input id="birth-date" name="birth-date" type="date" <?php echo post_set('birth-date', 'post');?> required>
                            <br>
                            <p>E-Mail:</p>
                            <input id="e-mail" name="e-mail" type="email" placeholder="E-mail" <?php echo post_set('e-mail', 'post');?> required>
                            <br>
                        </div>
                        <div class="col-md-6">

                            <p>Land:</p>
                            <input id="country" name="country" type="text" placeholder="Nederland" <?php echo post_set('country', 'post');?> required>
                            <br>
                            <p>Stad:</p>
                            <input id="city" name="city" type="text" placeholder="Arnhem" <?php echo post_set('city', 'post');?> required>
                            <br>
                            <p>Adresregel 1:</p>
                            <input id="address-field" name="address-field" type="text" placeholder="Straatnaam 15" <?php echo post_set('address-field', 'post');?> required>
                            <br>
                            <p>Adresregel 2:</p>
                            <input id="address-field2" name="address-field2" type="text" placeholder="Toevoeging adresregel" <?php echo post_set('address-field2', 'post');?>>
                            <br>
                            <p>Postcode: </p>
                            <input id="postcode" name="postcode" type="text" placeholder="4323DK" <?php echo post_set('postcode', 'post');?> required>
                            <br>
                            <p>Veiligheidsvraag: </p>
                            <select name="security-question">
                                <?php
                                    foreach($data1 as $key => $value){
                                        echo '<option value="'. $value['Vraagnummer'].'">'.$value['TekstVraag'].'</option>';
                                    }
                                ?>
                            </select>
                            <br>
                            <p>Antwoord:</p>
                            <input id="answer" name="answer" type="text" placeholder="Antwoord"  required>
                            <br>
                            <button type="submit">Registreer</button>
                        </div>
                    </div>
                </form>
                <?php
                if(isset($melding)){echo '<p class="error-message">' . $melding . '</p>';}
                ?>
                <p class="bottom-login-register-form">Heeft u al een account klik <a class="no-margin" href="login.php">hier</a>
                    om naar inloggen te gaan</p>
            </div>
        </div>
    </main>

<?php
require_once 'partial/page_footer.php';
?>