<?php
require_once 'partial/page_head.php';
?>
    <title>Jumbotron Template for Bootstrap</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';

if(empty( $_SESSION['user'])){
    redirect('login.php');
}


$statement = $db->prepare("SELECT * FROM Gebruiker where Gebruikersnaam = :gebruiker");
$statement->execute(array(':gebruiker' => $_SESSION['user']));
$data1 = $statement->fetch();

?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12 margin-bottom-50 margin-top-50 user-section">
                    <p><strong>Gebruikersnaam:</strong>
                        <?php echo $data1['Gebruikersnaam']; ?>
                    </p>
                    <p><strong>Voornaam:</strong>
                        <?php echo $data1['Voornaam']; ?>
                    </p>
                    <p><strong>Achternaam:</strong>
                        <?php echo $data1['Achternaam']; ?>
                    </p>
                    <p><strong>Adresregel1:</strong>
                        <?php echo $data1['Adresregel1']; ?>
                    </p>
                    <p><strong>Adresregel2:</strong>
                        <?php echo $data1['Adresregel2']; ?>
                    </p>
                    <p><strong>Postcode:</strong>
                        <?php echo $data1['Postcode']; ?>
                    </p><p><strong>Plaatsnaam:</strong>
                        <?php echo $data1['Plaatsnaam']; ?>
                    </p>
                    <p><strong>Land:</strong>
                        <?php echo $data1['Land']; ?>
                    </p>
                    <p><strong>Geboortedag:</strong>
                        <?php
                        $date = new DateTime($data1['GeboorteDag']);
                        $result = $date->format('d-m-Y');
                        echo $result ?>
                    </p>
                    <p><strong>Mailbox:</strong>
                        <?php echo $data1['Mailbox']; ?>
                    </p><p><strong>Verkoper:</strong>
                        <?php
                        if($data1['Verkoper'] == 0){
                            echo 'Nee';
                            }
                            else{
                            echo 'Ja';
                            }
                            ?>
                    </p>
                </div>
            </div>
        </div>
    </main>

<?php
require_once 'partial/page_footer.php';
?>