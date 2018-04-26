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
                    <div class="row">
                        <div class="col-md-6">
                            <p>Gebruikersnaam:</p>
                            <input id="username" name="username" type="text" placeholder="BarryBadpak" required>
                            <br>
                            <p>Wachtwoord:</p>
                            <input id="password" name="password" type="password" placeholder="Wachtwoord" required>
                            <br>
                            <p>Bevestig wachtwoord:</p>
                            <input id="password2" name="password2" type="password" placeholder="Wachtwoord123!"
                                   required>
                            <br>
                            <p>Voornaam:</p>
                            <input id="first-name" name="first-name" type="text" placeholder="Barry" required>
                            <br>
                            <p>Achternaam:</p>
                            <input id="last-name" name="last-name" type="text" placeholder="Badpak" required>
                            <br>
                            <p>Geboortedatum:</p>
                            <input id="birthday" name="username" type="date"  required>
                            <br>
                            <p>E-Mail:</p>
                            <input id="e-mail" name="e-mail" type="email" placeholder="E-mail" required>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <p>Land:</p>
                            <input id="country" name="country" type="text" placeholder="Nederland" required>
                            <br>
                            <p>Stad:</p>
                            <input id="city" name="city" type="text" placeholder="Arnhem" required>
                            <br>
                            <p>Adresregel 1:</p>
                            <input id="address-field" name="address-field" type="text" placeholder="Straatnaam 15" required>
                            <br>
                            <p>Adresregel 2:</p>
                            <input id="address-field2" name="address-field2" type="text" placeholder="Toevoeging adresregel">
                            <br>
                            <p>Postcode: </p>
                            <input id="postcode" name="postcode" type="text" placeholder="4323DK" required>
                            <br>
                            <p>Veiligheidsvraag: </p>
                            <select name="Veiligheidsvraag">
                                <option value="1">Hier komt de eerste vraag?</option>
                                <option value="2">Of was het de tweede?</option>
                                <option value="3">Maar als de tweede daar staat, waar komt de derde?</option>
                                <option value="4">Dat zijn de echte vragen toch?</option>
                                <option value="5">Ja man G, denk het?</option>
                                <option value="6">okay?</option>

                            </select>
                            <br>
                            <p>Antwoord:</p>
                            <input id="username" name="username" type="email" placeholder="Antwoord" required>
                            <br>
                            <button type="submit">Registreer</button>
                        </div>
                    </div>
                </form>
                <p class="bottom-login-register-form">Heeft u al een account klik <a class="no-margin" href="login.php">hier</a>
                    om naar inloggen te gaan</p>
            </div>
        </div>
    </main>

<?php
require_once 'partial/page_footer.php';
?>