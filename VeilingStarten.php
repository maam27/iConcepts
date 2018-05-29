<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
?>
<title>Veiling starten | EenmaalAndermaal</title>
</head>

<body>
<?php
include_once 'partial/menu.php';
$succesvolletoevoeging = false;
if(!empty($_POST['voorwerp-titel'])){
echo print_r($_POST);
if(add_auction($db, $_POST['voorwerp-titel'], $_POST['beschrijving'], $_POST['looptijd'], $_POST['country'], $_POST['city'], $_POST['start-price'], $_POST['paymentmethod'], $_POST['payment-instructions'],
            $_POST['shipment-cost'], $_POST['shipment-instructions'], $_SESSION['user'], ($voorwerpnummer = get_highest_auction_number($db) + 1))){
    $succesvolletoevoeging = true;
    add_auction_to_category($db, $voorwerpnummer, $_POST['Rubriek']);
    if( $_POST['Rubriek2'] != 'Geen' AND $_POST['Rubriek'] != $_POST['Rubriek2']){
        add_auction_to_category($db, $voorwerpnummer, $_POST['Rubriek2']);
    }
  }
}
if(empty($_SESSION['user'])){?>

    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U bent niet ingelogd.</h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
                <p class="text-center">Klik <a href="login.php">hier</a> om in te loggen.</p>
            </div>
        </div>
    </main>

<?php
}

else if(!check_if_seller($db, $_SESSION['user'])){ ?>

    <main>
        <div class="container error-box d-flex flex-row justify-content-center align-items-center">
            <div>
                <h2 class="error-message text-center">U bent geen verkoper.</h2>
                <p class="text-center">Als u denkt dat dit een fout is neem <a href="OverOns.php">contact</a> op met de beheerders.</p>
                <p class="text-center">U kunt een verkoperaanvraag doen op u profielpagina.</p>
            </div>
        </div>
    </main>

<?php
}

else if($succesvolletoevoeging){
    ?>
<main>
    <div class="container error-box d-flex flex-row justify-content-center align-items-center">
        <div>
            <h2 class="error-message text-center">Het is gelukt!</h2>
            <p class="text-center">De veiling die u heeft gestart is succesvol toegevoegd.</p>
            <p class="text-center">Klikt u <a href="Veilingspagina.php?voorwerp=<?php echo get_highest_auction_number($db)?>">hier</a> om naar de pagina te gaan.</p>
        </div>
    </div>
</main>

<?php
}

else{
?>


    <main>
        <div class="container">
            <div class="register-section">
                <h1>Veiling starten</h1>
                <?php
                if(empty($_POST['Rubriek'])){
                    echo '<p>Kies hier maximaal twee rubrieken die bij u product horen</p>';
                }
                ?>
                <form method="Post" action="#" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                           <?php if (empty($_POST['Rubriek']) or is_null($_POST['Rubriek'])){?>

                               <label for="Rubriek"><strong>Category</strong></label> <br>
                            <select id="Rubriek" name="Rubriek">
                                <option value="4352">Horror en Griezel</option>
                            </select>
                               <br><br>
                               <label for="Rubriek2"><strong>Category</strong></label> <br>
                               <select id="Rubriek2" name="Rubriek2">
                                   <option value="Geen">n.v.t.</option>
                                   <option value="4352">Horror en Griezel</option> <!-- loop voor alle categorieën -->
                               </select>
                               <br>
<?php } else {

                           ?>
                            <label for="voorwerp-titel"><strong>Titel</strong></label>
                            <input id="voorwerp-titel" name="voorwerp-titel" type="text" placeholder="Bureaustoel" <?php post_set('voorwerp-titel', 'post')?> required>
                            <label for="beschrijving"><strong>Beschrijving:</strong></label>
                            <textarea class="form-control" name="beschrijving" id="beschrijving"
                                      placeholder="Hier komt de door U geschreven beschrijving van het te veilen product staan." maxlength="4000"
                                      rows="5" <?php post_set('beschrijving', 'post')?>></textarea>
                            <label for="looptijd"><strong>Looptijd</strong></label><br>
                            <select id="looptijd" name="looptijd">
                                <option value="1">1 Dag</option>
                                <option value="1">3 Dagen</option>
                                <option value="1">5 Dagen</option>
                                <option value="1">7 Dagen</option>
                                <option value="1">10 Dagen</option>
                            </select><br>
                            <!---
                            <label for="image-1"><strong>Afbeelding 1</strong></label>
                            <input type="file" name="image" id="image-1" required>
                            <label for="image-2"><strong>Afbeelding 2</strong></label>
                            <input type="file" name="images[]" id="image-2">
                            <label for="image-3"><strong>Afbeelding 3</strong></label>
                            <input type="file" name="images[]" id="image-3">
                            <label for="image-4"><strong>Afbeelding 4</strong></label>
                            <input type="file" name="images[]" id="image-4"> -->

                        </div>
                        <div class="col-md-6">
                            <label for="country"><strong>Land</strong></label>
                            <input id="country" name="country" type="text" placeholder="Nederland" <?php post_set('country', 'post')?> required>
                            <label for="city"><strong>Stad</strong></label>
                            <input id="city" name="city" type="text" placeholder="Arnhem" <?php post_set('city', 'post')?> required>
                            <label for="start-price"><strong>Startprijs</strong></label><br>
                            <input class="col-7" min="0" value="0"  id="start-price" name="start-price" type="number" <?php
                            post_set('start-price', 'post')?> required><br>
                            <label for="paymentmethod"><strong>Betalingswijze</strong></label><br>
                            <select name="paymentmethod" id="paymentmethod">
                                <option value="AfterPay">Afterpay</option>
                                <option value="Ideal">Ideal</option>
                                <option value="Creditcard">Creditcard</option>
                                <option value="PayPal">PayPal</option>
                            </select><br>
                            <label for="payment-instructions"><strong>Betaalinstructie</strong></label>
                            <textarea class="form-control" name="payment-instructions" id="payment-instructions"
                                      placeholder="Hier zet u de betaalinstructies neer" maxlength="100"
                                      rows="2" <?php post_set('payment-instructions', 'post')?>></textarea>
                            <label for="shipment-cost"><strong>Verzendkosten</strong></label><br>
                            <input class="col-7" <?php post_set('shipment-cost', 'post') ?>id="shipment-cost" name="shipment-cost" type="number" min="0" value="0" step="0.5"><br>
                            <label for="shipment-instructions"><strong>Betaalinstructie</strong></label>
                            <textarea class="form-control"  name="shipment-instructions" id="shipment-instructions"
                                      placeholder="Hier zet u de verzendinstructies  neer" maxlength="100"
                                      rows="2" <?php post_set('shipment-instructions', 'post')?>></textarea><br>
                            <input id="Rubriek" name="Rubriek" type="hidden" required value="<?php echo $_POST['Rubriek']; ?>">
                            <input id="Rubriek2" name="Rubriek2" type="hidden" required value="<?php echo $_POST['Rubriek2']; ?>">
                            <?php }?>
                            <button class="btn btn-primary" type="submit">Start veiling</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php }
require_once 'partial/page_footer.php';
?>