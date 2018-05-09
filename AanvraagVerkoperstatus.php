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
$statement = $db->prepare("SELECT * FROM Gebruiker where Gebruikersnaam = :gebruiker");
$statement->execute(array(':gebruiker' => $_SESSION['user']));
$data2 = $statement->fetch();

if(!empty($_POST['username']) AND !empty($_POST['bank']) AND !empty($_POST['rekening']) AND !empty($_POST['controle-optie']))
{
upgrade_to_seller($db, $_POST['username'], $_POST['bank'], $_POST['rekening'], $_POST['controle-optie'], $_POST['Creditcard']);

}
if(empty( $_SESSION['user'])){
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

<?php }
    else {
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
                                <input id="rekening" name="rekening" type="text" placeholder="NL11REGB2354781234" required>
                                <br>
                                <p>Controleoptie:</p>
                                <select name="controle-optie">
                                    <option value="Creditcard">Creditcard</option>
                                    <option value="PinPas">Pinpas</option>
                                </select>
                                <br>
                                <p>Credit-card (optioneel):</p>
                                <input name="Creditcard" type="text" placeholder="aaayyyyyyyy">
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
    }
    ?>

<?php
require_once 'partial/page_footer.php';
?>
