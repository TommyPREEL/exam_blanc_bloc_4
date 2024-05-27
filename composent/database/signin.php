<?php
    session_start();
    require_once('./../hidden/config.php');
    require_once('./../security/tokgen.php');
    require_once('./../security/verif.php');
    require_once('./connect.php');
    $adresse = htmlspecialchars($_POST['adre']);
    $postalcode = htmlspecialchars($_POST['pcode']);
    $born = htmlspecialchars($_POST['born']);
    $fn = htmlspecialchars($_POST['firstname']);
    $ln = htmlspecialchars($_POST['lastname']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = md5(htmlspecialchars($_POST['pass']));
        $index = "location:./../../index.php?page=signin";
        $verif = verifcreation($_POST['mail'],$_POST['pass'],$_POST['adre'],$_POST['pcode'],$_POST['pi'],$_POST['born'],$_POST['firstname'],$_POST['lastname'],$index,$_FILES['pi']);

        if($verif != false){
            if ($_POST['pass'] === $_POST['passverif']){
                if ($_POST['cguvalid']){
                    if (!alreadyexist($mail, $conn)){

                        $idbanker = choosebanker($conn);
                        if ($idbanker === false) {
                            errorsender("Problême lors de la recherche d'un banquier",$index);
                        }
                        $token = tokengenerator($mail,$password,"waiting",$fn,$ln);
                        $sql = "INSERT INTO client (firstname, lastname, adresse, postalcode, pir, mail, passmd, born, idbanker) VALUES ('$fn', '$ln', '$adresse', $postalcode, '$verif', '$mail', '$password', '$born', $idbanker)";
                        if (mysqli_query($conn, $sql)) {
                            
                                $scltmail = "SELECT id FROM client 
                                WHERE mail = '$mail' limit 1";
                                $idnewclient = $conn->query($scltmail);
                                if ($idnewclient->num_rows > 0) {
                                    while($row = $idnewclient->fetch_assoc()) {
                                      $token = tokengenerator($mail,$password,"waiting",$fn,$ln);
                                      $id = $row['id'];
                                      $sql = "INSERT INTO requestnc (idnewclient, idbanker, made) VALUES ($id, $idbanker , NOW())";
                                        if (mysqli_query($conn, $sql)) {
                                            $expdatetime = time() + 9000;
                                            $sql = "INSERT INTO token (id, idclient, `type`, expiredat)
                                                    VALUES ('$token', '$id', 'waiting', $expdatetime)";
                                                if (mysqli_query($conn, $sql)) {
                                                    $_SESSION['token'] = $token;
                                                    $_SESSION['success'] = "Votre compte à bien était créer, votre demande va être étudié dans les plus brefs délais";
                                                    header("location:./../../index.php");
                                                } 
                                                else {
                                                errorsender("Problême lors de la connexion automatique - $sql",$index);
                                                }
                                        }
                                        else{
                                            errorsender("Probleme lors de la création, retentez l'inscription dans 24 heures sans nouvelle de notre part",$index);
                                        }
                                    }
                                }
                                else{
                                errorsender("Compte créer mais identité non trouvé, retentez l'inscription dans 24 heures sans nouvelle de notre part",$index);
                                }
                        }
                        else {
                            errorsender("Problême lors de l'ajout du client. Veuillez retenter",$index);
                        }
                    }
                    else {errorsender("Un compte as déjà était créer grâce à cette adresse, tentez de vous connecter",$index);}
                }
                else{
                    return errorsender("Les conditions générales doivent être accéptée",$index);
                }
            }
            else {
                return errorsender("Le mot de passe et la confirmation doivent être similaire",$index);
            }
            
        }
        else {
            echo "<h1>This page is an error page, you can return to the ZeroBank homepage : <a href='./../../index.php'>here</a>";
        }
?>