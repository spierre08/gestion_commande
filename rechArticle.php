<?php
      #Connexion à la base de données
	 try{
		$pdo = new PDO("mysql:host=localhost;dbname=g_commande;charset=utf8","root","");
	 }catch (PDOException $exception) {
		header("Location:404.php");
	 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommandes/Rechercher un article</title>
    <link rel="stylesheet" href="rech.css">
</head>
<body>
    <header>
        <a href="article.php">Retour</a>
        <form action="#" method="POST">
            <input type="search" name="name" id="" placeholder="Rechercher un article"><button type="submit" name="rechercher">Rechercher</button>
        </form>
    </header>
    <div class="container">
        <table>
        <?php
                #Si un reçoit un demande de type post
                $message = "";
                if (isset($_POST['rechercher'])){
                    $key = htmlspecialchars($_POST['name']);
                    #Préparation de la requêtte
                    $requette = $pdo->prepare("SELECT id_article, libelle, type, id_type, categorie AS t_categorie FROM t_article INNER JOIN t_categorie on t_article.type=t_categorie.id_type WHERE libelle=? OR id_article=?");
                    $requette->setFetchMode(PDO::FETCH_OBJ);
                    #Exécution de la requêtte
                    $requette->execute(array($key,$key));
                    #Vérifier si la requêtte à été exécutée alors on affiche les résultats
                    if ($row = $requette->fetch()) {
            ?>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Libellé</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <td><?php echo $row->id_article; ?></td>
                        <td><?php echo $row->libelle; ?></td>
                        <td><?php echo $row->t_categorie; ?></td>
                </tr>
            </tbody>
        </table>
        <?php
                     }else{
                        $message =  "Aucun resultat";
               
                     }
                    }
             ?>
        <br>
        <span style="marging-top:50px; color : red;"><?php echo $message; ?></span>
        
    </div>
</body>
</html>