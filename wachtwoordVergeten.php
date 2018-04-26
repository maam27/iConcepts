<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';

//
//function register_user($dbh, $plan, $email, $voornaam, $achternaam, $username, $password, $paymentmethod, $cardnumber, $country, $gender, $birthdate)
//{
//    try {
//        $query = "insert into customer ([customer_mail_address],[lastname],[firstname],[payment_method],[payment_card_number],[contract_type],[subscription_start],[user_name],[password],[country_name],[gender],[birth_date])
//			values   (:mail,:anaam,:vnaam,:payment,:cardnr,:plan,:date,
//			:user,:pass,:country,:gender,:birth)";
//        $statement = $dbh->prepare($query);
//        $statement->execute(array(':mail' => $email
//        , ':anaam' => $achternaam
//        , ':vnaam' => $voornaam
//        , ':payment' => $paymentmethod
//        , ':cardnr' => $cardnumber
//        , ':plan' => $plan
//        , ':date' => date("Y-m-d")
//        , ':user' => $username
//        , ':pass' => $password
//        , ':country' => $country
//        , ':gender' => $gender
//        , ':birth' => $birthdate));
//        if ($statement->rowCount() == 1)
//            return true;
//        return false;
//    } catch (PDOException $e) {
//        echo $e;
//    }
//}

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
?>

    <main>
        <div class="container">
        </div>
    </main>

<?php
require_once 'partial/page_footer.php';
?>