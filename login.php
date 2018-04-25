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
            <h1>Login</h1>
            <form method="Post" action="#">
                <p>E-Mail:</p>
                <input id="username" name="username" type="email"        placeholder="E-mail"    required>
                <br>
                <p>Wachtwoord:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
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