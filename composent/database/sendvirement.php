<?php
    session_start();
    require_once('./../hidden/config.php');
    require_once('./../security/verif.php');
    require_once('./accountscript.php');
    require_once('./transact.php');
    require_once('./connect.php');

    $bene = htmlspecialchars($_POST['benefit']);
    $amo = htmlspecialchars($_POST['amount']);
    $tabccount= $_SESSION['cltac'];
    $connac = callac($servername, $username, $password, $dbnameac);
    $accountamount = getamount($connac, $tabccount);
    $viremnpage = "./../../virement.php";    
        if (!isset($bene)){
            errorsender("Le bénéficiaire n'as pas était bien séléctionné",$viremnpage);
            return false;
        }
        else if ( $bene > 999999999 || $bene < 100000000){
            errorsender("Le numéro de compte doit comporter 9 chiffres",$viremnpage);
            return false;
        }
        else if (!isset($amo)){
            errorsender("Le montant ne doit pas être vide",$viremnpage);
            return false;
        }
        else if ($amo > $accountamount){
            errorsender("Le montant ne doit pas être supérieur au montant sur votre compte",$viremnpage);
            return false;
        }
        else if (!verifaccount(cryptaccount($bene), $connac)){

            errorsender("Le compte ".$bene." n'as pas était trouvé",$viremnpage);
            return false;
        } 
        else {
            $bene = cryptaccount($bene);
            $result = virement($connac, $amo, $tabccount,  $bene);
            if ($result){
                $_SESSION['success'] = "Le virement de $amo € a bien était envoyé";
                header("location:".$viremnpage);
            }
            else {
                $_SESSION['error'] = "Une erreur s'es produite = ".$_SESSION['error'];
                header("location:".$viremnpage);
            }
        }
?>