<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
?>
    <title>Login | EenmaalAndermaal</title>
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
                $pass = md5($_POST['password']);
                if (login_user($db, $_POST['username'], $pass)) {
                    redirect("index.php");
                }
            }
        }
    }
}
if(empty($_SESSION['user'])){
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
                    De combinatie van gebruikersnaam en wachtwoord is onjuist.
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
                    <input id="password" name="password" type="password"    placeholder="Wachtwoord"   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8."    required minlength="8">
                </div>
                <div class="col-12 col-sm-8">
                    <a href="wachtwoordvergeten.php">wachtwoord vergeten?</a>
                </div>
                <div class="col-12 col-sm-4">
                    <button class="btn btn-primary float-right">login</button>
                </div>
                <div class="col-12">
                    <p class="bottom-login-register-form">Heeft u nog geen account klik <a class="no-margin" href="registreer.php">hier</a> om te registreren.</p>
                </div>
            </div>
        </form>
    </div>
</main>
<?php }
else {
    ?>

    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U bent al ingelogd en kan niet nog een keer inloggen. </h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
            </div>
        </div>
    </main>
    <?php
}
    require_once 'partial/page_footer.php';
?>
