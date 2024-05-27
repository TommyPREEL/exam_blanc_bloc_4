<?php
    session_start();
    require_once('./../hidden/config.php');
    require_once('./../security/tokgen.php');
    require_once('./../security/verif.php');
    require_once('./connect.php');
    require_once('./accountscript.php');
    $index = "./../../index.php";
    $mail = htmlspecialchars($_POST['mail']);
    $password = md5(htmlspecialchars($_POST['pass']));
        //TODO verification Compte n'as pas déjà un token
        //TODO message connecté
        if(verification($_POST['mail'],$_POST['pass'])){
            $scltmail = "SELECT id FROM client WHERE mail = '$mail' limit 1";
            $scltpasstest = "SELECT id, firstname, lastname,valid,accountnumber FROM client WHERE passmd = '$password' AND mail = '$mail' limit 1";
            $reponse = $conn->query($scltmail);
            if ($reponse->num_rows > 0) {
                $passresponse = $conn->query($scltpasstest);
                if ($passresponse->num_rows > 0) {
                    while($row = $passresponse->fetch_assoc()) {
                        if($row['valid'] == 1){
                            $type = "client";
                        }
                        else{
                            $type = "waiting";
                        }
                        $_SESSION['cltac'] = cryptaccount($row['accountnumber']);
                        $name = $row['lastname']." ".$row['firstname'];
                        $token = tokengenerator($mail,$password,$type,$row['firstname'],$row['lastname']);
                        $id = $row['id'];
                        $expdatetime = time() + 9000;
                        $sql = "INSERT INTO token (id, idclient, `type`, expiredat)
                            VALUES ('$token', '$id', 'client', $expdatetime)";
                        if (mysqli_query($conn, $sql)) {
                            $_SESSION['token'] = $token;
                            $_SESSION['success'] = "Vous êtes connectés M.$name, Bienvenu";
                            header("location:$index");
                        } else {
                            errorsender("Problême lors de l'accès à vos comptes<br> contacter votre banquier si le problême persiste",$index);
                        }
                    }
                }
                else {
                    errorsender("Mot de passe incorrect",$index);
                } 
            }
            else {
                errorsender("l'e-mail : $mail n'est pas reconnu parmis nos clients",$index);
                } 
        }?>