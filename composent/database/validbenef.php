<?php
session_start();
$token = $_SESSION['token'];
require_once('./../hidden/config.php');
require_once('./connect.php');
require_once('./accountscript.php');
require_once('./../security/verif.php');
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
                $bankerid = $row['idbanker'];
                }
            }
            else{header("location:./logout.php");}
        }
        $page = "./../../waitingbenef.php";
$idrequest = $_GET['idrequest'];
$connac = callac($servername, $username, $password, $dbnameac);
if (isset($idrequest)){
    $getaccount = "SELECT accountbenef 
    FROM requestben 
    WHERE idrequest=$idrequest;";
    $reponse = $conn->query($getaccount);
    if ($reponse->num_rows > 0) {
        while($row = $reponse->fetch_assoc()) {
            $account = $row['accountbenef'];
            $verif = verifaccount(cryptaccount($account),$connac );
            if ($verif == true){
                $sqlrb = "UPDATE requestben
                SET validate = 1
                WHERE idrequest=$idrequest";
                if (mysqli_query($conn, $sqlrb)) {
                    $accounttab = "v".cryptaccount($_GET['client']);
                    $sqlva = "UPDATE $accounttab
                    SET valid = 1
                    WHERE account=$account";
                    if (mysqli_query($connac, $sqlva)) {
                                $_SESSION['success'] = "Le bénéficiaire a bien était ajouté";
                                header("location:$page");
                    } else {
                        errorsender("Problême lors de la validation côté client",$page);
                    }
                } else {
                    errorsender("Problême lors de la validation du bénéficiaire",$page);
                }
            }
            else {
                errorsender("$idrequest : Le compte du bénéficiaire n'existe pas :".cryptaccount($account),$page);
            }
            }
    }
    else {
        errorsender("Requête non trouvée",$page);
    }
}
else
{
    errorsender("Vous n'avez pas accès à cette page","./../../index.php");
}
$conn->close()
?>