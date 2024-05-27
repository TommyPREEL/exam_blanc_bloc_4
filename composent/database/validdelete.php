<?php
session_start();
$token = $_SESSION['token'];
require_once('./../hidden/config.php');
require_once('./connect.php');
require_once('./../security/verif.php');
require_once('./accountscript.php');
list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
        if (!base64_decode($typeencode) == "banker") {
            header("location:./../../index.php");
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
            else{header("location:./../../logout.php");}
        }
$page = "./../../waitingdelete.php";
$connac = callac($servername, $username, $password, $dbnameac);
$idaccount = $_GET['idclient'];
if (isset($idaccount)){
    $verifask = "SELECT askdelete, idrequest 
    FROM requestnc 
    WHERE idnewclient=$idaccount;";
    $reponse = $conn->query($verifask);
    if ($reponse->num_rows > 0) {
        while ($donnees = $reponse->fetch_assoc()){
            $requestid = $donnees['idrequest'];
            if($donnees['askdelete'] == 0){errorsender("Ce client n'as pas demandé de suppression de compte",$page);}
            else{
                $accounttab = cryptaccount($_GET["account"]);
                $vaccouttab = "v".$accounttab;
                $sql = "DROP TABLE $accounttab";
                if (mysqli_query($connac, $sql)) {
                    $sqld = "DROP TABLE $vaccouttab";
                    if (mysqli_query($connac, $sqld)) {
                        $conn->begin_transaction();
                            try {
                                $conn->query("UPDATE requestnc 
                                SET idnewclient = null, `delete` = 1
                                WHERE idrequest = $requestid");
                                $conn->query("DELETE FROM token WHERE idclient = $idaccount");
                                $conn->query("DELETE FROM client WHERE id = $idaccount");
                                $conn->commit();
                            } catch (mysqli_sql_exception $exception) {
                            $conn->rollback();

                            throw $exception;
                            }
                            
                            $_SESSION['success'] = "La suppression à bien était éffectuée";
                            header("location:$page");
                    }
                    else  {errorsender("Lors de la suppression de la table Virement",$page);}
                }
                else {errorsender("Lors de la suppression de la table Account : $vaccouttab",$page);}
            }
        }
    }
    else {errorsender("Compte introuvable",$page);}
}
else
{
    errorsender("Vous n'avez pas accès à cette page","./../../index.php");
}
$conn->close()
?>