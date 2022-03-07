<?php

class Model
{


    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;


    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;


    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {

        try {
            include 'Utils/credentials.php';
            $this->bd = new PDO($dsn, $login, $mdp);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bd->query("SET nameS 'utf8'");
        } catch (PDOException $e) {
            die('Echec connexion, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }


    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {

        if (is_null(self::$instance)) {
            self::$instance = new Model();
        }
        return self::$instance;
    }

    public function getNbData()//recupere le nombre de données present sur lA DB
    {

        try {
            $req = $this->bd->prepare('SELECT COUNT(*) FROM mytable');
            $req->execute();
            $tab = $req->fetch(PDO::FETCH_NUM);
            return $tab[0];
        } catch (PDOException $e) {
            die('Echec getNbData, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }

    public function getDataPage($numeropage)//recupere les données en fonction du numéro de page mis en parametre
    {
        $debut = ($numeropage-1)*10;
        try {
            $req = $this->bd->prepare('SELECT * FROM mytable LIMIT :debut,10');
            $req->bindValue(':debut', $debut, PDO::PARAM_INT);
            $req->execute();
            return $req->fetchall();
        } catch (PDOException $e) {
            die('Echec getDataPage, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }
}
