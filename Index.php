<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--<link rel="icon" href="favicon.ico">-->

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
            <br><br><br>
            <div class="container">
                <div class="row">
                    <h2>Veilingen die bijna verlopen.</h2>
                    <div class="col-12">
                        <div class="d-flex justify-content-around flex-wrap">
                            <div class="" style="background:salmon;width:200px;">altijd</div>
                            <div class="" style="background:salmon;width:200px;">altijd</div>
                            <div class="d-none d-md-block" style="background:salmon;width:200px;">tablet+</div>
                            <div class="d-none d-lg-block" style="background:salmon;width:200px;">laptop+</div>
                            <div class="d-none d-xl-block" style="background:salmon;width:200px;">large monitors+</div>
                        </div>
                    </div>
                </div>
            </div>






            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3">Hello, world!</h1>
                    <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
                </div>
            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <div class="col-md-4">
                        <h2>Heading</h2>
                        <p>.idea be gone? Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Heading</h2>
                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>

                <hr>

            </div> <!-- /container -->

        </main>

        <footer class="container">
            <p>&copy; Company 2017-2018</p>
        </footer>
        <?php
            include_once 'partial/scripts.php';
        ?>
    </body>
</html>
