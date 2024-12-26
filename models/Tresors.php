<?php

class Tresors
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
     * récupère tous les items de la base
     * avec leurs types
     */
    public function getAllItems()
    {
        $select = $this->conn->query("SELECT * FROM ITEMS JOIN TYPE_ITEM USING(TYP_ID)");
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * récupère tous les loots
     * avec leurs contenu
     */
    public function getAllLoots()
    {
        $select = $this->conn->query("SELECT * FROM LOOT 
        LEFT JOIN CONTAINS USING(LOO_ID)
        LEFT JOIN ITEMS USING(ITE_ID)");
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function transformLoot($loots)
    {
        $nLoot = [];
        //parcour de tous les loots
        foreach ($loots as $loot) {
            $lootId = $loot['LOO_ID'];
            if (!isset($nLoot[$lootId])) {
                //crée une entrée pour le loot s'il n'existe pas encore
                $nLoot[$lootId] = [
                    'LOO_ID' => $lootId,
                    'LOO_NAME' => $loot['LOO_NAME'],
                    'LOO_QUANTITY' => $loot['LOO_QUANTITY'],
                    'ITEMS' => []
                ];
            }
            // Ajoute l'item au loot
            $nLoot[$lootId]['ITEMS'][] = [
                'ITE_NAME' => $loot['ITE_NAME'],
                'CON_QTE' => $loot['CON_QTE']
            ];
        }

        return $nLoot;
    }
}
