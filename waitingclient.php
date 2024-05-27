<?php
    session_start();
    $token = $_SESSION['token'];
    require_once './composent/hidden/config.php';
    require_once "./composent/database/connect.php";
    list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
            if (!base64_decode($typeencode) == "banker") {
                header("location:./index.php");
                return false;
            }
            else {
                $testtoken = "SELECT * FROM token WHERE id = '$token' AND `type` = 'banker'";
                $reponse = $conn->query($testtoken);
                if ($reponse->num_rows > 0) {
                    while($row = $reponse->fetch_assoc()) {
                        $nowts = time() + 7200;
                        if ($nowts < $row['expiredat']){$bankerid = $row['idbanker'];}
                        else {
                            $_SESSION['token'] = null;
                            $_SESSION['error'] = "tokenexpired";
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
            require_once "./composent/template/header.php";?>
        <main>
        <div class="row register-form">
            <div class="col-md-8 offset-md-2">
                <div class="custom-form">
                <?php
                    $client = "SELECT requestnc.* , client.id AS cltid , client.mail AS cltmail , client.lastname AS cltln , client.firstname AS cltfn , client.adresse AS cltadd , client.postalcode AS cltpc , client.pir AS pir 
                    FROM requestnc 
                    INNER JOIN client 
                    ON requestnc.idnewclient = client.id 
                    WHERE requestnc.idbanker = $bankerid && requestnc.validate = 0";
                    $reponse = $conn->query($client);
                    if ($reponse->num_rows > 0) 
                    {
                        while ($donnees = $reponse->fetch_assoc())
                        {
                            $path = substr(base64_decode($donnees['pir']),4); ?>
                        
                        <div id="banker" class="card cardbanker">
                            <div class="cardbanker card-body " style="border-style: solid;border-radius: 20px;">
                                <h4 class="card-title"><?php echo $donnees['cltln'] . " " . $donnees['cltfn']; ?></h4>
                                <h6 class="text-muted card-subtitle mb-2"><?php echo $donnees['cltadd'] . " " . $donnees['cltpc']; ?></h6>
                                <p class="card-text"><?php echo $donnees['cltmail'] ?> </p>
                                <div>
                                    <img style="max-height: 150px;max-width: 50%; width: auto; height: auto;" src="<?php echo $path?>"/><img style="width: 25%;" />
                                </div>
                                <div style="text-align: right; color: blue;">
                                    <a href="./composent/database/validaccount.php?idclient=<?php echo $donnees['cltid']?>&token=<?php echo $token ?>">Valider</a>
                                </div>
                            </div>
                        </div>
                <?php
                        }
                    }
                    else 
                    {?>
                        <div  class="card cardbankergood">
                            <h1> Félicitation vous avez répondu à toute les demandes </h1>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        </main> 
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
            <script src="./script.js"></script>
            <?php
            require_once "./composent/template/footer.php";
            $conn->close()
            ?>
    </body>
</html>

    