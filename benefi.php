<?php
    session_start();
    $token = $_SESSION['token'];
    require_once './composent/hidden/config.php';
    require_once "./composent/database/connect.php";
    require_once "./composent/database/accountscript.php";
    require_once "./composent/security/verif.php";
    list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
            if (!base64_decode($typeencode) == "client") {
                header("location:./index.php");
                return false;
            }
            else {
                $testtoken = "SELECT * FROM token WHERE id = '$token' AND `type` = 'client'";
                $reponse = $conn->query($testtoken);
                if ($reponse->num_rows > 0) {
                    while($row = $reponse->fetch_assoc()) {
                        $nowts = time() + 7200;
                        if ($nowts < $row['expiredat']){$clientid = $row['idclient'];}
                        else {
                            $_SESSION['token'] = null;
                            $_SESSION['error'] = "Votre jeton d'accès à expiré, veuillez vous reconnecter !";
                            header("location:./index.php");
                        }
                    }
                }
                else{header("location:./logout.php");}
            }
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
            <form class="custom-form" action="./composent/database/addbenefic.php" method="POST">
                <h1>Ajout d'un bénéficiaire</h1>
                <div class="form-row form-group" style="height: 80px;"></div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Nom pour le bénéficiaire :&nbsp;</label></div>
                    <div class="col-sm-6 input-column"><input required name="name" class="form-control" type="text"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Numéro de compte :&nbsp;</label></div>
                    <div class="col-sm-6 input-column"><input required name="acountnumber" class="form-control" type="number"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-10 label-column"><label class="col-form-label" for="pawssword-input-field">Je confirme avoir vérifié les informations ci-dessous</label></div>
                    <div class="col-sm-6 col-xl-1 input-column"><input name="verif" required type="checkbox"></div>
                </div><button class="btn btn-light submit-button" type="submit">Ajouter</button>
                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-12 label-column" style="text-align: center;"><label class="col-form-label" for="pawssword-input-field">Après ajout, votre banquier validera votre nouveau bénéficiaire dans les 48h</label></div>
                </div><label for="pawssword-input-field"></label>
            </form>
        </div>
    </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
        <script src="./script.js"></script>
        <?php
                require_once "./composent/template/footer.php";
                $conn->close();
                ?>
    </body>
</html>