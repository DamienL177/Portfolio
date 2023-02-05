<?php
    //header('Content-Type: text/xml');
    

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
    $row = mysqli_fetch_array($result);

    if (mysqli_connect_errno()){
        echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
    }

    $nbPages = intdiv($row['nb'], 10) + 1;

    // On créé et on exécute la commande
    $query = "SELECT * FROM $nomtable ORDER BY laDate DESC LIMIT $premierePubli, 10";
    $result= mysqli_query($link, $query);

    if (mysqli_connect_errno()){
        echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
    }

    // On ferme le lien avec la BD
    mysqli_close($link);
    
    echo "<?xml version=\"1.0\"?>\n";
    
    echo "<lesPublis>\n";

    while($row = mysqli_fetch_assoc($result)){
        $titre = $row['titre'];
        $lienImage = $row['lienImage'];
        $texte = $row['texte'];
        echo "<Publication>\n";
        echo "<titre>$titre</titre>\n";
        echo "<lienImage>$lienImage</lienImage>\n";
        echo "<texte>$texte</texte>\n";
        echo "</Publication>\n";
    }

    //echo "<nbPages>$nbPages</nbPages>\n";

    echo "</lesPublis>\n";




?>