<?php

// models/Chapter.php

class AdmMonstre
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
     * récupère la liste des monstres
     */
    public function getAllMonstres()
    {
        $select = $this->conn->query("SELECT * FROM MONSTER LEFT JOIN LOOT USING(LOO_ID)");
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * suppression d'un monstre
     */
    public function suppMonstre($id)
    {
        $del = $this->conn->prepare("DELETE FROM MONSTER WHERE MON_ID = ?");
        $del->execute([$id]);
    }

    /**
     * verifie si un monstre existe avec le même nom
     */
    public function isNotUniqueMonst($name)
    {
        $rqp = $this->conn->prepare("SELECT 1 FROM MONSTER WHERE mon_name = :nom");
        $rqp->execute(['nom' => $name]);
        return $rqp->fetch() != false;
    }

    /**
     * calcule l'id du monstre à inserer
     */
    private function maxId()
    {
        $rqp = $this->conn->query("SELECT MAX(MON_ID) AS maxi FROM MONSTER");
        $result = $rqp->fetch(PDO::FETCH_OBJ);
        //id + 1 pour le nouveau monstre
        return $result->maxi + 1;
    }


    /**
     * ajout d'un monstre
     */
    public function insertMonstre($loo_id, $mon_name, $mon_pv, $mon_mana, $mon_initiative, $mon_strength, $mon_attack, $mon_xp)
    {
        $id = $this->maxId();
        $rqp = $this->conn->prepare("
        INSERT INTO MONSTER (MON_ID, LOO_ID, MON_NAME, MON_PV, MON_MANA, MON_INITIATIVE, MON_STRENGTH, MON_ATTACK, MON_XP)
        VALUES ($id, :loot, :name, :pv, :mana, :initiative, :strength, :attack, :xp)");
        $rqp->execute([
            'loot' => $loo_id,
            'name' => $mon_name,
            'pv' => $mon_pv,
            'mana' => $mon_mana,
            'initiative' => $mon_initiative,
            'strength' => $mon_strength,
            'attack' => $mon_attack,
            'xp' => $mon_xp,
        ]);
    }

    /**
     * recupère un monstre à partir d'un id
     */
    public function getMonstre($id)
    {
        $rq = $this->conn->prepare("SELECT * FROM MONSTER JOIN LOOT USING(LOO_ID) WHERE MON_ID = :mon_id");
        $rq->execute(['mon_id' => $id]);
        return $rq->fetch();
    }

    /**
     * mise à jour du monstre
     */
    public function updateMonstre($mon_name, $mon_pv, $mon_mana, $mon_initiative, $mon_strength, $mon_attack, $mon_xp, $mon_id, $loo_id)
    {
        $rq = $this->conn->prepare("
                UPDATE MONSTER 
                SET LOO_ID = :loo_id, MON_NAME = :mon_name, MON_PV = :mon_pv, MON_MANA = :mon_mana, MON_INITIATIVE = :mon_initiative, 
                    MON_STRENGTH = :mon_strength, MON_ATTACK = :mon_attack, MON_XP = :mon_xp
                WHERE MON_ID = :mon_id
            ");
        $rq->execute([
            'loo_id' => $loo_id,
            'mon_name' => $mon_name,
            'mon_pv' => $mon_pv,
            'mon_mana' => $mon_mana,
            'mon_initiative' => $mon_initiative,
            'mon_strength' => $mon_strength,
            'mon_attack' => $mon_attack,
            'mon_xp' => $mon_xp,
            'mon_id' => $mon_id
        ]);
    }
}
