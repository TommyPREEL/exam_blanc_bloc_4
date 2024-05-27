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
                            header("location:./index.php");}
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
        <main>
        <div class="row register-form">
            <div class="col-md-8 offset-md-2">
                <form class="custom-form" enctype="multipart/form-data" action="composent/database/askdelete.php" method="POST">
                    <h1>Supprimer mon compte</h1>
                    <h4>Veuillez rentrer les informations ci-dessous pour valider la suppression</h4>
                    <div class="form-row form-group">
                        <div class="col-sm-4 col-xl-12 label-column" style="text-align: left;">
                            <label for="pi">Demande manuscrite signé pour valider la suppression<br></label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                            <input class="form-control-file" name="pi" type="file" accept="image/png, image/jpeg" required="required">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="confirmvalid" type="checkbox" id="formCheck-1">
                        <label class="form-check-label" for="confirmvalid" required="required">Je confirme la demande de suppression de mes données</a></label>
                    </div>
                    <button class="btn btn-dark submit-button" type="submit">Supprimer mon compte</button>
                </form>
            </div>
        </div>
</main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
        <script src="./script.js"></script>
        <?php
                require_once "./composent/template/footer.php";
                $conn->close();
                ?>
    </body>
</html>