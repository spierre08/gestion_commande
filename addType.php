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
		$type = htmlspecialchars($_POST["type"]);

		#Vérifier le champs est non vide
		if (!empty($type)){
            #Préparation de la requêtte de selection
            $selection = $pdo->prepare("SELECT * FROM t_categorie WHERE categorie=?");
            #Exécution de la requêtte
            $selection->execute(array($type));
            #Compteur de ligne
            $resultat = $selection->rowCount();
            if ($resultat==1){
                $erreur = "<span id='alert'>Cette catégorie existe</span>";
            }else{
                
			#préparation de la requêtte
			$insertion = $pdo->prepare("INSERT into t_categorie set categorie=?");
			#Exécution de la requêtte
			$insertion->execute(array($type));
			#Message de confirmation d'ajout
			$message = "<span id='erreur'>Ajout éffectué !</span>";
            }

		}#Sinon on affiche un message d'erreur
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
    <title>GCommande/Nouvelle catégorie</title>
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
                    <a href="tableau.php">
                        <img src="icone/admin.png" alt="">
                        <span>Admin</span>
                    </a>
                    <a href="utilisateur.php">
                        <img src="icone/user.png" alt="">
                        <span>Utilisateur</span>
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
        <div class="main" style="height: 49vh;">
            <div class="main_option">
                <h1>Ajouter une catégorie</h1>
                <div class="main_sub_option">
                    <a href="categorie.php">Retour</a>
                </div>
            </div>
            <hr>
            <div class="main_table">
                <form action="#" method="POST">
                    <?php
						if(isset($message))
							echo $message;
					?>
					<?php
						if(isset($erreur))
							echo $erreur;
					?>
                    <label>Nom catégorie</label>
                    <input type="text" name="type">
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