<?
require_once 'partial/page_head.php';
?>
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

<?php
require_once 'partial/page_footer.php';
?>