<!--

-->

<?php
require_once 'partial/page_head.php';
require_once 'php/user_functions.php';
require_once 'php/generic_functions.php';
?>
<title>Jumbotron Template for Bootstrap Lool</title>
</head>

<body>

<?php
include_once 'partial/menu.php';
?>

<main>
    <div class="container">
        <div class="register-section">

           <h2>Feedback formulier</h2>
            <p>U beoordeelt het volgende product: [veilingtitel]</p>
            <p>U beoordeelt het als een: [verkoper/koper]</p>
            <form role="form" method="post" action="#">
                <div class="row">
                    <div class="col-md-6">
                        <label><strong>Uw beoordeling:</strong></label>
                        <p>
                            <label class="radio-inline">
                                <input type="radio" name="experience" id="radio_experience" value="Zeer slecht" >
                                Zeer slecht
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" id="radio_experience" value="Slecht" >
                                Slecht
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" id="radio_experience" value="Gemiddeld" >
                                Gemiddeld
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="experience" id="radio_experience" value="Goed" >
                                Goed
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="experience" id="radio_experience" value="Zeer goed" >
                                Zeer goed
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="comments">
                                            <strong>Opmerkingen:</strong></label>
                        <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="Plaats hier uw opmerking" maxlength="200" rows="7"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">
                            Gebruikersnaam:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Gebruikersnaam" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">
                            Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block" >Post </button>
                    </div>
                </div>

            </form>


            <?php
            if (isset($melding)) {
                echo '<p class="error-message">' . $melding . '</p>';
            }
            ?>
            <p class="bottom-login-register-form">Heeft u al een account klik <a class="no-margin"
                                                                                 href="login.php">hier</a>
                om naar inloggen te gaan</p>

        </div>
    </div>
</main>

<?php
require_once 'partial/page_footer.php';
?>


