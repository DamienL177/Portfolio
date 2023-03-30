<?php

    header('Content-Type: text/xml');
    
    // On définit les variables nécessaires au lien avec la BD
    $bdd = "u562708442_dlanusse";
    $host = "localhost";
    $user= "u562708442_dlanusse";
    $pass = "17703@Darima";

    // On définit les variables nécessaires à la commande
    $nomtable = "Publication";
    $page = $_GET['page'];
    $premierePubli = ($page * 10) - 10;

    // On fait le lien avec la BD
    $link = mysqli_connect($host,$user,$pass,$bdd);

    if (mysqli_connect_errno()){
        echo "<p>Problème de connect : " , mysqli_connect_error() ,"</p>";
    }

    // On créé et on exécute la commande
    $query = "SELECT COUNT(*) as nb FROM $nomtable";
    $result= mysqli_query($link, $query);

    if (mysqli_connect_errno()){
        echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
    }

    $row = mysqli_fetch_array($result);
    $nbPages = intdiv($row['nb'], 10) + 1;

    //echo "SELECT * FROM $nomtable ORDER BY laDate DESC LIMIT $premierePubli, 10";

    // On créé et on exécute la commande
    $query = "SELECT * FROM $nomtable ORDER BY laDate DESC LIMIT $premierePubli, 10";
    $result= mysqli_query($link, $query);

    if (mysqli_connect_errno()){
        echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
    }

    // On ferme le lien avec la BD
    mysqli_close($link);
    
    $array = [];

    while($row = mysqli_fetch_assoc($result)){
        //echo "<test>1</test>\n";
        $identifiant = $row['identifiant'];
        $titre = $row['titre'];
        $lienImage = $row['lienImage'];
        array_push($array, ["identifiant" => $identifiant, "titre"=> $titre, "lienImage" => $lienImage]);
    }

    return $array;



?>