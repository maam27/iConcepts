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
    try {
        $query = "insert into Gebruiker ([Gebruikersnaam],[Voornaam],[Achternaam],[Adresregel1],[Adresregel2],[Postcode],[Plaatsnaam],[Land],[GeboorteDag],[Mailbox],[Wachtwoord],[Vraag], [Antwoordtekst], [Verkoper])
			values(:username,:voornaam,:achternaam,:adresveld1,:adresveld2,:postcode,:stad,:land,:geboortedatum,:e-mail,:wachtwoord, :veiligheidsvraag, :antwoord, :verkoper)";
        $statement = $dbh->prepare($query);
        $statement->execute(array(':mail' => $email
        , ':username' => $username
        , ':voornaam' => $firstname
        , ':achternaam' => $lastname
        , ':adresveld1' => $addressfield
        , ':adresveld2' => $addressfield2
        , ':postcode' => $postcode
        , ':stad' => $city
        , ':land' => $country
        , ':geboortedatum' => $birthdate
        , ':e-mail' => $email
        , ':wachtwoord' => $password
        , ':veiligheidsvraag' => $securityquestion
        , ':antwoord' => $answer
        , ':verkoper' => 0
            ));
        if ($statement->rowCount() == 1)
            return true;
        return false;
    } catch (PDOException $e) {
        echo $e;
    }
}

