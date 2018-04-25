<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
</head>

<body>
<?php
include_once 'partial/menu.php';

if(isset($_POST)){
    if(isset($_POST['username']) && isset($_POST['password'])){
        //validate user and pass

        //hash pass
        if(login_user($db,$_POST['username'],$_POST['password'])){
            redirect("index.php");
        }

    }
}
?>

<main>
    <div class="container">
        <div class="login-register-section text-left">
            <h1>Login</h1>
            <form method="Post" action="#">
                <p>Gebruikersnaam:</p>
                <input id="username" name="username" type="text"        placeholder="Gebruikersnaam"    required>
                <br>
                <p>Wachtwoord:</p>
                <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required minlength="8">
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