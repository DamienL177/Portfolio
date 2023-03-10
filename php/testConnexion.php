
<?php
    // On vérifie si toutes les variables demandées ont été saisies
    if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
        try{
            // On définit les variables nécessaires au lien avec la BD
            $bdd = "u562708442_dlanusse";
            $host = "localhost";
            $user= "u562708442_dlanusse";
            $pass = "17703@Darima";

            // On définit les variables nécessaires à la commande
            $nomtable = "Moi";
            $pseudonyme = $_POST['pseudo'];
            $motDePasse = $_POST['mdp'];
    
            // On fait le lien avec la BD
            $link = mysqli_connect($host,$user,$pass,$bdd);
    
            if (mysqli_connect_errno()){
                echo "<p>Problème de connect : " , mysqli_connect_error() ,"</p>";
                throw new Exception();
            }
    
            // On créé et on exécute la commande
            $query = "SELECT COUNT(*) as nbId FROM $nomtable WHERE pseudonyme = '$pseudonyme' AND mdp = '$motDePasse'";
            $result= mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
    
            if (mysqli_connect_errno()){
                echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
                throw new Exception();
            }
    
            // On ferme le lien avec la BD
            mysqli_close($link);
            
            // Si on obtient le résultat souhaité
            if($row['nbId'] == 1){
                // On continue dans le site
                header("Location: ../modifSite.html");
            }
            // Sinon
            else{
                // On retourne au formulaire
                header('Location: ../index.html');
                echo("<h4>Le pseudonyme/mot de passe ne correspond pas</h4>");
            }
            
            
        }
        catch(Exception $e) {
            echo "<p>Problème dans les commandes de la Base de Données</p>";
        }
    }
    // Sinon on le signale
    else {
        header('Location: ../index.html');
        echo("<h4>Merci de remplir tous les champs</h4>");
    }



?>