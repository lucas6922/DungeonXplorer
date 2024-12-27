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

    public function getAllTypes()
    {
        $rq = $this->conn->prepare("SELECT TYP_ID, TYP_LIBELLE FROM TYPE_ITEM");
        $rq->execute();
        return $rq->fetchAll(PDO::FETCH_ASSOC);
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
     * supprime un item
     */
    public function suppItem($id)
    {
        $rqp = $this->conn->prepare("DELETE FROM ITEMS WHERE ITE_ID = ?");
        $rqp->execute([$id]);
    }


    /**
     * revoi si oui ou non un item existe avec le nom
     */
    public function isNotUniqueItem($nom)
    {
        $rqp = $this->conn->prepare("SELECT 1 FROM ITEMS WHERE ite_name = :nom");
        $rqp->execute(['nom' => $nom]);
        return $rqp->fetch();
    }


    /**
     * revoi si oui ou non un loot existe avec le nom
     */
    public function isNotUniqueLoot($nom)
    {
        $rqp = $this->conn->prepare("SELECT 1 FROM LOOT WHERE loo_name = :nom");
        $rqp->execute(['nom' => $nom]);
        return $rqp->fetch();
    }

    /**
     * insert l'item
     */
    public function insertItem($ite_name, $ite_description, $ite_poids, $typ_id, $ite_value)
    {
        //calcul l'id max
        $rqp = $this->conn->query("SELECT MAX(ITE_ID) AS maxi FROM ITEMS");
        $result = $rqp->fetch(PDO::FETCH_OBJ);
        //id + 1 pour le nouveau joueur
        $id = $result->maxi + 1;


        //insert le monstre
        $rqp = $this->conn->prepare("
            INSERT INTO ITEMS (ITE_ID, TYP_ID, ITE_NAME, ITE_DESCRIPTION, ITE_POIDS, ITE_VALUE) 
            VALUES ($id, :type, :name, :desc, :poid, :val)");

        $rqp->execute([
            'type' => $typ_id,
            'name' => $ite_name,
            'desc' => $ite_description,
            'poid' => $ite_poids,
            'val' => $ite_value,
        ]);
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
     * récupère les valeurs d'un item
     */
    public function getItem($id)
    {
        $rq = $this->conn->prepare("SELECT * FROM ITEMS JOIN TYPE_ITEM USING(TYP_ID) WHERE ITE_ID = :ite_id");
        $rq->execute(['ite_id' => $id]);
        return $rq->fetch();
    }

    /**
     * récupère les valeurs d'un loot
     */
    private function getLoot($id)
    {
        $rq = $this->conn->prepare("SELECT LOOT.LOO_ID, LOOT.LOO_NAME, LOOT.LOO_QUANTITY, 
                CONTAINS.ITE_ID, CONTAINS.CON_QTE, ITEMS.ITE_NAME
                FROM LOOT
                LEFT JOIN CONTAINS ON LOOT.LOO_ID = CONTAINS.LOO_ID
                LEFT JOIN ITEMS ON CONTAINS.ITE_ID = ITEMS.ITE_ID
                WHERE LOOT.LOO_ID = :loo_id");

        $rq->execute(['loo_id' => $id]);
        return $rq->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStructLoot($id)
    {

        //récupère toutes les données
        $lootItems = $this->getLoot($id);
        //si aucun loot
        if (!$lootItems) {
            return null;
        }
        $loot = [
            'LOO_ID' => $lootItems[0]['LOO_ID'],
            'LOO_NAME' => $lootItems[0]['LOO_NAME'],
            'LOO_QUANTITY' => $lootItems[0]['LOO_QUANTITY'],
            'ITEMS' => []
        ];
        //met en forme
        foreach ($lootItems as $item) {
            if (!empty($item['ITE_ID'])) {
                $loot['ITEMS'][] = [
                    'ITE_ID' => $item['ITE_ID'],
                    'ITE_NAME' => $item['ITE_NAME'],
                    'CON_QTE' => $item['CON_QTE']
                ];
            }
        }
        return $loot;
    }

    /**
     * mise à jour de l'item
     */
    public function updateItem($ite_name, $ite_description, $ite_poids, $ite_value, $typ_id, $ite_id)
    {
        $rq = $this->conn->prepare("
        UPDATE ITEMS 
        SET ITE_NAME = :ite_name, ITE_DESCRIPTION = :ite_description, ITE_POIDS = :ite_poids, ITE_VALUE = :ite_value, 
            TYP_ID = :typ_id
        WHERE ITE_ID = :ite_id
    ");
        $rq->execute([
            'ite_name' => $ite_name,
            'ite_description' => $ite_description,
            'ite_poids' => $ite_poids,
            'ite_value' => $ite_value,
            'typ_id' => $typ_id,
            'ite_id' => $ite_id
        ]);
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
