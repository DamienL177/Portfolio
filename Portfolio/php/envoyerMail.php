<?php
    header('Location: ../portfolio.html');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $mailOk = true;

    if(!isset($_POST['nom'])){
        $nom =$_POST['nom'];
        echo "<p class='error'>Veuillez saisir votre nom</p>";
        $mailOk = false;
    }
    if(!isset($_POST['addrMail'])){
        $addrMail = $_POST['addrMail'];
        echo "<p class='error'>Veuillez saisir votre adresse mail</p>";
        $mailOk = false;
    }
    if(!isset($_POST['objet'])){
        $objet = $_POST['objet'];
        echo "<p class='error'>Veuillez saisir l'objet de votre mail</p>";
        $mailOk = false;
    }
    if(!isset($_POST['mail'])){
        $addrMail = $_POST['mail'];
        echo "<p class='error'>Veuillez saisir du texte dans votre mail</p>";
        $mailOk = false;
    }

    if(!$mailOk){
        exit;
    }

    $message = $nom + " a envoyé en tant que \n" + $addrmail + " : \n" + $mail;
    $monAddr = "damienlanusse.pro@gmail.com";
    mail($monAddr, $objet, $message);

?>