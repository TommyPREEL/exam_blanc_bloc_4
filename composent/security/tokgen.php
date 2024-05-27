<?php
    function tokengenerator ($username, $pass, $type, $fn, $ln){
        $idkeyone = uniqid('',true);
        $idkeytwo = uniqid();
        $bassusna = base64_encode($username);
        $basstype = base64_encode($type);
        $fnok = base64_encode($fn);
        $lnok = base64_encode($ln);
        $token = $idkeytwo."@".$idkeyone."@".$fnok."@".$basstype."@".$idkeyone."@".$lnok."@".$bassusna."@".$idkeytwo;
        return $token; };
?>