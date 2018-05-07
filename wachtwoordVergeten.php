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
echo $question;
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
                <?php echo $_POST['email']?>
            </div>
        <?php } else { ?>
        <?php } ?>
        </form>
    </div>
</main>

<?php
require_once 'partial/page_footer.php';
?>