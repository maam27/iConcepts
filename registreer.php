<?php
require_once 'partial/page_head.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
    </head>

<body>
<?php
include_once 'partial/menu.php';
?>

<main>
    <div class="container">
        <div class="login-register-section text-left">
            <h1>Registreer</h1>
            <form method="Post" action="#">
                <p>Voornaam:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Achternaam:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
                <br>
                <p>Geboortedatum:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>E-Mail:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Gebruikersnaam:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Wachtwoord:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
                <br>
                <p>Bevestig wachtwoord:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Land:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
                <br>
                <p>Stad:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Adresregel 1:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Adresregel 2:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Postcode: </p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Veiligheidsvraag: </p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Antwoord:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>


                <button>login</button>
            </form>
            <p class="bottom-login-register-form">Heeft u al een account klik <a class="no-margin" href="login.php">hier</a> om naar inloggen te gaan</p>
        </div>
    </div>
</main>

<?php
require_once 'partial/page_footer.php';
?>