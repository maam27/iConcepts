<!--
try{
    $query = "INSERT INTO Gebruiker	(Gebruikersnaam,voornaam,achternaam,Adresregel1,Adresregel2,Postcode,Plaatsnaam,Land,GeboorteDag,Mailbox,Wachtwoord,Vraag,Antwoordtekst,Verkoper)
			            	VALUES  (':user',':fname',':lname',':adress1',':adress2',':zipcode',':city',':country',':birthdate',':mail',':password',':question',':answer',':seller')";
    $statement = $db->prepare($query);
    $statement->execute(
    array(':user' => "marleyBob++++++"
    , ':fname' => "vnaam"
    , ':lname' => "aNaMe"
    , ':adress1' => "hier"
    , ':adress2' => "en daar"
    , ':zipcode' => "1594AZ"
    , ':city' => "weet je zeluf"
    , ':country' => "ussr"
    , ':birthdate' => date("Y-m-d")
    , ':mail' => "bobske"
    , ':password' => "pass"
    , ':question' => 1
    , 'answer' => "wat dan"
    , 'seller' => 0));
    if ($statement->rowCount() == 1){
        echo 'works';
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
?>
    <title>Wachtwoord Vergeten</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';
?>

<main>
    <div class="container login">
        <form method="Post" action="#">
            <div class="row login-section">
                <div class="col-12">
                    <h1>Wachtwoord vergeten</h1>
                </div>
                <div class="col-12 col-sm-3">
                    <p>email:</p>
                </div>
                <div class="col-12 col-sm-9">
                    <input id="email" name="email" type="email" placeholder="email" required value="<?php echo if_set('email','post'); ?>"   >
                </div>
                <div class="col-12">
                    <button class="btn btn-primary float-right">Verzenden</button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
require_once 'partial/page_footer.php';
?>