<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
?>
    <title>Jumbotron Template for Bootstrap Lool</title>
</head>

<body>
<?php
include_once 'partial/menu.php';

$attemptedLogin = false;
if(isset($_POST)){
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $attemptedLogin = true;
        $pass = $_POST['password'];
        if (preg_match('/[A-Z]/', $pass) && preg_match('/[0-9]/', $pass)) {
            if (empty($message)) {
                $pass = $_POST['password']; //md5($_POST['password']);
                if (login_user($db, $_POST['username'], $pass)) {
                    redirect("index.php");
                }
            }
        }
    }
}
?>

<main>
    <div class="container login">
        <form method="Post" action="#">
            <div class="row login-section">
                <div class="col-12">
                    <h1>Login</h1>
                </div>
                <?php
                if($attemptedLogin){
                ?>
                <div class="col-12 error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    De combinatie van e-mailadres en wachtwoord is niet geldig.
                </div>
                <?php } ?>
                <div class="col-12 col-sm-6">
                    <p>Gebruikersnaam:</p>
                </div>
                <div class="col-12 col-sm-6">
                    <input id="username" name="username" type="text"        placeholder="Gebruikersnaam"    required     value="<?php echo if_set('username','post'); ?>"   >
                </div>
                <div class="col-12 col-sm-6">
                    <p>Wachtwoord:</p>
                </div>
                <div class="col-12 col-sm-6">
                    <input id="password" name="password" type="password"    placeholder="Wachtwoord"        required minlength="8">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary float-right">login</button>
                </div>
                <div class="col-12">
                    <p class="bottom-login-register-form">Heeft u nog geen account klik <a class="no-margin" href="registreer.php">hier</a> om te registreren.</p>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
    require_once 'partial/page_footer.php';
?>