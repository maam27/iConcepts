<?php
function login_user($dbh, $user, $pass)
{
    try {
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
    }
    catch(PDOException $e){
        echo $e;
    }
    return false;
}

function register_user($dbh, $username, $password, $firstname, $lastname, $birthdate, $email, $country, $city, $addressfield, $addressfield2, $postcode, $securityquestion, $answer)
{
    try{
        $stmt = $dbh->prepare("INSERT INTO Gebruiker (Gebruikersnaam, Voornaam, Achternaam, Adresregel1, Adresregel2, Postcode, Plaatsnaam, Land, GeboorteDag, Mailbox, Wachtwoord, Vraag, Antwoordtekst, Verkoper)
        VALUES (:gebruiker, :voornaam, :achternaam, :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedag, :mailbox, :wachtwoord, :vraag, :antwoordtekst, 0)");
        $stmt -> execute(
            [
                ':gebruiker' => $username,
                ':voornaam' => $firstname,
                ':achternaam' => $lastname,
                ':adresregel1' => $adres1,
                ':adresregel2' => $adres2,
                ':postcode' => $postalcode,
                ':plaatsnaam' => $city,
                ':land' => $country,
                ':geboortedag' => $birthdate,
                ':mailbox' => $mail,
                ':wachtwoord' => $password,
                ':vraag' => $securityquestion,
                ':antwoordtekst' => $answer
            ]);

    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function email_exists($dbh, $email){
    $statement = $dbh->prepare("SELECT Gebruikersnaam FROM Gebruiker where Mailbox = :mail");
    $statement->execute(array(':mail' => $email));
    $result = $statement->fetch();
    if(isset($result['Gebruikersnaam']))
        return true;
    return false;
}
function username_exists($dbh, $username){
    $statement = $dbh->prepare("SELECT Gebruikersnaam FROM Gebruiker where Gebruikersnaam = :gebruiker");
    $statement->execute(array(':gebruiker' => $username));
    $result = $statement->fetch();
    if(isset($result['Gebruikersnaam']))
        return true;
    return false;
}

