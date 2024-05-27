<?php
    session_start();
    require_once('./../hidden/config.php');
    require_once('./../security/tokgen.php');
    require_once('./../security/verif.php');
    require_once('./connect.php');
    $mail = htmlspecialchars($_POST['mail']);
    $password = md5(htmlspecialchars($_POST['pass']));
        //TODO verification Compte n'as pas déjà un token
        //TODO message connecté
    $index = "./../../index.php";
        if(verification($_POST['mail'],$_POST['pass'])){
            $scltmail = "SELECT id FROM banker WHERE mail = '$mail' limit 1";
            $scltpasstest = "SELECT id, firstname, lastname FROM banker WHERE passmd = '$password' AND mail = '$mail' limit 1";
            $reponse = $conn->query($scltmail);
            if ($reponse->num_rows > 0) {
                $passresponse = $conn->query($scltpasstest);
                if ($passresponse->num_rows > 0) {
                    while($row = $passresponse->fetch_assoc()) {
                        $type = "banker";
                        $name = $row['lastname']." ".$row['firstname'];
                        $token = tokengenerator($mail,$password,$type,$row['firstname'],$row['lastname']);
                        $id = $row['id'];
                        $now = new DateTime();
                        $expdatetime = date_timestamp_get($now) + 14400;
                        $sql = "INSERT INTO token (id, idbanker, `type`, expiredat)
                            VALUES ('$token', '$id', 'banker', $expdatetime)";
                        if (mysqli_query($conn, $sql)) {
                            $_SESSION['token'] = $token;
                            $_SESSION['success'] = "Vous êtes connectés M.$name, Bienvenu <br>Compte Banquier";
                            header("location:./../../banker.php");
                        } else {
                            errorsender("Problême lors de la génération et mise en place du jeton d'accès<br> contacter votre administrateur réseau si le problême persiste",$index);
                        }
                    }
                }
                else {
                    errorsender("Mot de passe incorrect",$index);
                } 
            }
        else {
            errorsender("l'e-mail : $mail n'est pas reconnu parmis nos employés",$index);
            } 
        }
    $conn->close()?>