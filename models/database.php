<?php

    namespace App;
    use \PDO;
    use \PDOException;

    class database extends PDO {
        private const server = $_ENV["SERVER"];
        private const user_name = $_ENV["USER_NAME"];
        private const password = $_ENV["PASSWORD"];
        private const port = $_ENV["PORT"];
        private const dbname = $_ENV["DB_NAME"];
        private $pdo;

        function __construct() {
            try {
                $this -> pdo = new PDO("mysql:host=".self::server.";dbname=".self::dbname.";port=".self::port.";charset=utf8", self::user_name, self::password);
                $this -> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this -> pdo -> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
                $this -> pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                die("Erreur : ".$e -> getMessage()."<br>A la ligne : ".$e -> getLine());
            }
        }

        function get_db() {
            return $this -> pdo;
        }
    }