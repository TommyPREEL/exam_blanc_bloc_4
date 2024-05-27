<?php
    session_start();
    $token = $_SESSION['token'];
    require_once './composent/hidden/config.php';
    require_once "./composent/database/connect.php";
    require_once "./composent/database/accountscript.php";
    require_once "./composent/security/verif.php";
    require_once "./composent/database/transact.php";
    $clientid = authorizationpage ($conn, $_SESSION['token'],"client");
            $tabccount= $_SESSION['cltac'];
            $tablevir = "v".$tabccount;
            $connac = callac($servername, $username, $password, $dbnameac);
            $accountamount = getamount($connac, $tabccount);
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>0Bank - TEST 1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/header.css">
        <link rel="stylesheet" href="assets/footer.css">
        <link rel="stylesheet" href="assets/formsignin.css">
        <link rel="stylesheet" href="assets/primary.css">
    </head>

    <body>
        <?php
                        if (isset($_SESSION['error'])){require_once "./composent/template/ealerts.php";}
                        if (isset($_SESSION['success'])){require_once "./composent/template/salerts.php";}
                        require_once "./composent/template/header.php";
        ?>
        <div class="row register-form">
            <div class="col-md-8 offset-md-2">
                <form class="custom-form" method="POST" action="./composent/database/sendvirement.php" id="virement" >
                    <h1>Virement</h1>
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-12" style="text-align: right; margin-bottom: 30px;"><strong style="font-size: 18px;">Etat du compte : <br> <strong style="font-size: 18px;padding-left: 10px;"><?php echo $accountamount; ?></strong></>€</strong></strong></div>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Virement Depuis :&nbsp;</label></div>
                        <div class="col-sm-6 input-column"><strong style="font-size: 18px;margin-left: 25%;"><?php echo decryptaccount($tabccount);?></strong></div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Virement Vers :&nbsp;</label></div>
                        <div class="col-sm-6 input-column">
                            <?php
                            $getbenefi = "SELECT * FROM $tablevir WHERE valid = 1";
                            $reponse = $connac->query($getbenefi);
                            if ($reponse->num_rows > 0) { 
                                $benefok = true; ?>
                                <div class="dropdown"><button class="btn btn-light dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button" style="width: 50%;">Bénéficiaire&nbsp;</button>
                                <select name="benefit" id="benefitselect" class="dropdown-menu">
                                <?php
                                while($row = $reponse->fetch_assoc()) {
                                    $namebenefit = $row['name'];
                                    $tabbenefit = $row['account'];
                            ?>
                            <option value="<?php echo $tabbenefit; ?>" class="dropdown-item"><?php echo $namebenefit." - ".$tabbenefit; ?></option>
                            <?php
                                }
                                echo "</select></div>";
                            }
                            else {
                                $benefok = false;
                                echo "<strong style='font-size: 18px;margin-left: 25%;'>Vous n'avez pas encore de bénéficiaire validé</strong>";}
                            // If table is empty set a message
                            ?>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="pawssword-input-field">Montant</label></div>
                        <div class="col-sm-6 input-column"><input class="form-control" name="amount" type="number"></div>
                    </div>
                    <a class="btn btn-light submit-button" href="./benefi.php">Ajouter un bénéficiaire</a>
                    <?php if ($benefok == true){echo '<button class="btn btn-light submit-button" type="submit">Envoyer</button>';} ?>
                </form>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
        <script src="./script.js"></script>
        <?php
                require_once "./composent/template/footer.php";
                $conn->close();
                $connac->close();
                ?>
    </body>
</html>