<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCommande/Erreur de page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap">
        <!-- =======Menu vertical======== -->
        <div class="slide_bar">
            <h1>G<span>commandes</span></h1>
            <hr>
            <div class="slide_list">
                    <a href="#">
                        <img src="icone/client.png" alt="">
                        <span>Clients</span>
                    </a>
                    <a href="#">
                        <img src="icone/commande.png" alt="">
                        <span>Commandes</span>
                    </a>
                    <a href="#">
                        <img src="icone/detail.png" alt="">
                        <span>Détails</span>
                    </a>
                    <a href="#">
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
            </div>
            <div class="subMenu_item">
                <!-- ==============Bouton déconnexion========== -->
                <a href="#" id="disconnect" class="disconnect">
                    <img src="icone/deconnexion.png" alt="">
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>
        <!-- =========Main========= -->
        <div class="main" style="height: 76vh;">
            <div class="main_option">
                <h1>Inaccessible</h1>
                <div class="main_sub_option" style="display: none;">
                    <input type="datetime-local" name="date">
                </div>
            </div>
            <hr>
            <div class="main_table">
               
                <h1  id="Nofound" data-text="404 Page No Found">404 Page No Found</h1>
                
            </div>
            <div class="footer">
                <span id="footer">© 2023 by Cyborg of Web</span>
            </div>
        </div>
    </div>
    <!-- ========Code source Javascript========= -->
    <script src="script.js"></script>
</body>
</html>