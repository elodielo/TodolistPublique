<?php

final class Database
{
    private $DB;
    private $config;

    public function __construct()
    {
        $this->config = require_once __DIR__ . '/../../config.php';
        $this->connexionDB();
    }

    private function connexionDB()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->DB = new PDO($dsn, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $err) {
            echo "Erreur" . $err->getMessage();
        }
    }

    public function getDB()
    {
        return $this->DB;
    }

    function initialiserBDD()
    {
        if ($this->DBexiste()) {
            return "La base de donnees exite";
            die();
        }

        try {
            $sql = file_get_contents(__DIR__ . "../Migrations/Todo-rempli.sql");
            $this->DB->query($sql);


            if ($this->MiseAJourConfig()) {
                return "installation de la Base de Données terminée !";
            }
        } catch (PDOException $err) {
            return "impossible de remplir la Base de données : " . $err->getMessage();
        }
    }

    function DBexiste()
    {

        $existe = $this->DB->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE \'to_utilisateurs\'')->fetch();
        if ($existe !== false && $existe[0] == "to_utilisateurs") {
            return true;
        } else {
            return false;
        }
    }

    private function MiseAJourConfig(): bool
    {

        $fconfig = fopen($this->config, 'w');

        $contenu = "<?php
        // lors de la mise en open source, remplacer les infos concernant la base de données.
        
        define('DB_HOST', '" . DB_HOST . "');
        define('DB_NAME', '" . DB_NAME . "');
        define('DB_USER', '" . DB_USER . "');
        define('DB_PWD', '" . DB_PWD . "');
        
        // Ne pas toucher :
        
        define('DB_INITIALIZED', TRUE);";


        if (fwrite($fconfig, $contenu)) {
            fclose($fconfig);
            return true;
        } else {
            return false;
        }
    }
}
