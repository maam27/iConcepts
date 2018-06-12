<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
?>
    <title>Statistieken | EenmaalAndermaal</title>
</head>

<?php
include_once 'partial/menu.php';
?>
<?php if (isset($_SESSION['user']) AND $_SESSION['user'] == 'Admin') { ?>
<div class="container">
<iframe width="1100" height="800" src="https://app.powerbi.com/view?r=eyJrIjoiMjM1ZDQ1M2MtMjEzZC00ZjU5LTgxZWItMGEzNTQ4NmE2MGNhIiwidCI6ImI2N2RjOTdiLTNlZTAtNDAyZi1iNjJkLWFmY2QwMTBlMzA1YiIsImMiOjh9" frameborder="0" allowFullScreen="true"></iframe>;
</div>
<?php }
else{
    ?>

    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U bent geen beheerder.</h2>
                <p class="text-center">Daarom heeft U geen toegang tot deze pagina..</p>
            </div>
        </div>
    </main>

<?php }
require_once 'partial/page_footer.php';
?>
