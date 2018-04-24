<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

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
        <form class="form-inline mt-2 mt-md-0 d-flex flex-row flex-nowrap">
            <input class="form-control mr-sm-2" type="text" placeholder="Vul hier zoektermen in" aria-label="Search">
            <button class="btn my-2 my-sm-0" type="submit">Zoeken</button>
        </form>
    </div>
</main>

<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>
<?php
include_once 'partial/scripts.php';
?>
</body>
</html>
