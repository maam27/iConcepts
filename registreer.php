<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
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

if( email_exists($db, $_POST['e-mail']) ){
    $melding = 'Het opgegeven mail-adres is al in gebruik.';
}

else if($_POST['password'] != $_POST['password2']){
    $melding = 'Het wachtwoord komt niet overeen met de verificatie.';
}

else if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['password2']) AND !empty($_POST['first-name'])
    AND !empty($_POST['last-name']) AND !empty($_POST['birth-date']) AND !empty($_POST['e-mail']) AND !empty($_POST['country'])
    AND !empty($_POST['city']) AND !empty($_POST['address-field']) AND !empty($_POST['postcode']) AND !empty($_POST['security-question'])
    AND !empty($_POST['answer'])
)
{
register_user_test($db, $_POST['username'], $_POST['first-name'],$_POST['last-name'],$_POST['address-field'],
    $_POST['address-field2'],$_POST['postcode'], $_POST['city'],$_POST['country'],$_POST['birth-date'],$_POST['e-mail'],
    $_POST['password'],$_POST['security-question'], $_POST['answer']);
}







?>

    <main>
        <div class="container">
            <div class="register-section">
                <h1>Registreer</h1>
                <form method="Post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            if(isset($melding)){echo '<p>' . $melding . '</p>';}
                            ?>
                            <p>Gebruikersnaam:</p>
                            <input id="username" name="username" type="text" placeholder="BarryBadpak" value="Kutzooi123" required>
                            <br>
                            <p>Wachtwoord:</p>
                            <input id="password" name="password" type="password" placeholder="Wachtwoord" value="teringwachtwoord" required>
                            <br>
                            <p>Bevestig wachtwoord:</p>
                            <input id="password2" name="password2" type="password" placeholder="Wachtwoord123!" value="teringwachtwoord"
                                   required>
                            <br>
                            <p>Voornaam:</p>
                            <input id="first-name" name="first-name" type="text" placeholder="Barry" value="Rotnaam" required>
                            <br>
                            <p>Achternaam:</p>
                            <input id="last-name" name="last-name" type="text" placeholder="Badpak" value="LeukeAchternaam" required>
                            <br>
                            <p>Geboortedatum:</p>
                            <input id="birth-date" name="birth-date" type="date"  required>
                            <br>
                            <p>E-Mail:</p>
                            <input id="e-mail" name="e-mail" type="email" placeholder="E-mail" value="Rotformulier@mail" required>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <p>Land:</p>
                            <input id="country" name="country" type="text" placeholder="Nederland" value="BoeitNiet" required>
                            <br>
                            <p>Stad:</p>
                            <input id="city" name="city" type="text" placeholder="Arnhem" value="Stad123" required>
                            <br>
                            <p>Adresregel 1:</p>
                            <input id="address-field" name="address-field" type="text" placeholder="Straatnaam 15" value="Adress 14" required>
                            <br>
                            <p>Adresregel 2:</p>
                            <input id="address-field2" name="address-field2" type="text" placeholder="Toevoeging adresregel">
                            <br>
                            <p>Postcode: </p>
                            <input id="postcode" name="postcode" type="text" placeholder="4323DK" value="4232WK" required>
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
                            <input id="answer" name="answer" type="text" placeholder="Antwoord" value="Nee" required>
                            <br>
                            <button type="submit">Registreer</button>
                        </div>
                    </div>
                </form>
                <p class="bottom-login-register-form">Heeft u al een account klik <a class="no-margin" href="login.php">hier</a>
                    om naar inloggen te gaan</p>
            </div>
        </div>
    </main>

<?php
require_once 'partial/page_footer.php';
?>