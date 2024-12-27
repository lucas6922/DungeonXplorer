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

    /**
     * met en forme le resultat de la récupération des loots
     */
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

    /**
     * supprime un loot et les items qui y sont associé
     */
    public function suppLoot($id)
    {
        //suppression de l'associatoin des items au loot
        $del = $this->conn->prepare("DELETE FROM CONTAINS WHERE LOO_ID = ?");
        $del->execute([$id]);

        //suppression du loot en lui même
        $del = $this->conn->prepare("DELETE FROM LOOT WHERE LOO_ID = ?");
        $del->execute([$id]);
    }


    /**
     * revoi si oui ou non un loot existe avec le nom
     */
    public function isUniqueLoot($nom)
    {
        $rqp = $this->conn->prepare("SELECT 1 FROM LOOT WHERE loo_name = :nom");
        $rqp->execute(['nom' => $nom]);
        return $rqp->fetch();
    }

    /**
     * insert le loot avec ses items
     */
    public function insertLoot($loo_name, $loo_quantity, $items)
    {
        // echo "<pre>";
        // echo $loo_name . "\n";
        // echo $loo_quantity . "\n";
        // print_r($items);
        // echo "<pre>";


        //insert le nom et la quantite du loot
        $rqp = $this->conn->prepare("
            INSERT INTO LOOT (LOO_NAME,LOO_QUANTITY) 
            VALUES (:name, :quantity)");

        $rqp->execute([
            'name' => $loo_name,
            'quantity' => $loo_quantity,
        ]);


        //récupère l'id du loot
        $lootId = $this->conn->lastInsertId();
        // $_SESSION['debug'] = $lootId;

        // Insérer les items et les associer au loot
        $_SESSION['debug'] = $items;

        foreach ($items as $item) {
            //     $_SESSION['IDTAH'] = $lootId;
            //     $_SESSION['ID'] = $item['ite_id'];
            //     $_SESSION['QTE'] = $item['quantity'];

            //si item récupéré faire le lien entre le loot et l'item
            if (!empty($item['ite_id']) && !empty($item['quantity'])) {
                $rqp = $this->conn->prepare("
                    INSERT INTO CONTAINS (LOO_ID, ITE_ID, CON_QTE) 
                    VALUES (:lootId, :itemId, :qte)
                ");
                $rqp->execute([
                    'lootId' => $lootId,
                    'itemId' => $item['ite_id'],
                    'qte' => $item['quantity'],
                ]);
            }
        }
    }


    /**
     * mise à jour d'un loot
     * mise à jour des items qui y sont associé
     */
    public function updateLoot($loo_id, $loo_name, $loo_quantity, $items)
    {
        $updtae = "
            UPDATE LOOT 
            SET LOO_NAME = :name, LOO_QUANTITY = :quantity 
            WHERE LOO_ID = :lootId
        ";
        $rqp = $this->conn->prepare($updtae);
        $rqp->execute([
            'name' => $loo_name,
            'quantity' => $loo_quantity,
            'lootId' => $loo_id,
        ]);

        //supprime les ancien items associé
        $del = "DELETE FROM CONTAINS WHERE LOO_ID = :lootId";
        $rqp = $this->conn->prepare($del);
        $rqp->execute(['lootId' => $loo_id]);

        //insert les nouveaux items
        if (!empty($items)) {
            $insert = "
                INSERT INTO CONTAINS (LOO_ID, ITE_ID, CON_QTE) 
                VALUES (:lootId, :itemId, :quantity)
            ";
            $rqp = $this->conn->prepare($insert);

            foreach ($items as $item) {
                if (!empty($item['ite_id']) && !empty($item['ite_quantity'])) {
                    $rqp->execute([
                        'lootId' => $loo_id,
                        'itemId' => $item['ite_id'],
                        'quantity' => $item['ite_quantity'],
                    ]);
                }
            }
        }
    }
}
