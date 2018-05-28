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

?>

    <main>
        <div class="container">
            <div class="register-section">
                <h1>Veiling starten</h1>
                <form method="Post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                           <?php if (empty($_POST['Rubriek']) or is_null($_POST['Rubriek'])){?>

                               <label for="Rubriek"><strong>Category</strong></label> <br>
                            <select id="Rubriek" name="Rubriek">
                                <option value="4352">Horror en Griezel</option>
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

                            <label for="country"><strong>Land</strong></label>
                            <input id="country" name="country" type="text" placeholder="Nederland" <?php post_set('country', 'post')?> required>
                            <label for="city"><strong>Stad</strong></label>
                            <input id="city" name="city" type="text" placeholder="Arnhem" <?php post_set('city', 'post')?> required>
                            <label for="looptijd"><strong>Looptijd</strong></label><br>
                            <select id="looptijd" name="looptijd">
                                <option value="1">1 Dag</option>
                                <option value="1">3 Dagen</option>
                                <option value="1">5 Dagen</option>
                                <option value="1">7 Dagen</option>
                                <option value="1">10 Dagen</option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="start-price"><strong>Startprijs</strong></label><br>
                            <input class="col-7" min="0" value="100.01" step="0.5" id="start-price" name="start-price" type="number" <?php
                            post_set('start-price', 'post')?> required><br>
                            <label for="paymentmethod"><strong>Betalingswijze</strong></label><br>
                            <select id="paymentmethod">
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
                                      rows="2" <?php post_set('shipment-instructions', 'post')?>></textarea>
                            <?php }?>
                            <button class="btn btn-primary" type="submit">Start veiling</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php
require_once 'partial/page_footer.php';
?>