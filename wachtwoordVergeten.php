<?php
require_once 'partial/page_head.php';
require_once 'php/database.php';
require_once 'php/user_functions.php';
?>
    <title>Wachtwoord Vergeten</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';
$question = null;
$questionCorrect = false;
if(isset($_POST['email'])){
    $question = get_user_question($_POST['email'],$db);
}
if(isset($_POST['answer'])){
    $questionCorrect = check_user_answer($_POST['email'] ,$_POST['answer'],$db);
}
if(isset($_POST['nWachtwoord1'])){
    if($_POST['nWachtwoord1'] == $_POST['nWachtwoord2']){
        $password = md5($_POST['nWachtwoord1']);
        if(reset_password($_POST['email'], $password, $db)){
            redirect("login.php");
        }
    }
}
?>

<main>
    <div class="container login">
        <form method="Post" action="">
        <?php if($questionCorrect == false) {?>
            <div class="row login-section">
                <div class="col-12">
                    <h1>Wachtwoord vergeten</h1>
                </div>
                <div class="col-12 col-sm-3">
                    <p>email:</p>
                </div>
                <div class="col-12 col-sm-9">
                    <input id="email" name="email" type="email" placeholder="email" required value="<?php echo if_set('email','post');?>" <?php if(!is_null($question) || !empty($question)) { echo 'readonly'; } ?>>
                </div>
                <?php if(!is_null($question) || !empty($question)) { ?>
                <div class="col-12">
                    <p>
                        <?php echo $question; ?>
                    </p>
                </div>
                <div class="col-12 col-sm-3">
                    <p>Antwoord:</p>
                </div>
                <div class="col-12 col-sm-9">
                    <input id="answer" name="answer" type="text" placeholder="antwoord" required value="<?php echo if_set('answer','post'); ?>"   >
                </div>
                <?php } ?>
                <div class="col-12">
                    <button class="btn btn-primary float-right">Verzenden</button>
                </div>
            </div>
        <?php } else { ?>
            <div class="row login-section">
                <div class="col-12">
                    <h1>Wachtwoord vergeten</h1>
                </div>
                <div class="col-12 col-sm-5">
                    <p>nieuw wachtwoord:</p>
                </div>
                <div class="col-12 col-sm-7">
                    <input id="nWachtwoord1" name="nWachtwoord1" type="password" required  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8." >
                </div>
                <div class="col-12 col-sm-5">
                    <p>nieuw wachtwoord:</p>
                </div>
                <div class="col-12 col-sm-7">
                    <input id="nWachtwoord2" name="nWachtwoord2" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Het wachtwoord moet minimaal 1 nummer, 1 hoofdletter en 1 kleine letter bevatten. Minimum aantal karakters is 8." >
                </div>
                <input id="email" name="email" type="hidden" required value="<?php echo $_POST['email']; ?>">
                <input id="answer" name="answer" type="hidden" required value="<?php echo $_POST['answer']; ?>">
                <div class="col-12">
                    <button class="btn btn-primary float-right">Verzenden</button>
                </div>
            </div>
        <?php } ?>
        </form>
    </div>
</main>

<?php
require_once 'partial/page_footer.php';
?>