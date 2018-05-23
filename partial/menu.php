<?php
if( !isset($_SESSION)){
    session_start();
}
?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <a href="Index.php"><img src="images/Logo.png" alt="eenmaalandermaal logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarCollapse">
        <ul class="navbar-nav mr-auto d-flex justify-content-around align-items-center">
            <li class="nav-item">
                <a href="index.php"><i class="fa fa-home"></i> Thuispagina<span class="sr-only">(current)</span></a>
            </li>
            <li>
                <form class="form-inline mt-2 mt-md-0 d-flex flex-row flex-nowrap" method="get" action="categorie.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Vul hier zoektermen in" aria-label="Search" name="search">
                    <button class="btn my-2 my-sm-0" type="submit">Zoeken</button>
                </form>
            </li>
            <?php
            if(!isset($_SESSION['user'])) {
            ?>

                <li class="nav-item">

                    <a href="login.php"><i class="fa fa-sign-in-alt"></i> Inloggen</a>
                    /
                    <a href="registreer.php"><i class="fa fa-user-plus"></i> Registreren</a>
                </li>


            <?php
                } else{
                ?>
                <li class="nav-item">
                    <a href="Gebruikersprofiel.php"><i class="fa fa-address-card"></i> Mijn profiel</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Uitloggen</a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>

<div class="d-none d-lg-block submenu">
    <ul class="navbar-nav mr-auto d-flex flex-row flex-wrap justify-content-around">
        <li><a class="text-black-50" href="<?php echo $row ['Rubrieknaam'];?>"><?php echo $row ['Rubrieknaam'];?></a></li>
        <li><a class="text-black-50" href="#">Category2</a></li>
        <li><a class="text-black-50" href="#">Category3</a></li>
        <li><a class="text-black-50" href="#">Category4</a></li>
        <li><a class="text-black-50" href="#">Category5</a></li>
        <li><a class="text-black-50" href="#">Category6</a></li>
        <li><a class="text-black-50" href="#">Category7</a></li>
        <li><a class="text-black-50" href="#">Category8</a></li>
    </ul>
</div>



