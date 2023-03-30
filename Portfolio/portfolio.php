<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>DLanusse - Portfolio</title>
        <meta charset="utf-8">

    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="../index.html">Retour à l'index</a></li>
                    <li><a href="../CV/CV.html">Aller vers mon CV</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <article id="main"></article>
            <select name="page" id="page" onchange="ajax()">
                <option value="1">1</option>
            </select>
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            if(isset($_GET['page'])){
                $publications = require 'dlanusse.fr/Portfolio/php/getPublication.php'/*?page='.strval($_GET['page'])*/;
                for($i = 0; $i < sizeof($publications); $i++){
                    $image = $publications[$i]["lienImage"];
                    $titre = $publications[$i]["titre"];
                    $id = $publications[$i]["identifiant"];

                    print "<div class='unePubli'>
                            <a href='unePublication.php?id=$id'><img src='$image' alt='Une image présentant cet article'></a>
                            <h3>$titre</h3>
                        </div>";
                }

            }

            ?>
        </main>
        <footer>
            <article class="reseaux">
                <ul>
                    <li>
                        <a href="https://www.instagram.com/darima_17/" class="Instagram">Mon Instagram</a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/damien-lanusse/" class="Linkedin">Mon Linkedin</a>
                    </li>
                    <li>
                        <a href="https://github.com/DamienL177" class="Github">Mon Github</a>
                    </li>
                </ul>
            </article>
            <article class="mail">
                <form action="php/envoyerMail.php" method="POST">
                    <h4>Votre nom</h4>
                    <input type="text" name="nom"><br>
                    <h4>Votre mail</h4>
                    <input type="text" name="addrMail"><br>
                    <h4>Objet du mail</h4>
                    <input type="text" name="objet"><br>
                    <h4>Mail (200 caractères maximum)</h4>
                    <textarea maxlength="200" name="mail"></textarea><br>
                    <input type="submit" value="Envoyer">
                </form>
            </article>
            <article class="footer"></article>
        </footer>
    </body>
</html>