<?php 

    require_once "../controllers/controller.php";
    $dir = new dir();
    $rep_landscape = "../folder parent/Paysage/";
    $rep_car = "../folder parent/Voiture/";
    $rep_town = "../folder parent/Ville/";
    $rep_other = "../folder parent/Autre/";
    $dir_landscape = $dir->get_dir($rep_landscape);
    $dir_car = $dir->get_dir($rep_car);
    $dir_town = $dir->get_dir($rep_town);
    $dir_other = $dir->get_dir($rep_other);
    
    $rep = "../app_galerie_picture/";
    if (!is_dir($rep)) {
        mkdir($rep);
    }
    $_SESSION['picture'] = $dir -> select_profil($rep);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dark.css" class="style">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="../icone/034-library.ico">
    <title>Wallpers</title>
</head>
<body>
    <?php require_once "veille.php"; ?>
    <?php require_once "loader.php"; ?>
    
    <div id="container-change-picture" class="change-picture-shide">
        <div id="change-picture">
            <i class="fa fa-close"></i>
            <div id="picture">
                <img src="<?= $_SESSION['picture'] ?>" alt="user" class="photo">
            </div>
            <div id="buttons">
                <form action="../controllers/controller.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file" id="file">
                    <input type="submit" id="ajouter" name="ajouter">
                    <input type="submit" id="supprimer" name="supprimer">
                </form>
                <label for="file">Ajouter</label>
                <label for="supprimer">Supprimer</label>
            </div>
        </div>
    </div>
    <div id="nav">
        <div id="header">
            <div id="profile"> 
                <img src="<?= $_SESSION['picture'] ?>" alt="user" class="photo">
                <i class="fa fa-camera"></i>
                <span>Free wallpers</span>
                <span>Download for free</span>
            </div>
            <div id="theme">
                <div id="parent">
                    <div id="child">
                        <i class="fa fa-moon-o" id="icone"></i>
                    </div>
                </div>
            </div>
        </div>
        <ul translate="no">
            <li class="links show" name="Landscape">Landscape</li>
            <li class="links" name="Cars">Cars</li>
            <li class="links" name="Towns">Towns</li>
            <li class="links" name="Other">Other</li>
        </ul>
    </div>

    <div id="container">
        <div class="container Landscape initial">
            <?php  
                
                foreach($dir_landscape as $file): 
                    if ($file != "." && $file != ".." && (strpos($file, 'png') || strpos($file,'jpg') || strpos($file, 'jpeg'))):
            ?>
                <div class="container-items">
                    <img src="<?= $rep_landscape.$file ?>" alt="<?= $rep_landscape.$file ?>" title="<?= basename($rep_landscape.$file) ?>" class="img">
                    <div class="container-download">
                        <button type="button" class="download fa fa-download">Télécharger</button>
                    </div>
                </div>
            <?php 
                endif;
                endforeach; 
            ?>
        </div>
    
        <div class="container Cars transform">
            <?php  
                
                foreach($dir_car as $file): 
                    if ($file != "." && $file != ".." && (strpos($file, 'png') || strpos($file,'jpg') || strpos($file, 'jpeg'))):
            ?>
                <div class="container-items">
                    <img src="<?= $rep_car.$file ?>" alt="<?= $rep_car.$file ?>" title="<?= basename($rep_car.$file) ?>" class="img">
                    <div class="container-download">
                        <button type="button" class="download fa fa-download">Télécharger</button>
                    </div>
                </div>
            <?php 
                endif;
                endforeach; 
            ?>
        </div>
    
        <div class="container Towns transform">
            <?php  
                
                foreach($dir_town as $file): 
                    if ($file != "." && $file != ".." && (strpos($file, 'png') || strpos($file,'jpg') || strpos($file, 'jpeg'))):
            ?>
                <div class="container-items">
                    <img src="<?= $rep_town.$file ?>" alt="<?= $rep_town.$file ?>" title="<?= basename($rep_town.$file) ?>" class="img">
                    <div class="container-download">
                        <button type="button" class="download fa fa-download">Télécharger</button>
                    </div>
                </div>
            <?php 
                endif;
                endforeach; 
            ?>
        </div>
        <div class="container Other transform">
            <?php  
                
                foreach($dir_other as $file): 
                    if ($file != "." && $file != ".." && (strpos($file, 'png') || strpos($file,'jpg') || strpos($file, 'jpeg'))):
            ?>
                <div class="container-items">
                    <img src="<?= $rep_other.$file ?>" alt="<?= $rep_other.$file ?>" title="<?= basename($rep_other.$file) ?>" class="img">
                    <div class="container-download">
                        <button type="button" class="download fa fa-download">Télécharger</button>
                    </div>
                </div>
            <?php 
                endif;
                endforeach; 
            ?>
        </div>
    </div>

    
    <script charset="UTF-8" src="../js/index.js"></script>
</body>
</html>