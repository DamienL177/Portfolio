<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Content-Type: text/xml');

    try{
        // On définit les variables nécessaires au lien avec la BD
        $bdd = "u562708442_dlanusse";
        $host = "localhost";
        $user= "u562708442_dlanusse";
        $pass = "17703@Darima";

        // On définit les variables nécessaires à la commande
        $nomtable = "Publication";
        $page = $_POST['page'];
        $premierePubli = ($page * 10) - 1;

        // On fait le lien avec la BD
        $link = mysqli_connect($host,$user,$pass,$bdd);

        if (mysqli_connect_errno()){
            echo "<p>Problème de connect : " , mysqli_connect_error() ,"</p>";
            throw new Exception();
        }

        // On créé et on exécute la commande
        $query = "SELECT * FROM $nomtable ORDER BY date DESC LIMIT $premierePubli, 10";
        $result= mysqli_query($link, $query);

        if (mysqli_connect_errno()){
            echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
            throw new Exception();
        }

        // On ferme le lien avec la BD
        mysqli_close($link);
        
        echo "<?xml version=\"1.0\"?>\n";
        echo "<lesPublis>\n";

        while($row = mysqli_fetch_array($result)){
            $titre = $row['titre'];
            $lienImage = $row['lienImage'];
            $texte = $row['texte'];
            $lien = $row['lien'];
            echo "  <Publication>\n";
            echo "      <titre>$titre</titre>\n";
            echo "      <lienImage>$lienImage</lienImage>\n";
            echo "      <texte>$texte</texte>\n";
            echo "      <lien>$lien</lien>\n";
            echo "  </Publication>\n";
        }

        echo "</lesPublis>\n";
        

        // On fait le lien avec la BD
        $link = mysqli_connect($host,$user,$pass,$bdd);

        if (mysqli_connect_errno()){
            echo "<p>Problème de connect : " , mysqli_connect_error() ,"</p>";
            throw new Exception();
        }

        // On créé et on exécute la commande
        $query = "SELECT COUNT(*) as nb FROM $nomtable";
        $result= mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);

        if (mysqli_connect_errno()){
            echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
            throw new Exception();
        }

        // On ferme le lien avec la BD
        mysqli_close($link);

        $nbPages = $row['nb'] + 1;
        echo "<nbPages>$nbPages</nbPages>\n";
        
    }
    catch(Exception $e) {
        echo "<p>Problème dans les commandes de la Base de Données</p>";

    }



?>