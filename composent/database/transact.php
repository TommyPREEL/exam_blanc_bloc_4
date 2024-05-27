<?php
    function offer($conn , $amount, $reason, $lasttotal, $account ){
        $sql = "INSERT INTO $account (name,`type`,value,total,`date`)
        VALUES ('OFFER : $reason','Virement',$amount,$lasttotal + $amount,NOW());";
            if (mysqli_query($conn, $sql)) {
                return true;
            } else {
                return false;
            }
    }
    function virement($conn , $amount, $from, $to){
        $fromac = decryptaccount($from);
        $toac = decryptaccount($to);
        $virementpage = "location:./../../virement.php";
        $totalfromer = "SELECT total FROM $from ORDER BY id DESC LIMIT 1";

        $totaltoer = "SELECT total FROM $to ORDER BY id DESC LIMIT 1";
        
        $fromrsp = $conn->query($totalfromer);
        if ($fromrsp->num_rows > 0) {
            while($rowfr = $fromrsp->fetch_assoc()) {
                $totalf = $rowfr['total'];
                $torsp = $conn->query($totaltoer);
                if ($torsp->num_rows > 0) {
                    while($rowto = $torsp->fetch_assoc()) {
                        $totalt = $rowto['total'];
                        $conn->begin_transaction();
                        $valitime = date('Y-m-d H:i:s');
                        if($amount < $totalf/100){
                            try {
                                $amount = $amount * 100;
                                $conn->query("INSERT INTO $from (name,`type`,value,total,`date`)
                                VALUES ('Virement vers : $toac','Virement',-$amount,$totalf - $amount,NOW());");
                                $conn->query("INSERT INTO $to (name,`type`,value,total,`date`)
                                VALUES ('Virement Depuis : $fromac','Virement',$amount,$totalt + $amount,NOW());");
                                $conn->commit();
                            } catch (mysqli_sql_exception $exception) {
                            $conn->rollback();

                            throw $exception;
                            }
                            return true;
                        }
                        else {
                            $_SESSION['error'] = "Votre compte ne possède pas suffisament de provision pour le virement de $amount € <br> sur le compte : $totalf €";
                            header($virementpage);
                            return false;
                        }

                    }
                }
                else{
                        $totalt = 0;
                        $conn->begin_transaction();
                        $valitime = date('Y-m-d H:i:s');
                        if($amount < $totalf/100){
                            try {
                                $amount = $amount * 100;
                                $conn->query("INSERT INTO $from (name,`type`,value,total,`date`)
                                VALUES ('Virement vers : $toac','Virement',-$amount,$totalf - $amount,NOW());");
                                $conn->query("INSERT INTO $to (name,`type`,value,total,`date`)
                                VALUES ('Virement Depuis : $fromac','Virement',$amount,$totalt + $amount,NOW());");
                                $conn->commit();
                            } catch (mysqli_sql_exception $exception) {
                            $conn->rollback();

                            throw $exception;
                            }
                            return true;
                        }
                        else {
                            $_SESSION['error'] = "Votre compte ne possède pas suffisament de provision pour le virement de $amount €<br> sur le compte : $totalf €";
                            header($virementpage);
                            return false;
                        }
                }
            }
        }
        else {
            $_SESSION['error'] = "Le compte $fromac n'as pas était trouvé";
            header($virementpage);
            return false;
        }
    }
    function addbenef ($conn, $connac, $tabfrom, $clientid, $bankerid, $accountnumber,$name) {
        $sqlo = "INSERT INTO requestben (idclient, idbanker,accountbenef,made)
            VALUES ($clientid, $bankerid, $accountnumber, NOW())";
            if (mysqli_query($conn, $sqlo)) {
                $sqlt = "INSERT INTO $tabfrom (name, account,valid)
                VALUES ('$name', $accountnumber, false)";
                if (mysqli_query($connac, $sqlt)) {
                        return true;
                }
                else {
                    $_SESSION['query'] = $sqlt;
                    $_SESSION['error'] = "22: Erreur lors de l'ajout du bénéficiaire : $name";
                    header("location:./../../benefi.php");
                    return false;
                }
            } 
            else {
                $_SESSION['query'] = $sqlo;
                $_SESSION['error'] = "21 : Erreur lors de l'ajout du bénéficiaire : $name";
                header("location:./../../benefi.php");
                return false;
            }
    }
?>