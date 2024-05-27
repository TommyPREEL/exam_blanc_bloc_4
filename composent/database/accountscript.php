<?php 
    function cryptaccount($account){
        $account = str_replace("1", "f", $account);
        $account = str_replace("2", "e", $account);
        $account = str_replace("3", "j", $account);
        $account = str_replace("4", "v", $account);
        $account = str_replace("5", "p", $account);
        $account = str_replace("6", "q", $account);
        $account = str_replace("7", "d", $account);
        $account = str_replace("8", "m", $account);
        $account = str_replace("9", "w", $account);
        $account = str_replace("0", "s", $account);
        return $account;
    }
    function decryptaccount($account){
        $account = str_replace("f","1",$account);
        $account = str_replace("e","2",$account);
        $account = str_replace("j","3",$account);
        $account = str_replace("v","4",$account);
        $account = str_replace("p","5",$account);
        $account = str_replace("q","6",$account);
        $account = str_replace("d","7",$account);
        $account = str_replace("m","8",$account);
        $account = str_replace("w","9",$account);
        $account = str_replace("s","0",$account);
        return $account;
    }
    function getamount ($conn, $table){
        $sql = "SELECT total FROM $table ORDER BY id DESC LIMIT 1";
        $reponse = $conn->query($sql);
        if ($reponse->num_rows > 0) {
            while($row = $reponse->fetch_assoc()) {
                return $row['total'] / 100;
            }
        }
        else { return false; }
    }
    function calc($conn , $table, $condition, $column){
        if (!$condition){$sql = "SELECT count($column) FROM $table";}
        else {$sql = "SELECT count($column) FROM $table WHERE $condition;";}
        $calc = $conn->query($sql);
        if ($calc->num_rows > 0) {
            while($row = $calc->fetch_assoc()) { 
                $countname = "count($column)";   
                return $row[$countname];
            }
        }
        else { return $sql; }
    }
    ?>