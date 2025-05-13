<?php 

    use App\database;
    require_once "database.php";


    class user extends database {
        private static $db;
        private $pdo;

        function __construct() {
            self::$db = new database();
        }
        
        function check_if_exists_element($table, $column, $params) {
            $sql = "select * from ".$table." order by ".$column;
            $found = false;
            
            $datas = $this -> crud("select", $table, $column, $sql, null, null, null, null);
            
            foreach($datas as $data) {
                if ($data[$column] === $params[0]) {
                    $found = true;
                    break;
                }
            }
            return $found;
            
        }

        function crud($action, $table, $column, $sql, $params, $msg, $msg_err, $link) {
            $this->pdo = self::$db -> get_db();
            try {
                $req = $this->pdo-> prepare($sql);

                if ($action === "update") {
                    if ($params != null) {
                        $found = $this -> check_if_exists_element($table, $column, $params);
                        
                        if($found == false) {
                            $req -> execute($params);
                            if ($msg != null) {
                                echo "<script>alert('".$msg."');</script>";
                                echo "<script>document.location.href = '".$link."';</script>";
                            }
                            else {
                                header("location:".$_SERVER['HTTP_REFERER']);
                            }
                        }
                        else {
                            echo "<script>alert('".$msg_err."');</script>";
                            echo "<script>document.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
                        }
                    }
                }


                elseif ($action === "insert") {
                    if ($params != null) {
                        $found = $this -> check_if_exists_element($table, $column, $params);
                        
                        if($found == false) {
                            $req -> execute($params);
                            if ($msg != null) {
                                echo "<script>alert('".$msg."');</script>";
                                echo "<script>document.location.href = '".$link."';</script>";
                            }
                            else {
                                header("location:".$_SERVER['HTTP_REFERER']);
                            }
                        }
                        else {
                            echo "<script>alert('".$msg_err."');</script>";
                            echo "<script>document.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
                        }
                    }
                }
                    
                elseif ($action === "delete") {
                    if ($params != null) {
                        if ($req -> execute($params)) {
                            if ($msg != null) {
                                echo "<script>alert('".$msg."');</script>";
                                echo "<script>document.location.href = '".$link."';</script>";
                            }
                        }
                    }
                }

                elseif ($action === "select") {
                    if ($params == null) {
                        $req -> execute();
                        return $req -> fetch();
                    }
                    else {
                        $req -> execute($params);
                        return $req -> fetchAll();
                    }
                }
                
                else {
                    echo "<script>alert('Action invalide');</script>";
                    echo "<script>document.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
                }
            } catch(Exception $e) {
                die("Erreur : ".$e -> getMessage()."<br>A la ligne : ".$e -> getLine());
            }
        }
    }