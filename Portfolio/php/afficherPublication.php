<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    $titre = $_POST['titre'];
    echo "<title> $titre </title>";
    ?>
</head>
<body>
    <nav>
        <ul>
            <li><a href="../portfolio.html">Retour en arrière</a></li>
        </ul>
    </nav>
    <main>
        <?php
            if(isset($_POST['image'])){
                $lienImage = $_POST['image'];
                echo "<img src='$lienImage' alt='Une image liée à la publication'><br>\n";
            }

            $titre = $_POST['titre'];
            
            // On définit les variables nécessaires au lien avec la BD
            $bdd = "u562708442_dlanusse";
            $host = "localhost";
            $user= "u562708442_dlanusse";
            $pass = "17703@Darima";

            // On définit les variables nécessaires à la commande
            $nomtable = "Publication";

            // On fait le lien avec la BD
            $link = mysqli_connect($host,$user,$pass,$bdd);

            if (mysqli_connect_errno()){
                echo "<p>Problème de connect : " , mysqli_connect_error() ,"</p>";
                throw new Exception();
            }

            // On créé et on exécute la commande
            $query = "SELECT * FROM $nomtable WHERE titre = $titre";
            $result= mysqli_query($link, $query);

            if (mysqli_connect_errno()){
                echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
                throw new Exception();
            }

            // On ferme le lien avec la BD
            mysqli_close($link);

            $row = mysqli_fetch_row($result);
            
            $texte = $row['texte'];
            $competences = json_decode($row['competences']);

            echo "<h2>$titre</h2><br>\n";
            echo "<p>$texte</p><br>\n";
            echo "<p>$competences</p>\n";

        ?>
    </main>
</body>
</html>