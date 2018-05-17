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

$data1 = get_security_question($db);

if(isset($_SESSION['user'])){
    $data2 = get_information_user($db, $_SESSION['user']);
}


$melding = '';
$aanpassing = false;
if(!empty($_POST['username']) AND !empty($_POST['first-name'])
    AND !empty($_POST['last-name']) AND !empty($_POST['birth-date']) AND !empty($_POST['e-mail']) AND !empty($_POST['country'])
    AND !empty($_POST['city']) AND !empty($_POST['address-field']) AND !empty($_POST['postcode']) AND !empty($_POST['security-question'])
    AND !empty($_POST['answer'])
)
{
    if($data2['Mailbox']!=$_POST['e-mail'] AND email_exists($db, $_POST['e-mail']) ){
        $melding = 'Het opgegeven mail-adres is al in gebruik.';
    }

    else if($data2['Gebruikersnaam'] != $_POST['username'] AND username_exists($db, $_POST['username'])){
        $melding = 'De opgegeven gebruikersnaam is al in gebruik.';
    }

    else{
        update_user($db, $_POST['username'], $_POST['first-name'], $_POST['last-name'],
            $_POST['address-field'], $_POST['address-field2'], $_POST['postcode'], $_POST['city'],
            $_POST['country'], $_POST['birth-date'], $_POST['e-mail'], $_POST['security-question'], $_POST['answer']
            );
            $_SESSION['user'] = $_POST['username'];
            redirect('gebruikersprofiel.php');
        }

}

if(isset($_SESSION['user'])){
?>

<main>
    <div class="container">
        <div class="register-section">
            <h1>Gegevens aanpassen</h1>
            <form method="Post" action="#">
                <div class="row">
                    <div class="col-md-6">
                        <p>Gebruikersnaam:</p>
                        <input id="username" name="username" type="text" placeholder="BarryBadpak" value='<?php echo $data2['Gebruikersnaam'] ?>' required>
                        <br>
                        <p>Voornaam:</p>
                        <input id="first-name" name="first-name" type="text" placeholder="Barry" value='<?php echo $data2['Voornaam'] ?>' required>
                        <br>
                        <p>Achternaam:</p>
                        <input id="last-name" name="last-name" type="text" placeholder="Badpak" value='<?php echo $data2['Achternaam'] ?>' required>
                        <br>
                        <p>Geboortedatum:</p>
                        <input id="birth-date" name="birth-date" type="date" value='<?php
                        echo $data2['GeboorteDag']; ?>' required>
                        <br>
                        <p>E-Mail:</p>
                        <input id="e-mail" name="e-mail" type="email" placeholder="E-mail" value='<?php echo $data2['Mailbox'] ?>' required>
                        <br>
                        <p>Veiligheidsvraag: </p>
                        <select name="security-question">
                            <?php
                            foreach($data1 as $key => $value){
                                echo '<option value="'. $value['Vraagnummer'].'">'.$value['TekstVraag'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <p>Land:</p>
                        <input id="country" name="country" type="text" placeholder="Nederland" value='<?php echo $data2['Land'] ?>' required>
                        <br>
                        <p>Stad:</p>
                        <input id="city" name="city" type="text" placeholder="Arnhem" value='<?php echo $data2['Plaatsnaam'] ?>' required>
                        <br>
                        <p>Adresregel 1:</p>
                        <input id="address-field" name="address-field" type="text" placeholder="Straatnaam 15" value='<?php echo $data2['Adresregel1'] ?>' required>
                        <br>
                        <p>Adresregel 2:</p>
                        <input id="address-field2" name="address-field2" type="text" placeholder="Toevoeging adresregel" value='<?php echo $data2['Adresregel2'] ?>'>
                        <br>
                        <p>Postcode: </p>
                        <input id="postcode" name="postcode" type="text" placeholder="4323DK" value='<?php echo $data2['Postcode'] ?>' required>
                        <br>
                        <p>Antwoord:</p>
                        <input id="answer" name="answer" type="text" placeholder="Antwoord" value='<?php echo $data2['Antwoordtekst'] ?>' required>
                        <br>
                        <button type="submit">Pas aan</button>
                    </div>
                </div>
            </form>
            <?php
            if(isset($melding)){echo '<p class="error-message">' . $melding . '</p>';}
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