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
    } catch (PDOException $e) {
        echo $e;
    }
    return false;
}


function aanvraag_register_user($dbh, $username, $firstname, $lastname, $addressfield, $addressfield2, $postcode, $city, $country, $birthdate, $email, $password, $securityquestion, $answer)
{
    $encryptedPassword = MD5($password);
    $date = date('Y-m-d H:i:s');
    $code = MD5($username . $email . $date);

    try {
        $stmt = $dbh->prepare("INSERT INTO OngevalideerdeGebruiker (Gebruikersnaam, Voornaam, Achternaam, Adresregel1, Adresregel2, Postcode, Plaatsnaam, Land, GeboorteDag, Mailbox, Wachtwoord, Vraag, Antwoordtekst, RegistratieDatum, Activeringscode)
        VALUES (:gebruiker, :voornaam, :achternaam, :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedag, :mailbox, :wachtwoord, :vraag, :antwoordtekst, :registratiedatum, :code)");
        $stmt->execute(
            [
                ':gebruiker' => $username,
                ':voornaam' => $firstname,
                ':achternaam' => $lastname,
                ':adresregel1' => $addressfield,
                ':adresregel2' => $addressfield2,
                ':postcode' => $postcode,
                ':plaatsnaam' => $city,
                ':land' => $country,
                ':geboortedag' => $birthdate,
                ':mailbox' => $email,
                ':wachtwoord' => $encryptedPassword,
                ':vraag' => $securityquestion,
                ':antwoordtekst' => $answer,
                ':registratiedatum' => $date,
                ':code' => $code
            ]);

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function check_for_validatiecode_registratie($dbh, $code)
{
    try {
        $stmt = $dbh->prepare("select count(*) from OngevalideerdeGebruiker where Activeringscode = :code");
        $stmt->execute(array(':code' => $code));
        $result = $stmt->fetchColumn();

        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function check_for_validatiecode_wachtwoord_vergeten($dbh, $code)
{
    try {
        $stmt = $dbh->prepare("select count(*) from VergetenWachtwoord where Activeringscode = :code");
        $stmt->execute(array(':code' => $code));
        $result = $stmt->fetchColumn();

        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_validatiecode_registratie($dbh, $gebruiker){
    try {
        $stmt = $dbh->prepare("select Activeringscode from OngevalideerdeGebruiker where Gebruikersnaam = :gebruiker");
        $stmt->execute(array(':gebruiker' => $gebruiker));
        $result = $stmt->fetch();

        return $result;

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function is_validation_in_time($dbh, $code)
{

    try {
        $stmt = $dbh->prepare("select RegistratieDatum from OngevalideerdeGebruiker where Activeringscode = :code");
        $stmt->execute(array(':code' => $code));
        $result = $stmt->fetchAll();

        $datetime2 = new DateTime(date('Y-m-d'));
        $datetime1 = new DateTime($result[0]['RegistratieDatum']);
        $interval = $datetime1->diff($datetime2);

        if ($interval->format('%a') <= 1) {
            return true;
        } else {
            return false;
        }


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_gegevens_registratieaanvraag($dbh, $code)
{
    try {
        $statement = $dbh->prepare("SELECT * FROM OngevalideerdeGebruiker where Activeringscode = :code");
        $statement->execute(array(':code' => $code));
        return $data = $statement->fetch();
    } catch (PDOException $e) {
        echo $e;
    }
}


function register_user($dbh, $username, $firstname, $lastname, $addressfield, $addressfield2, $postcode, $city, $country, $birthdate, $email, $password, $securityquestion, $answer, $code)
{

    try {
        $stmt = $dbh->prepare("INSERT INTO Gebruiker (Gebruikersnaam, Voornaam, Achternaam, Adresregel1, Adresregel2, Postcode, Plaatsnaam, Land, GeboorteDag, Mailbox, Wachtwoord, Vraag, Antwoordtekst, Verkoper)
        VALUES (:gebruiker, :voornaam, :achternaam, :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedag, :mailbox, :wachtwoord, :vraag, :antwoordtekst, 0)");
        $stmt->execute(
            [
                ':gebruiker' => $username,
                ':voornaam' => $firstname,
                ':achternaam' => $lastname,
                ':adresregel1' => $addressfield,
                ':adresregel2' => $addressfield2,
                ':postcode' => $postcode,
                ':plaatsnaam' => $city,
                ':land' => $country,
                ':geboortedag' => $birthdate,
                ':mailbox' => $email,
                ':wachtwoord' => $password,
                ':vraag' => $securityquestion,
                ':antwoordtekst' => $answer
            ]);

        $deleteaanvraag = $dbh->prepare("DELETE from OngevalideerdeGebruiker where activeringscode = :code");
        $deleteaanvraag->execute(
            [
                ':code' => $code
            ]
        );

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function change_password($dbh, $password, $mail){
    try{
        $statement = $dbh->prepare("update Gebruiker set Wachtwoord = :password where Mailbox = :email ");
        $statement->execute(array(':password' => $password, ':email' => $mail));
        $result = $statement->rowCount();
        if ($result == '1')
            return true;
        return false;
    }

    catch (PDOException $e) {
        echo $e;
    }

}

function unvalidated_email_exists($dbh, $email)
{
    $statement = $dbh->prepare("SELECT Gebruikersnaam FROM OngevalideerdeGebruiker where Mailbox = :mail");
    $statement->execute(array(':mail' => $email));
    $result = $statement->fetch();
    if (isset($result['Gebruikersnaam']))
        return true;
    return false;
}

function email_exists($dbh, $email)
{
    $statement = $dbh->prepare("SELECT Gebruikersnaam FROM Gebruiker where Mailbox = :mail");
    $statement->execute(array(':mail' => $email));
    $result = $statement->fetch();
    if (isset($result['Gebruikersnaam']))
        return true;
    return false;
}

function unvalidated_username_exists($dbh, $username)
{
    $statement = $dbh->prepare("SELECT Gebruikersnaam FROM OngevalideerdeGebruiker where Gebruikersnaam = :gebruiker");
    $statement->execute(array(':gebruiker' => $username));
    $result = $statement->fetch();
    if (isset($result['Gebruikersnaam']))
        return true;
    return false;
}

function username_exists($dbh, $username)
{
    $statement = $dbh->prepare("SELECT Gebruikersnaam FROM Gebruiker where Gebruikersnaam = :gebruiker");
    $statement->execute(array(':gebruiker' => $username));
    $result = $statement->fetch();
    if (isset($result['Gebruikersnaam']))
        return true;
    return false;
}


function get_user_question($email, $dbh)
{
    try {
        $statement = $dbh->prepare("SELECT TekstVraag FROM Gebruiker join Vraag on vraag.Vraagnummer = Gebruiker.Vraag where mailbox = :email ");
        $statement->execute(array(':email' => $email));
        $result = $statement->fetch();
        return $result['TekstVraag'];
    } catch (PDOException $e) {
        echo $e;
    }
    return null;
}

function check_user_answer($email, $answer, $dbh)
{
    try {
        $statement = $dbh->prepare("SELECT count(*) FROM Gebruiker join Vraag on vraag.Vraagnummer = Gebruiker.Vraag where Mailbox = :email and Antwoordtekst = :antwoord ");
        $statement->execute(array(':email' => $email, ':antwoord' => $answer));
        $result = $statement->fetchColumn();
        if ($result == 1)
            return true;
        return false;
    } catch (PDOException $e) {
        echo $e;
    }
    return false;
}

function reset_password($email, $password, $dbh, $code)
{
    try {
        $stmt = $dbh->prepare("DELETE FROM WachtwoordVergeten where code = :code");
        $stmt -> execute([
            ':code' => $code
        ]);


        $statement = $dbh->prepare("update Gebruiker set Wachtwoord = :password where Mailbox = :email ");
        $statement->execute(array(':password' => $password, ':email' => $email));
        $result = $statement->rowCount();
        if ($result == '1')
            return true;
        return false;
    } catch (PDOException $e) {
        echo $e;
    }
    return false;
}

function get_user($dbh, $username)
{
    try {
        $statement = $dbh->prepare("SELECT * FROM Gebruiker where Gebruikersnaam = :gebruiker");
        $statement->execute(array(':gebruiker' => $username));
        return $data = $statement->fetch();
    } catch (PDOException $e) {
        echo $e;
    }
}

function update_user($dbh, $username, $firstname, $lastname, $addressfield, $addressfield2, $postcode, $city, $country, $birthdate, $email, $securityquestion, $answer)
{


    try {
        $stmt = $dbh->prepare("UPDATE Gebruiker SET Gebruikersnaam = :gebruiker, Voornaam = :voornaam, Achternaam = :achternaam, Adresregel1 = :adresregel1, Adresregel2 = :adresregel2,
                      Postcode = :postcode, Plaatsnaam = :plaatsnaam, Land = :land, GeboorteDag = :geboortedag, Mailbox = :mailbox,
                      Vraag = :vraag, Antwoordtekst = :antwoordtekst 
                      WHERE Gebruikersnaam = :ingelogdeUser");
        $stmt->execute(
            [
                ':gebruiker' => $username,
                ':voornaam' => $firstname,
                ':achternaam' => $lastname,
                ':adresregel1' => $addressfield,
                ':adresregel2' => $addressfield2,
                ':postcode' => $postcode,
                ':plaatsnaam' => $city,
                ':land' => $country,
                ':geboortedag' => $birthdate,
                ':mailbox' => $email,
                ':vraag' => $securityquestion,
                ':antwoordtekst' => $answer,
                ':ingelogdeUser' => $_SESSION['user']
            ]);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function request_seller_status($dbh, $username, $bank, $bankrekening, $controleoptie, $CreditCard)
{
    $date = new DateTime(date('Y-m-d'));
    $code = MD5($username . $date->format('Y-m-d H:i:s'));

    if ($CreditCard == "") {
        $CreditCard = NULL;
    }

    try {
        $stmt = $dbh->prepare("INSERT into OngevalideerdeVerkoper (Gebruiker, Bank, Bankrekening, ControleOptie, Creditcard, Activeringscode)
        VALUES (:gebruiker, :bank, :rekening, :controleoptie, :creditcard, :code)");
        $stmt->execute(
            [
                ':gebruiker' => $username,
                ':bank' => $bank,
                ':rekening' => $bankrekening,
                ':controleoptie' => $controleoptie,
                ':creditcard' => $CreditCard,
                ':code' => $code
            ]
        );

        $result = $stmt->rowCount();

        if($result == 1){
            return true;
        }
        else{return false;}

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_unvalidated_seller($dbh, $username)
{

    try {
        $statement = $dbh->prepare("SELECT * FROM OngevalideerdeVerkoper where Gebruiker = :gebruiker");
        $statement->execute([':gebruiker' => $username]);
        $data = $statement -> fetch();
        return $data;
    }

    catch (PDOException $e) {
        echo $e;
    }

}

function get_validation_code_seller($dbh, $user)
{
    try {
        $statement = $dbh->prepare("SELECT * FROM OngevalideerdeVerkoper where Gebruiker = :gebruiker");
        $statement->execute([':gebruiker' => $user]);
        $data = $statement->fetch();
        $code = substr($data['Activeringscode'], 0, 10);
        return $code;

    } catch (PDOException $e) {
        echo $e;
    }

}

function upgrade_to_seller($dbh, $username, $bank, $bankrekening, $controleoptie, $creditcard)
{
    try {
        $stmt = $dbh->prepare("INSERT into Verkoper (Gebruiker, Bank, Bankrekening, ControleOptie, Creditcard)
        VALUES (:gebruiker, :bank, :rekening, :controleoptie, :creditcard)");
        $stmt->execute(
            [
                ':gebruiker' => $username,
                ':bank' => $bank,
                ':rekening' => $bankrekening,
                ':controleoptie' => $controleoptie,
                ':creditcard' => $creditcard
            ]
        );

        $stmt2 = $dbh->prepare("DELETE from OngevalideerdeVerkoper where Gebruiker = :gebruiker");
        $stmt2->execute([
            ':gebruiker' => $username
        ]
    );

        $stmt3 = $dbh->prepare("UPDATE Gebruiker set verkoper=1 where Gebruikersnaam = :gebruiker");
        $stmt3->execute([
            ':gebruiker' => $username
        ]);

    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function check_if_unvalidated_seller($dbh, $username)
{
    $statement = $dbh->prepare("SELECT Gebruiker FROM OngevalideerdeVerkoper where Gebruiker = :gebruiker");
    $statement->execute(array(':gebruiker' => $username));
    $result = $statement->fetch();
    if (isset($result['Gebruiker']))
        return true;
    return false;

}

function get_seller_and_auction_info($dbh, $itemId)
{

    try {
        $stmt = $dbh->prepare("SELECT *, vp.Land as Verkoopland, G.Land as Verkoperland, vp.plaatsnaam as Verkoopplaats FROM Verkoper v join Voorwerp vp on v.Gebruiker=vp.Verkoper
                                  JOIN gebruiker g on vp.verkoper = g.gebruikersnaam where voorwerpnummer = :item");
        $stmt->execute(array(':item' => $itemId));
        $data1 = $stmt->fetch();
        return $data1;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function check_if_seller_has_feedback($dbh, $verkoper)
{
    try {
        $stmt = $dbh->prepare("select count(*) from voorwerp v join feedback f on v.voorwerpnummer = f.Voorwerp where verkoper = :verkoper and soortgebruiker='Koper' ");
        $stmt->execute(array(':verkoper' => $verkoper));
        $result = $stmt->fetchColumn();

        if ($result >= 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_ungiven_feedback($dbh, $user)
{
    try {
        $stmt = $dbh->prepare("Select * from voorwerp where voorwerpnummer not in (SELECT Voorwerpnummer FROM Voorwerp v full join feedback f on v.Voorwerpnummer = f.voorwerp where Koper = :gebruiker1 AND SoortGebruiker = 'Koper') and koper = :gebruiker2 and veilinggesloten = 1 OR Voorwerpnummer in 
  (Select Voorwerpnummer from voorwerp where voorwerpnummer not in (SELECT Voorwerpnummer FROM Voorwerp v full join feedback f on v.Voorwerpnummer = f.voorwerp where Verkoper = :gebruiker3 AND SoortGebruiker = 'Verkoper') and verkoper = :gebruiker4 and VeilingGesloten = 0)");
        $stmt->execute(array(':gebruiker1' => $user, ':gebruiker2' => $user, ':gebruiker3' => $user, ':gebruiker4' => $user));
        return $result = $stmt->fetchAll();


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



function get_feedback($dbh, $verkoper)
{
    try {
        $stmt = $dbh->prepare("select  Voorwerp, Feedbacksoort, Commentaar, Dag, Koper from voorwerp v join feedback f on v.voorwerpnummer = f.Voorwerp where verkoper = :verkoper and soortgebruiker='Koper'");
        $stmt->execute(array(':verkoper' => $verkoper));
        return $result = $stmt->fetchAll();


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function get_feedback_seller_top_5($dbh, $verkoper)
{
    try {
        $stmt = $dbh->prepare("select top 5 Voorwerp, Feedbacksoort, Commentaar, Dag, Koper from voorwerp v join feedback f on v.voorwerpnummer = f.Voorwerp where verkoper = :verkoper and soortgebruiker='Koper'");
        $stmt->execute(array(':verkoper' => $verkoper));
        return $result = $stmt->fetchAll();


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_ammount_feedback_seller($dbh, $verkoper)
{

    try {
        $stmt = $dbh->prepare(" select  count(verkoper) as HoeveelFeedback, verkoper from voorwerp v join feedback f on v.voorwerpnummer = f.Voorwerp where verkoper = :verkoper and soortgebruiker='Koper'
                                 group by Verkoper");
        $stmt->execute(array(':verkoper' => $verkoper));
        $data1 = $stmt->fetch();

        return $data1['HoeveelFeedback'];

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_sum_feedback_seller($dbh, $verkoper)
{
    $stmt = $dbh->prepare("select sum(Feedbacksoort) as totaalcijfer, verkoper from voorwerp v join feedback f on v.voorwerpnummer = f.Voorwerp where verkoper = :verkoper and soortgebruiker='Koper'
                                group by Verkoper");
    $stmt->execute(array(':verkoper' => $verkoper));
    $data2 = $stmt->fetch();

    return $data2['totaalcijfer'];
}

function calculate_average_feedback_seller($dbh, $verkoper)
{
    if (get_ammount_feedback_seller($dbh, $verkoper) == 0) {
        return 'Geen feedback ontvangen';
    } else {
        return '' . number_format((get_sum_feedback_seller($dbh, $verkoper) / get_ammount_feedback_seller($dbh, $verkoper)), 2) . '/5';
    }
}

function check_if_seller($dbh, $verkoper)
{
    $statement = $dbh->prepare("SELECT Gebruiker FROM Verkoper where Gebruiker = :gebruiker");
    $statement->execute(array(':gebruiker' => $verkoper));
    $result = $statement->fetch();
    if (isset($result['Gebruiker']))
        return true;
    return false;

}

function get_information_user($dbh, $gebruiker)
{
    $statement = $dbh->prepare("SELECT * FROM Gebruiker where Gebruikersnaam = :gebruiker");
    $statement->execute(array(':gebruiker' => $gebruiker));
    return $data1 = $statement->fetch();
}

function check_if_phonenumber($dbh, $gebruiker)
{
    try {
        $statement = $dbh->prepare("SELECT count(*) FROM GebruikersTelefoon WHERE Gebruiker = :gebruiker");
        $statement->execute(array(':gebruiker' => $gebruiker));
        $result = $statement->fetchColumn();

        if ($result >= 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_phonenumber($dbh, $gebruiker)
{
    try {
        $statement = $dbh->prepare("SELECT * From GebruikersTelefoon WHERE Gebruiker = :gebruiker");
        $statement->execute(array(':gebruiker' => $gebruiker));
        return $result = $statement->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function get_active_auctions_from_seller($dbh, $gebruiker)
{
    try {
        $statement = $dbh->prepare("select count(*) from Gebruiker g join Voorwerp v on g.Gebruikersnaam = v.Verkoper where Gebruikersnaam = :gebruiker AND VeilingGesloten = 1");
        $statement->execute(array(':gebruiker' => $gebruiker));
        return $result = $statement->fetchColumn();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_security_question($dbh)
{
    $stmt = $dbh->prepare("SELECT * FROM Vraag");
    $stmt->execute();
    return $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function insert_password_forgotten_code($dbh, $email){

    $date = date('Y-m-d H:i:s');
    $code = MD5($email . $date);


    try {
        $stmt = $dbh->prepare("INSERT INTO WachtwoordVergeten VALUES (:mail, :code, :datum)");
        $stmt->execute(
            [
                ':mail' => $email,
                ':code' => $code,
                ':datum' => $date
            ]);

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_request_forgotten_password($dbh, $mail){
    try{
        $stmt = $dbh -> prepare("select * from WachtwoordVergeten WHERE Mailbox = :mail");
        $stmt -> execute ([
            ':mail' => $mail
        ]);
        $data = $stmt -> fetchAll();
        return $data;
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function check_if_open_request_forgotten_password($dbh, $mail){
    $stmt = $dbh->prepare("SELECT COUNT(*) FROM WachtwoordVergeten WHERE Mailbox = :mail");
    $stmt -> execute ([
        ':mail' => $mail
    ]);
    $result = $stmt->fetchColumn();
    if($result == 1) {
        return true;
    }
    else {return false;}
}

function check_if_code_exists_forgotten_password($dbh, $code){
    try {
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM WachtwoordVergeten WHERE Activeringscode = :code");
        $stmt->execute([
            ':code' => $code
        ]);
        $result = $stmt->fetchColumn();
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_mail_with_code($dbh, $code){
    try{
        $stmt = $dbh -> prepare("SELECT Mailbox from WachtwoordVergeten WHERE Activeringscode = :code");
        $stmt -> execute ([
            ':code' => $code
        ]);
        $result = $stmt -> fetch();
        return $result;
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
}


