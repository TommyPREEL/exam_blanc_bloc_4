<?php
    function emptyvalue($value, $key, $location){
        if(!isset($value) || $value == "")
        {
            $_SESSION['error'] = "Le champ ".$key." est manquant";
            $_SESSION['value'] = $value;
            header($location);
            return false;
        }
        else {
            return true;
        };
    }
    function alreadyexist ($mail,$conn){
        $scltmail = "SELECT * FROM client 
                    WHERE mail = '$mail'";
        $reponse = $conn->query($scltmail);
            if ($reponse->num_rows > 0) {return true;} 
            else {return false;}
    }
    function verification ($mail , $pass){
        return true;
        $majuscule = preg_match('@[A-Z]@', $pass);
        $minuscule = preg_match('@[a-z]@', $pass);
        $chiffre = preg_match('@[0-9]@', $pass);
        if(!isset($mail) || $mail == "")
        {
            $_SESSION['error'] = "L'adresse e-mail est manquante";
            $_SESSION['value'] = $mail;
            header("location:./../../index.php");
            return false;
        }
        else if (!isset($pass) || $pass == ""){
            $_SESSION['error'] = "Le mot de passe est manquant";
            $_SESSION['value'] = $pass;
            header("location:./../../index.php");
            return false;
        }
        else {
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $_SESSION['error'] = "Le format de l'email $mail n'es pas bon";
                $_SESSION['value'] = $mail;
                header("location:./../../index.php");
                return false;
            }
            else if (!$majuscule || !$minuscule || !$chiffre || strlen($pass) < 8){
                $_SESSION['error'] = "Le format du mot de passe n'es pas bon ( au moins 1 min, 1 Maj et 1 chiffre pour plus de 8 lettres";
                $_SESSION['value'] = $pass;
                header("location:./../../index.php");
                return false;
            }
            else {
                return true;
            }
        }
    };
    function errorsender($error,$page){
        $_SESSION['error'] = $error;
        header("location:$page");
        return false;
    }
    function errorsenderval($error,$value,$page){
        $_SESSION['error'] = $error;
        $_SESSION['value'] = $value;
        header("location:$page");
        return false;
    }
    function verifcreation ($mail , $pass, $adresse, $postalcode, $file, $naissance, $prenom, $nom,$index,$filer){
        $majuscule = preg_match('@[A-Z]@', $pass);
        $minuscule = preg_match('@[a-z]@', $pass);
        $chiffre = preg_match('@[0-9]@', $pass);
        if(emptyvalue($mail, "mail",$index) && emptyvalue($pass, "pass",$index) && emptyvalue($adresse, "adresse",$index) && emptyvalue($postalcode, "code postal",$index) && emptyvalue($prenom, "prenom",$index) && emptyvalue($nom, "nom",$index))
        {
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                errorsender("Le format de l'email $mail n'es pas bon", $index);
                return false;
            }
            else if (!$majuscule || !$minuscule || !$chiffre || strlen($pass) < 8){
                errorsender("Le format du mot de passe n'es pas bon ( au moins 1 min, 1 Maj et 1 chiffre pour plus de 8 lettres", $index);
                return false;
            }
            else if (preg_match('@[0-9]@',$prenom)||preg_match('@[0-9]@',$nom))
            {
                errorsender("Le prénom et le nom ne contienne pas de chiffre",$index);
                return false;
            }
            elseif (!isset($filer)){errorsender("Fichier manquant", $index);}
            elseif ($filer['size'] > 3 * 1024 * 1024){errorsender("Fichier trop gros", $index);}
            elseif ($filer['error'] !== 0){errorsenderval("Pendant le chargement de la pièce", $filer['error'],$index);}
            elseif (isset($filer) &&
                $filer['error'] == 0 &&
                $filer['size'] <= 3 * 1024 * 1024)
            {   
                $idpi = uniqid("piid",false);
                $infosfichier = pathinfo($filer['name']);
                $ext = $infosfichier['extension'];
                if (in_array($ext, array('jpg', 'pdf', 'png')))
                { 
                    if (is_uploaded_file($filer["tmp_name"])) {
                        $idpi = sprintf('/app/assets/privateimg/%s.%s',
                        sha1_file($filer['tmp_name']),
                        $ext);
                        if (move_uploaded_file($filer["tmp_name"],$idpi)) {
                            return base64_encode($idpi);
                        } else {
                            errorsender("Problême lors du chargement de la pièce",$index);
                            return false;
                        }          
                    } else {
                        errorsender("Problême lors du chargement de la pièce",$index);
                        return false;
                    }
                }
                else{errorsender("Problême de format de fichier, seul les images JPG et PNG sont accepté",$index);}
                return false;
            }
            else {return false;};
        }
        else {return false;};
    }
    function verifaccount($table, $conn){
        $sql = "SHOW TABLES FROM account";
        $query = $conn->query($sql);
        
        $tables = array();
        while($row = mysqli_fetch_row($query)){
            $tables[] = $row[0];
        }
        
        if(in_array($table, $tables)){
            return TRUE;
        }
        else { return false;}
    }
    function verifbenef ($benef , $name, $verif ,$connac , $beneftable){
        $benefpage = "location:./../../benefi.php";
        if (!emptyvalue($benef, "numéro de compte", $benefpage) || !emptyvalue($name, "nom du compte", $benefpage)){
            errorsender("Tous les champs doivent être rempli",$benefpage);
            return false;
        }
        else if (preg_match('@[0-9]@',$prenom)){
            errorsender("Le nom ne doit pas contenir de chiffre",$benefpage);
            return false;
        }
        else if (isNaN($benef)){
            errorsender("Le numéro de compte n'est constitué que de chiffre",$benefpage);
            return false;
        }
        else if (!$verif){
            errorsender("La vérification doit être cochée",$benefpage);
            return false;
        }
        else if (!verifaccount($beneftable,$connac)){
            errorsender("Compte non trouvé parmis nos clients",$benefpage);
            return false;
        }
        return true;
    }
    function authorizationpage ($conn, $token, $type){
        list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$token);
            if (!base64_decode($typeencode) == $type) {
                header("location:./index.php");
                return false;
            }
            else {
                $testtoken = "SELECT * FROM token WHERE id = '$token' AND `type` = '$type'";
                $reponse = $conn->query($testtoken);
                if ($reponse->num_rows > 0) {
                    while($row = $reponse->fetch_assoc()) {
                        $nowts = time() + 7200;
                        if ($nowts < $row['expiredat']){
                            return $row['idclient'];
                        }
                        else {
                            $_SESSION['token'] = null;
                            $_SESSION['error'] = "Votre jeton d'accès à expiré, veuillez vous reconnecter !";
                            header("location:./index.php");
                        }
                    }
                }
                else{
                    header("location:./logout.php");
                }
            }
    }
    function choosebanker ($conn){
        require_once "./../database/accountscript.php";
        $bankertake = array();
        $listbanker = "SELECT id FROM banker";
        $bankerlist = $conn->query($listbanker);
                if ($bankerlist->num_rows > 0) {
                    while($row = $bankerlist->fetch_assoc()) {
                        $bankerid = $row['id'];
                        $nbclient = calc($conn, "requestnc", "idbanker = $bankerid AND validate = 0", "validate");
                        if ($nbclient === false){return false;}
                        $bankertake[$bankerid] = $nbclient;
                    }
                }
                else {return false;}
                $goodvalue = min($bankertake);
                $result = array_search($goodvalue, $bankertake);
                return $result;


    }
?>
