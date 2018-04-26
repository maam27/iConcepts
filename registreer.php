<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';

$melding = '';
if(!empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['password2']) and !empty($_POST['first-name']) and !empty($_POST['last-name']) and !empty($_POST['birth-date']) and !empty($_POST['e-mail']) and !empty($_POST['country']) and !empty($_POST['city']) and !empty($_POST['address-field']) and !empty($_POST['address-field2']) and !empty($_POST['postcode']) and !empty($_POST['security-question']) and !empty($_POST['answer'])
){
    if($_POST['password'] == $_POST['password2']){
        if(register_user($db,
            $_POST['username'],
            $_POST['password'],
            $_POST['first-name'],
            $_POST['last-name'],
            $_POST['birth-date'],
            $_POST['e-mail'],
            $_POST['country'],
            $_POST['city'],
            $_POST['address-field'],
            $_POST['address-field2'],
            $_POST['postcode'],
            $_POST['security-question'],
            $_POST['answer']))
        {
            login_user($db, $_POST['email'], $_POST['password']);
        }
        else{
            if(email_exists($db,$_POST['email'])){
                $melding .=  'Het opgegeven email adres heeft al een account';
            }
            else if(username_exists($db,$_POST['username'])){
                $melding .=  'De opgegeven gebruikersnaam bestaat al';
            }else{
                $melding .= 'Er ging iets mis tijdens het registreren';
            }
        }
    }
    else{
        $melding = 'Het wachtwoord komt niet overeen';
    }
}
else{
    if(isset($_POST['submit'])){
        $melding = 'u heeft niet een of meerdere velden niet ingevuld';
    }
}


                               $stmt = $db-> prepare ("SELECT * FROM Vraag");
                               $stmt->execute();
                               $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

    <main>
        <div class="container">
            <div class="register-section">
                <h1>Registreer</h1>
                <form method="Post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Gebruikersnaam:</p>
                            <input id="username" name="username" type="text" placeholder="BarryBadpak" required>
                            <br>
                            <p>Wachtwoord:</p>
                            <input id="password" name="password" type="password" placeholder="Wachtwoord" required>
                            <br>
                            <p>Bevestig wachtwoord:</p>
                            <input id="password2" name="password2" type="password" placeholder="Wachtwoord123!"
                                   required>
                            <br>
                            <p>Voornaam:</p>
                            <input id="first-name" name="first-name" type="text" placeholder="Barry" required>
                            <br>
                            <p>Achternaam:</p>
                            <input id="last-name" name="last-name" type="text" placeholder="Badpak" required>
                            <br>
                            <p>Geboortedatum:</p>
                            <input id="birth-date" name="birth-date" type="date"  required>
                            <br>
                            <p>E-Mail:</p>
                            <input id="e-mail" name="e-mail" type="email" placeholder="E-mail" required>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <p>Land:</p>
                            <input id="country" name="country" type="text" placeholder="Nederland" required>
                            <br>
                            <p>Stad:</p>
                            <input id="city" name="city" type="text" placeholder="Arnhem" required>
                            <br>
                            <p>Adresregel 1:</p>
                            <input id="address-field" name="address-field" type="text" placeholder="Straatnaam 15" required>
                            <br>
                            <p>Adresregel 2:</p>
                            <input id="address-field2" name="address-field2" type="text" placeholder="Toevoeging adresregel">
                            <br>
                            <p>Postcode: </p>
                            <input id="postcode" name="postcode" type="text" placeholder="4323DK" required>
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
                            <input id="answer" name="answer" type="text" placeholder="Antwoord" required>
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