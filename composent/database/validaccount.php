<?php
session_start();
$token = $_SESSION['token'];
require_once('./../hidden/config.php');
require_once('./connect.php');
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
require_once('./accountscript.php');
$idaccount = $_GET['idclient'];
if (isset($idaccount)){
    $getaccount = "SELECT accountnumber 
    FROM client 
    WHERE id=$idaccount;";
    //TODO verification compte pro
    //TODO verification idaccount (number)
    //TODO verification clé compte pro via Token
    $client = "SELECT * FROM requestnc WHERE idnewclient = $idaccount";
    $reponse = $conn->query($client);
    if ($reponse->num_rows > 0) {
        $conn->begin_transaction();
        $valitime = date('Y-m-d H:i:s');
        try {
            $conn->query("UPDATE requestnc
            SET valitime = '$valitime', validate = 1
            WHERE idnewclient= $idaccount;");
            $conn->query("UPDATE client
            SET valid = 1, accountnumber = ROUND(RAND() * 1000000000)
            WHERE id = $idaccount;");
        $conn->commit();
        } catch (mysqli_sql_exception $exception) {
            $conn->rollback();

            throw $exception;
        }
        $accountnumber = $conn->query($getaccount);
        if ($accountnumber->num_rows > 0) 
        {
            while($row = $accountnumber->fetch_assoc()) {
                $connac = callac($servername, $username, $password, $dbnameac);
                $account = cryptaccount($row['accountnumber']);
                $virementtab = "v".$account;
                $tableone = "CREATE TABLE $account (id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(150),
                type SET ('Virement','Prelevement','Carte Bleu','Retrait'),
                value BIGINT NOT NULL,
                total BIGINT NOT NULL,
                date DATETIME NOT NULL,
                PRIMARY KEY (id)
                )
                ENGINE=INNODB;";
                $tabletwo = "CREATE TABLE $virementtab (id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(150),
                account VARCHAR(10) NOT NULL,
                valid BOOL DEFAULT false,
                PRIMARY KEY (id)
                )
                ENGINE=INNODB;";
                if (mysqli_query($connac, $tableone)) {
                    if (mysqli_query($connac, $tabletwo)) {
                        $_SESSION['success'] = "Le compte a bien était créer, vous avez un client validé en plus";
                        header("location:./../../banker.php");
                    } 
                    else {
                        $_SESSION['error'] = "Le compte as était créer mais l'accès au virement nécessite une intervention";
                        header("location:./../../banker.php");
                    }
                } 
                else {
                    $_SESSION['error'] = "Le compte n'as pas pu être créer et nécessite une création manuelle<br>".mysqli_error($connac);
                    header("location:./../../banker.php");
                }
            }}
        else{echo "There is nothing here";}
    }
    else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
else
{
    echo "YOU SHOULD NOT PASS !!!"; //A remplacer message error index.php
}
$conn->close()
?>