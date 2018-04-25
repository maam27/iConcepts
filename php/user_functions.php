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