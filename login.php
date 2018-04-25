<?php
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
        <h1>Login</h1>
        <form method="Post" action="#">
            <input id="username" name="username" type="email"        placeholder="E-mail"    required><br><br>
            <input id="password" name="password" type="password"    placeholder="Wachtwoord"  required>
            <button>login</button>
        </form>
        <p class="onderkantLoginRegistreer">Heeft u nog geen account klik <a class="no-margin" href="registreer.php">hier</a> om naar registratie te gaan</p>
        </div>

</main>

<?php
    require_once 'partial/page_footer.php';
?>