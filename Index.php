<?php
require_once 'partial/page_head.php';
?>
        <title>Home | EenmaalAndermaal</title>
    </head>
    <body>
        <?php
            include_once 'partial/menu.php';
        ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12 margin-top">
                        <h2>Veilingen die bijna verlopen.</h2>
                    </div>
                    <div class="col-12 seperator-bottom">
                        <div class="d-flex flex-wrap">
                            <?php get_highlighted_products($db,"","LooptijdeindeDag asc, LooptijdeindeTijdstip asc");?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 margin-top">
                        <h2>Recent gestarte veilingen.</h2>
                    </div>
                    <div class="col-12 seperator-bottom">
                        <div class="d-flex flex-wrap ">
                            <?php get_highlighted_products($db,"","LooptijdbeginDag desc, LooptijdbeginTijdstip desc");?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 margin-top">
                        <h2>Uitgelicht.</h2>
                    </div>
                    <div class="col-12 seperator-bottom">
                        <div class="d-flex flex-wrap">
                            <?php get_highlighted_products($db,"","NEWID()",15);?>
                        </div>
                    </div>
                </div>

            </div>
        </main>
<?php require_once 'partial/page_footer.php';?>
