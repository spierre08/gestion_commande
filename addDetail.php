<?php
     #Démarrage de la session
     session_start();
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
        $commande = htmlspecialchars($_POST["commande"]);
        $article = htmlspecialchars($_POST["article"]);
        $prix = htmlspecialchars($_POST["prix"]);
        $qunatite = htmlspecialchars($_POST["qunatite"]);

        #Vérifier si les champ prix et quantite ne sont pas vide
        if (!empty($prix) and !empty($qunatite)){
            #Vérifier si le prix et la quantité sont supérieur à 0
            if ($prix > 0 and $qunatite > 0){
                #Préparation de la requêtte d'insertion
                $insertion = $pdo->prepare("INSERT INTO t_ligne(id_commande,id_article,prix_unittaire,qte) values(?,?,?,?)");
                #Exécution de la requêtte d'insertion
                $insertion->execute(array($commande,$article,$prix,$qunatite));
                $message = "<span id='erreur'>Ajout éffectué !</span>";
            }#Sinon on affiche un message d'érreur
            else{
                $erreur = "<span id='alert'>Prix ou quantité positif</span>";
            }
        }else{
            $erreur = "<span id='alert'>Veuillez remplir ces champs</span>";
        }


    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Nouveau détail commande</title>
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
            <span id="account"><?php echo $_SESSION["email"]; ?></span>
            <hr>
            <div class="slide_list">
                    <a href="client.php">
                        <img src="icone/client.png" alt="">
                        <span>Clients</span>
                    </a>
                    <a href="commande.php">
                        <img src="icone/commande.png" alt="">
                        <span>Commandes</span>
                    </a>
                    <a href="detail.php">
                        <img src="icone/detail.png" alt="">
                        <span>Détails</span>
                    </a>
                    <a href="article.php">
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
                <span style="font-weight: 600;"><?php echo $_SESSION["email"]; ?></span>
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
        <div class="main" style="height: 49vh;">
            <div class="main_option">
                <h1>Nouveau Détail commande</h1>
                <div class="main_sub_option">
                    <a href="detail.php">Retour</a>
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
                    <label>Commande</label>
                    <select name="commande" id="">
                        <?php
                            #Requêtte de selection
                            $aff_commande = $pdo->query("SELECT * FROM t_commande");
                            #Boucle de pourcour d'enrégistrement
                            while($aff_commandes = $aff_commande->fetch()){
                        ?>
                        <option value="<?php echo $aff_commandes['id_commande'] ?>"><?php echo $aff_commandes['date_cmd']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <label>Produit</label>
                    <select name="article" id="">
                        <?php
                            #Requêtte de selection
                            $aff_article = $pdo->query("SELECT * FROM t_article");
                            #Parcour de boucle d'enrégistrement
                            while($aff_articles = $aff_article->fetch()){ 
                        ?>
                        <option value="<?php echo $aff_articles['id_article']; ?>"><?php echo $aff_articles['libelle']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <label>Prix Unitaire</label>
                    <input type="number" name="prix">
                    <label>Quantité</label>
                    <input type="number" name="qunatite">
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