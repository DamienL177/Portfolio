<?php
    $nom =$_POST['nom'];
    $addrMail = $_POST['addrMail'];
    $objet = $_POST['objet'];
    $mail = $_POST['mail'];

    $message = $nom + " a envoyé en tant que \n" + $addrmail + " : \n" + $mail;
    $monAddr = "damienlanusse.pro@gmail.com";
    mail($monAddr, $objet, $message);

?>