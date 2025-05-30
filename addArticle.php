<?php
    #Connexion à la base de données
	  try{
        $pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
    }catch (PDOException $exception) {
        header("Location:404.php");
    }

    #Variable d'erreur et d'alert
    $erreur = "";
    $message = "";

    #Si on reçoit une requêtte de type post
    if (isset($_POST["ajouter"])){
        $libelle = htmlspecialchars($_POST["libelle"]);
        $categorie = htmlspecialchars($_POST["categorie"]);

        #Vérifier si le champ libelle n'est pas vide
        if (!empty($libelle)){
            #Préparation de la requêttre d'insertion
            $insertion = $pdo->prepare("INSERT into t_article(libelle,type) values(?,?) ");
            #Exécution de la requêtte
            $insertion->execute(array($libelle,$categorie));
            #Message de confirmation d'ajout
            $message = "<span id='erreur'>Ajout éffectué !</span>";
        }#Sinon on afficher un message d'érreur
        else{
            $erreur = "<span id='alert'>Veuillez remplir ce champ</span>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Nouvel article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap">
        <!-- =======Menu vertical======== -->
        <div class="slide_bar">
            <h1>G<span>commandes</span></h1>
            <?php
                if (!$_SESSION["mot_de_passe"]){
                    header("Location:login.php");
                }
            ?>
            <span id="account"><?php echo $_SESSION["mail"]; ?></span>
            <hr>
            <div class="slide_list">
                    <a href="adminClient.php">
                        <img src="icone/client.png" alt="">
                        <span>Clients</span>
                    </a>
                    <a href="adminCommande.php">
                        <img src="icone/commande.png" alt="">
                        <span>Commandes</span>
                    </a>
                    <a href="adminDetail.php">
                        <img src="icone/detail.png" alt="">
                        <span>Détails</span>
                    </a>
                    <a href="adminArticle.php">
                        <img src="icone/article.png" alt="">
                        <span>Articles</span>
                    </a>
            </div>
        </div>
        <!-- ===========Menu vertical========== -->
        <div class="header">
            <div class="sub_option">
                <div class="menu_icon_1"></div>
                <div class="menu_icon"></div>
                <span style="font-weight: 600;"><?php echo $_SESSION["mail"]; ?></span>
            </div>
            <div class="subMenu_item">
               <!-- ==============Bouton déconnexion========== -->
               <a href="deconnexion.php" id="disconnect">
                    <img src="icone/deconnexion.png" alt="">
                    <span>Déconnexion</span>
               </a>
            </div>
        </div>
        <!-- =========Main========= -->
        <div class="main" style="height: 40vh;">
            <div class="main_option">
                <h1>Nouvel article</h1>
                <div class="main_sub_option">
                    <a href="adminArticle.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="#" method="POST">
                    <?php
                        if (isset($erreur))
                            echo $erreur;
                    ?>
                    <?php
                        if (isset($message))
                            echo $message;
                    ?>
                    <label>Libellé</label>
                    <input type="text" name="libelle" id="">
                    <label>Catégorie</label>
                    
                    <select name="categorie" id="">
                    <?php 
                        #Requêtte d'affichage
                        $affichage = $pdo->query("SELECT * from t_categorie");
                        #Boucle de parcour d'enregistrements
                        while($affichages = $affichage->fetch()){
                    ?>
                        <option value="<?php echo $affichages['id_type'] ?>"><?php echo $affichages['categorie'] ?></option>
                        <?php
                        }
                    ?>
                    </select>
                   
                    <input type="submit" value="Ajouter" name="ajouter">
                </form>
            </div>
            <div class="footer">
                <span id="footer">© 2023 | Simon Pierre SAGNO</span>
            </div>
        </div>
    </div>
       <!-- ========Code source Javascript========= -->
 <script src="script.js"></script>
</body>
</html>