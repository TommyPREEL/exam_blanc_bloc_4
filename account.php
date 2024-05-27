<?php
    session_start();
    $token = $_SESSION['token'];
    require_once './composent/hidden/config.php';
    require_once "./composent/database/connect.php";
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
                        if ($nowts < $row['expiredat']){$clientid = $row['clientid'];}
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
        <link rel="stylesheet" href="assets/primary.css">
    </head>

    <body>
    <?php
                    if (isset($_SESSION['error'])){require_once "./composent/template/ealerts.php";}
                    if (isset($_SESSION['success'])){require_once "./composent/template/salerts.php";}
                    require_once "./composent/template/header.php";
    ?>
        <div class="container">
            <div class="row">
                <?php
                            $connac = callac($servername, $username, $password, $dbnameac);
                            $lasttotal = "SELECT total FROM ".$_SESSION['cltac']." ORDER BY date DESC LIMIT 1";
                            $history = "SELECT * FROM ".$_SESSION['cltac']." ORDER BY date DESC LIMIT 15";
                            $accountmont = $connac->query($lasttotal);
                            if ($accountmont->num_rows > 0) 
                            {
                                while ($actmtn = $accountmont->fetch_assoc())
                                { ?>
                                    <div class="col-md-5 offset-md-8" style="text-align: right;font-size: 38px;"><strong><?php echo $actmtn['total']/100; ?>€</strong></div>
                                <?php
                                }
                            }
                            else {?>
                                    <div class="col-md-5 offset-md-8" style="text-align: right;font-size: 38px;"><strong>0,00€</strong></div>
                                <?php } ?>
            </div>
            <div class="row" style="height: 60px;"></div>
            <div class="row" style="text-align: center;font-size: 15px;">
                                <div class="col-md-2"><strong>Type</strong></div>
                                <div class="col-md-2"><strong>Date</strong></div>
                                <div class="col-md-4"><strong>Denomination</strong></div>
                                <div class="col-md-2"><strong>Montant</strong></div>
                                <div class="col-md-2"><strong>Situation du compte</strong></div>
            </div>
            <div class="row" style="height: 10px;background: #000000;border-top-style: solid;border-bottom-width: 3px;border-bottom-style: solid;"></div>
                            <?php
                            $historys = $connac->query($history);
                            if ($historys->num_rows > 0) 
                            {
                                while ($acthst = $historys->fetch_assoc())
                                { ?>
            <div class="row" style="border-bottom: 2px solid black;text-align: center;">
                    <div class="col-md-2"><p><?php echo $acthst['type']; ?></p></div>
                    <div class="col-md-2"><p><?php echo substr($acthst['date'], 0, 10); ?></p></div>
                    <div class="col-md-4"><p><?php echo $acthst['name']; ?></p></div>
                    <div class="col-md-2"><strong><?php echo $acthst['value']/100; ?>€</strong></div>
                    <div class="col-md-2" style="padding-top: auto;padding-bottom: auto;"><p><?php echo $acthst['total']/100; ?>€</p></div>
            </div>
            <?php
                    }
                }
                else {
                ?>
            <div class="row">
                    <div class="col-md-4" style="text-align: center;"><strong>Il semblerait qu'il n'y ai encore rien à afficher <?php echo $_SESSION['cltac']; ?></strong></div>
            </div>
            <?php
                }?>
               
            
        
        </div>
        <?php
            require_once "./composent/template/footer.php";
            $conn->close();
            $connac->close();
            ?>
    </body>
</html>
