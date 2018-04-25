<?php
function login_user($dbh, $user, $pass)
{
    $statement = $dbh->prepare("SELECT [Gebruikersnaam] FROM Gebruiker where Gebruikersnaam = :name and Wachtwoord = :pass ");
    $statement->execute(array(':name' => $user,
        ':pass' => $pass));
    $result = $statement->fetch();
    if (!is_null($result)) {
        if (!is_null($result['Gebruikersnaam'])) {
            $_SESSION['user'] = $result['Gebruikersnaam'];
            return true;
        }
    }
    return false;
}

function register_user($dbh, $plan, $email, $voornaam, $achternaam, $username, $password, $paymentmethod, $cardnumber, $country, $gender, $birthdate)
{
    try {
        $query = "insert into customer ([customer_mail_address],[lastname],[firstname],[payment_method],[payment_card_number],[contract_type],[subscription_start],[user_name],[password],[country_name],[gender],[birth_date])
			values   (:mail,:anaam,:vnaam,:payment,:cardnr,:plan,:date,
			:user,:pass,:country,:gender,:birth)";
        $statement = $dbh->prepare($query);
        $statement->execute(array(':mail' => $email
        , ':anaam' => $achternaam
        , ':vnaam' => $voornaam
        , ':payment' => $paymentmethod
        , ':cardnr' => $cardnumber
        , ':plan' => $plan
        , ':date' => date("Y-m-d")
        , ':user' => $username
        , ':pass' => $password
        , ':country' => $country
        , ':gender' => $gender
        , ':birth' => $birthdate));
        if ($statement->rowCount() == 1)
            return true;
        return false;
    } catch (PDOException $e) {
        echo $e;
    }
}

?>