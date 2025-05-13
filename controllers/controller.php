<?php 
    
    session_start();
    class dir {
        function get_dir($rep) {
            if (is_dir($rep)) {
                $dir = scandir($rep);
                if ((count($dir) - 2) !== 0) {
                    return $dir;
                }
                else {
                    return "Dossier vide";
                }
            }
            else {
                die ("Dossier inexistant");
            }
        }

        function select_profil($rep) {
            $picture = "";
            if (is_dir($rep)) {
                $dir = scandir($rep);
                if ((count($dir) - 2) !== 0) {
                    foreach($dir as $d) {
                        $picture = $rep.$d;
                    }
                }
                else {
                    $picture = '../views/use.png';
                }
            }
            else {
                $picture = '../views/use.png';
            }
            return $picture;
        }
    }

    if (isset($_POST["ajouter"])) {
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] === 0) {
            $new_rep = "../app_galerie_picture/"; 
            if (!is_dir($new_rep)) {
                mkdir($new_rep, 0755);
            }
            $file_name = $_FILES["file"]['name'];
            $file_tmp = $_FILES["file"]['tmp_name'];
            $file_type = $_FILES["file"]['type'];
            
            if ($file_type === "image/jpeg" || $file_type === "image/jpg" || $file_type === "image/png" || $file_type === "image/gif") {
                $new_tmp = $new_rep.$file_name;
                if (move_uploaded_file($file_tmp, $new_tmp)) {
                    header("location:".$_SERVER['HTTP_REFERER']);
                }
            }
        }
    }
    
    if (isset($_POST["supprimer"])) {
        $rep = "../app_galerie_picture/";
        if (is_dir($rep)) {
            $dir = scandir($rep);
            if ((count($dir) -2) !== 0) {
                function un_link($r, $d) {
                    $d = scandir($r);
                    foreach($d as $file) {
                        if ($file !== "." && $file !== "..") {
                            unlink($r.$file);
                        }
                    }
                }
                if (un_link($rep, $dir)) {
                    rmdir($rep);
                    $_SESSION['pciture'] = '../views/use.png';
                    header("location:".$_SERVER['HTTP_REFERER']);
                }
                else {
                    echo "<script>";
                    echo "document.location.href = '".$_SERVER['HTTP_REFERER']."';";
                    echo "</script>";
                }
            }
            else {
                header("location:".$_SERVER['HTTP_REFERER']);
            }
        }
    }
