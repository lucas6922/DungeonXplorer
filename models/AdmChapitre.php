<?php
class AdmChapitre
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
     * renvoie la liste de tous les chapitres
     */
    public function getAllChap()
    {
        $select = $this->conn->query("SELECT * FROM CHAPTER LEFT JOIN LOOT USING(LOO_ID)");
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * supprime un chapitre
     */
    public function suppChap($id)
    {
        $del = $this->conn->prepare("DELETE FROM CHAPTER WHERE CHA_ID = ?");
        $del->execute([$id]);
    }

    /**
     * vérifie si un chapitre existe deja avec ce nom
     */
    public function isNotUniqueChap($name)
    {
        $rqp = $this->conn->prepare("SELECT 1 FROM CHAPTER WHERE cha_name = :nom");
        return $rqp->execute(['nom' => $name]);
    }


    /**
     * insertion d'un chapitre
     */
    public function insertChap($loo_id, $cha_name, $cha_content, $cha_image)
    {
        $rqp = $this->conn->prepare("
                INSERT INTO CHAPTER (LOO_ID, CHA_NAME, CHA_CONTENT, CHA_IMAGE)
                VALUES (:loot, :titre, :content, :image)
            ");
        $rqp->execute([
            'loot' => $loo_id,
            'titre' => $cha_name,
            'content' => $cha_content,
            'image' => $cha_image,
        ]);
    }

    /**
     * recuper le chapitre et son loot
     */
    public function getChap($id)
    {
        $rq = $this->conn->prepare("SELECT * FROM CHAPTER JOIN LOOT USING(LOO_ID) WHERE CHA_ID = :cha_id");
        $rq->execute(['cha_id' => $id]);
        return $rq->fetch();
    }

    /**
     * mise à jour du chapitre
     */
    public function updateChap($cha_name, $cha_content, $cha_id, $cha_image, $loo_id)
    {
        $rq = $this->conn->prepare("
        UPDATE CHAPTER 
        SET LOO_ID = :loo_id, CHA_NAME = :cha_name, CHA_CONTENT = :cha_content, CHA_IMAGE = :cha_image
        WHERE CHA_ID = :cha_id");
        $rq->execute([
            'loo_id' => $loo_id,
            'cha_name' => $cha_name,
            'cha_content' => $cha_content,
            'cha_id' => $cha_id,
            'cha_image' => $cha_image
        ]);
    }
}
