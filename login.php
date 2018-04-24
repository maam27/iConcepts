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
        <h1>Login</h1>
        <form method="Post" action="#">
            <input id="username" name="username" type="email"        placeholder="E-mail"    required    value="<?=if_set('username','post')?>">
            <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
            <button>login</button>
        </form>
        <p>Heeft u nog geen account klik <a class="no-margin" href="abonnementen.php">hier</a> om naar registratie te gaan</p>

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
