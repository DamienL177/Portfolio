<?php
    //header('Location: ../ajouterPublication.html');

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    if($isset($_POST['titre']) && $isset($_POST['image']) && $isset($_POST['texte'])){
        $titre = $_POST['titre'];
        $texte = $_POST['texte'];
        $competences = array();
        if(isset($_POST['comp1'])){
            $comp1 = $_POST['comp1'];
            array_push($competences, $comp1);
        }
        if(isset($_POST['comp2'])){
            $comp2 = $_POST['comp2'];
            array_push($competences, $comp2);
        }
        if(isset($_POST['comp3'])){
            $comp3 = $_POST['comp3'];
            array_push($competences, $comp3);
        }
        $compJSON = json_encode($competences);

        $laDate = date("Y-m-d H:i:s");

        $titreBien = str_replace(" ", "_", $titre);

        
        $chemin = "../Publications/" . $titreBien;

        if(!file_exists($chemin)){
            // ON PLACE L'IMAGE DANS SON DOSSIER
            mkdir($chemin, 0755, true);

            $fichierCible = $chemin . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($fichierCible,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            }

            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            } 

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            } 

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } 
            else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } 
                else {
                echo "Sorry, there was an error uploading your file.";
                }
            }

            // ON PLACE TOUT DANS LA BD

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
            }
    
            // On créé et on exécute la commande
            $query = "SELECT COUNT(*) as nbId FROM $nomtable";
            $result= mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
    
            if (mysqli_connect_errno()){
                echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
            }
    
            $identifiant = $row["nbId"];

            // On créé et on exécute la commande
            $query = "INSERT INTO $nomtable VALUES ($identifiant, '$fichierCible', '$titre', '$texte', $compJSON, ";
            $result= mysqli_query($link, $query);

            if (mysqli_connect_errno()){
                echo "<p>Problème de query : " , mysqli_connect_error() ,"</p>";
            }

            if(!$result){
                echo "<p>Problème dans l'insertion : </p>";
            }

            // On ferme le lien avec la BD
            mysqli_close($link);
            
        }
        else{
            echo "Le nom de ce titre est déjà pris";
        }

    }
    else{
        echo "Tout n'a pas été rempli baka";
    }
    




?>