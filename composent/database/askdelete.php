<?php
    session_start();
    require_once('./../hidden/config.php');
    require_once('./../security/tokgen.php');
    require_once('./../security/verif.php');
    require_once('./connect.php');
    $confirm = htmlspecialchars($_POST['confirmvalid']);
    $piece = htmlspecialchars($_POST['pi']);
        $idclient = authorizationpage($conn, $_SESSION['token'], 'client');
        $accountpage = "location:./../../account.php";
        $filer = $_FILES['pi'];
        if ($confirm == false){errorsender("La confirmation doit être coché pour pouvoir soumettre la requête", $accountpage);}
        elseif (!isset($filer)){errorsender("Le fichier de signature est manquant", $accountpage);}
        elseif ($filer['size'] > 3 * 1024 * 1024){errorsender("Le fichier de signature est trop gros", $accountpage);}
        elseif ($filer['error'] !== 0){errorsender("sur : Le fichier de signature",$accountpage);}
        elseif (isset($filer) &&
            $filer['error'] == 0 &&
            $filer['size'] <= 3 * 1024 * 1024)
            {   
                $idpi = uniqid("pidel",false);
                $infosfichier = pathinfo($filer['name']);
                $ext = $infosfichier['extension'];
                $filername = $filer["tmp_name"];
                if (in_array($ext, array('jpg', 'png')))
                { 
                    if (is_uploaded_file($filer["tmp_name"])) {
                        $idpi = sprintf('/app/assets/privateimg/%s.%s',
                        sha1_file($filer['tmp_name']),
                        $ext);
                        if (move_uploaded_file($filer["tmp_name"],$idpi)) {
                            $filepath = base64_encode($idpi);
                            $sql = "UPDATE requestnc SET askdelete = 1, pjdelete = '$filepath' WHERE idnewclient = $idclient";
                            if (mysqli_query($conn, $sql)) {
                                $_SESSION['success'] = "Demande de suppresion de compte envoyé";
                                header("location:./../../index.php");
                            }
                            else{
                                errorsender("Problème lors de l'envoi de la demande",$accountpage);
                            }
                        } else {
                            errorsender("lors de l'upload du fichier de signature : $filername",$accountpage);
                            return false;
                        }          
                    } else {
                        errorsender("lors de l'uploade du fichier de signature",$accountpage);
                        return false;
                    }
                }
                else{errorsender("Mauvais format de fichier",$accountpage);}
            return false;
            }
        
?>