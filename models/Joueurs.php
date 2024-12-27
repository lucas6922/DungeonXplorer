<?php
class Joueurs
{
    private $conn;

    /** 
     *constructeur
     */
    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    /**
     * recupère tous les joueurs de la base
     */
    public function getAllJoueurs()
    {
        $select = $this->conn->query("SELECT * FROM PLAYER");
        return  $select->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * supprime un joueur
     */
    public function suppJoueur($id)
    {
        $rqp = $this->conn->prepare("DELETE FROM PLAYER WHERE PLA_ID = ?");
        $rqp->execute([$id]);
    }
}
