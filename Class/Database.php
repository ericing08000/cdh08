<?php

class  Database {

    //déclaration des variables
    private $_host;
    private $_dbname;
    private $_username;
    private $_password;

    //Initialisation de notre class
    public function __construct ($_host, $_dbname, $_username, $_password) {
        $this->_host = $_host;
        $this->_dbname = $_dbname;
        $this->_username = $_username;
        $this->_password = $_password;
    }
    //Créer des getters pour stocker des valeurs
    public function getHost(){
        return $this->_host;
    }
    public function getDbName(){
        return $this->_dbname;
    }
    public function getUserName(){
        return $this->_username;
    }
    public function getPassword(){
        return $this->_password;
    }
    //Fonction permettant de se connecter
    public function PDOConnexion() {
        $bdd = new PDO('mysql:host='.$this->_host.' ; dbname='.$this->_dbname , $this->_username , $this->_password,

        //Permet de résoudre les problèmes de jeux de caractères (client Mysql)
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        
        //Définir le mode d'erreur PDO sur exception
        $bdd ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //faire un returne de la BDD ou non en fonction de la connexion
        return $bdd;
    }
}
?>
