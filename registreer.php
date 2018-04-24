<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Jumbotron Template for Bootstrap Lool</title>
    <?php
    require_once 'partial/styles.php';
    ?>
</head>

<body>
<?php
include_once 'partial/menu.php';
?>

<main>
    <div class="container">
        <div class="loginRegistreerSection text-left">
            <h1>Registreer</h1>
            <form method="Post" action="#">
                <p>E-Mail:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <p>Wachtwoord:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
                <p>Ander ding1:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <p>Ander ding2:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
                <p>Ander ding3:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <p>Ander ding4:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
                <br>

                <button>login</button>
            </form>
            <p class="onderkantLoginRegistreer">Heeft u al een account klik <a class="no-margin" href="login.php">hier</a> om naar inloggen te gaan</p>
        </div>

</main>

<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>
<?php
include_once 'partial/scripts.php';
?>
</body>
</html>
