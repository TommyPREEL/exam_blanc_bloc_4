<?php
    session_start();
    require_once('./../hidden/config.php');
    require_once('./../security/verif.php');
    require_once('./accountscript.php');
    require_once('./transact.php');
    require_once('./connect.php');

    $name = htmlspecialchars($_POST['name']);
    $acountnumber = htmlspecialchars($_POST['acountnumber']);
    $verif = htmlspecialchars($_POST['verif']);
    $connac = callac($servername, $username, $password, $dbnameac);
    $tabbenef = cryptaccount($accountnumber);
    $benefpage = "./../../benefi.php";
    $clientid = authorizationpage ($conn, $_SESSION['token'],"client");
    $tabfrom = "v".$_SESSION['cltac'];

    $intelclient = "SELECT idbanker, accountnumber FROM client WHERE id = $clientid";
    $reponse = $conn->query($intelclient);

    

    if ($reponse->num_rows > 0) { 
        while($row = $reponse->fetch_assoc()) {
            $bankerid = $row['idbanker'];
            $account = $row['accountnumber'];
        }
        $benefpage = "location:./../../benefi.php";
        if (emptyvalue($_POST['acountnumber'], "numéro de compte", $benefpage) && emptyvalue($_POST['name'], "nom du compte", $benefpage)){
            if (is_nan($_POST['acountnumber'])){
                errorsender("Le numéro de compte n'est constitué que de chiffre",$benefpage);
                return false;
            }
            else if (!$verif){
                errorsender("La vérification doit être cochée",$benefpage);
                return false;
            }
            else if (strlen($name) > 150){
                errorsender("Le nom que vous avez renseigner est trop long / Maximum 150 caractères",$benefpage);
                return false;
            }
            else if ( $acountnumber > 999999999 || $acountnumber < 100000000){
                errorsender("Le numéro de compte doit comporter 9 chiffres",$benefpage);
                return false;
            }
            else{
                $queryexist = "SELECT name FROM vdewwffqsq WHERE account = $acountnumber";
                $reponse = $connac->query($queryexist);
                if ($reponse->num_rows > 0) {  
                    while($row = $reponse->fetch_assoc()) {
                    $_SESSION['error'] = "Bénéficiaire déjà enregistré sous le nom : ".$row['name'];
                    }
                    header("location:".$benefpage);
                }
                else{
                    $result = addbenef($conn,$connac, $tabfrom, $clientid, $bankerid, $acountnumber,$name);
                    $_SESSION['result'] = $result;
                    if ($result){
                        $_SESSION['success'] = "Le bénéficiaire $name a bien était ajouté <br> Votre conseiller vous le validera au plus vite";
                        header("location:".$benefpage);
                    }
                    else {
                        header("location:".$benefpage);
                    }      
                }
            }
        }
        else{
            $_SESSION['error'] = "Tous les champs doivent être rempli";
            header("location:".$benefpage);
        }
        
    }
    else {
        $_SESSION['error'] = "Problême lors de la récupération des informations utilisateurs<br> Veuillez nous excusez pour la gène occasionnée";
        header("location:".$benefpage);
    }
     
?>