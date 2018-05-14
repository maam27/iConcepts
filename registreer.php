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

$stmt = $db->prepare("SELECT * FROM Vraag");
$stmt->execute();
$data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$melding = '';
$vandaag = date("Y/m/d");


if (!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['password2']) AND !empty($_POST['first-name'])
    AND !empty($_POST['last-name']) AND !empty($_POST['birth-date']) AND !empty($_POST['e-mail']) AND !empty($_POST['country'])
    AND !empty($_POST['city']) AND !empty($_POST['address-field']) AND !empty($_POST['postcode']) AND !empty($_POST['security-question'])
    AND !empty($_POST['answer'])) {
    if ($_POST['password'] == $_POST['password2']) {


        $datetime2 = new DateTime(date('Y-m-d'));
        $datetime1 = new DateTime($_POST['birth-date']);
        $interval = $datetime1->diff($datetime2);

        if($interval->format('%a') < 5844){
            $melding = 'U bent niet oud genoeg om een account te maken';
        }
        else if (email_exists($db, $_POST['e-mail'])) {
            $melding = 'Het opgegeven mail-adres is al in gebruik.';
        } else if (username_exists($db, $_POST['username'])) {
            $melding = 'De opgegeven gebruikersnaam is al in gebruik.';
        }
       else if (register_user($db, $_POST['username'], $_POST['first-name'], $_POST['last-name'], $_POST['address-field'],
            $_POST['address-field2'], $_POST['postcode'], $_POST['city'], $_POST['country'], $_POST['birth-date'], $_POST['e-mail'],
            $_POST['password'], $_POST['security-question'], $_POST['answer'])) {
           $encryptWachtwoord = md5($_POST['password']);
            login_user($db, $_POST['username'], $encryptWachtwoord);
            redirect('Index.php');
        }

    }


    else{$melding = 'Het wachtwoord komt niet overeen met de verificatie.';
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
                        <input id="username" name="username" type="text"
                               placeholder="Gebruikersnaam" <?php echo post_set('username', 'post'); ?> required>
                        <br>
                        <p>Wachtwoord:</p>
                        <input id="password" name="password" type="password" placeholder="Wachtwoord"
                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8."
                               required>
                        <br>
                        <p>Bevestig wachtwoord:</p>
                        <input id="password2" name="password2" type="password" placeholder="Wachtwoord"
                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8."
                               required>
                        <br>
                        <p>Voornaam:</p>
                        <input id="first-name" name="first-name" type="text"
                               placeholder="Voornaam" <?php echo post_set('first-name', 'post'); ?> required>
                        <br>
                        <p>Achternaam:</p>
                        <input id="last-name" name="last-name" type="text"
                               placeholder="Achternaam" <?php echo post_set('last-name', 'post'); ?> required>
                        <br>
                        <p>Geboortedatum:</p>
                        <input id="birth-date" name="birth-date"
                               type="date" <?php echo post_set('birth-date', 'post'); ?> required>
                        <br>
                        <p>E-Mail:</p>
                        <input id="e-mail" name="e-mail" type="email"
                               placeholder="E-mail" <?php echo post_set('e-mail', 'post'); ?>
                               pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required>
                        <br>
                    </div>
                    <div class="col-md-6">

                        <p>Land:</p>
                        <input id="country" name="country" type="text"
                               placeholder="Land" <?php echo post_set('country', 'post'); ?> required>
                        <br>
                        <p>Stad:</p>
                        <input id="city" name="city" type="text"
                               placeholder="Stad" <?php echo post_set('city', 'post'); ?> required>
                        <br>
                        <p>Adresregel 1:</p>
                        <input id="address-field" name="address-field" type="text"
                               placeholder="Straatnaam nummer" <?php echo post_set('address-field', 'post'); ?>
                               title="Straatnaam gevolgd door nummer." required>
                        <br>
                        <p>Adresregel 2:</p>
                        <input id="address-field2" name="address-field2" type="text"
                               placeholder="straatnaam nummer" <?php echo post_set('address-field2', 'post'); ?>>
                        <br>
                        <p>Postcode: </p>
                        <input id="postcode" name="postcode" type="text"
                               placeholder="4323DK" <?php echo post_set('postcode', 'post'); ?>
                               pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}" title="4 cijfers gevolgd door 2 letters." required>
                        <br>
                        <p>Veiligheidsvraag: </p>
                        <select name="security-question">
                            <?php
                            foreach ($data1 as $key => $value) {
                            echo '<option value="' . $value['Vraagnummer'] . '">' . $value['TekstVraag'] . '</option>';
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
            <?php
            if (isset($melding)) {
            echo '<p class="error-message">' . $melding . '</p>';
            }
            ?>
            <p class="bottom-login-register-form">Heeft u al een account klik <a class="no-margin"
                                                                                 href="login.php">hier</a>
                om naar inloggen te gaan</p>

        </div>
    </div>
</main>

<?php
require_once 'partial/page_footer.php';
?>

<script>
    $(document).ready(function () {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("birth-date").setAttribute("max", today);
    });

</script>
