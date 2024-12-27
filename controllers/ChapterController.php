<?php

// controllers/ChapterController.php

require_once 'models/Chapter.php';
require_once 'database/connexion_db.php';
session_start();


class ChapterController
{
    private $chapter = null;


    public function chargeChap($chapId)
    {
        $conn = connect_db();

        $sql = "SELECT * FROM CHAPTER cha 
                LEFT JOIN LINK lin ON cha.CHA_ID = lin.CHA_ID 
                WHERE cha.CHA_ID = :chapterId";

        $cur = $conn->prepare($sql);
        $cur->execute([':chapterId' => $chapId]);
        $tab = $cur->fetchAll();
        /*
        echo "<pre>";
        print_r($tab);
        echo "</pre>";
        */
        if (!empty($tab)) {
            $next = [];
            foreach ($tab as $next_chap) {
                $next[$next_chap['CHA_ID_1']] = $next_chap['LIN_CONTENT'];
            }
            /*
            echo "<pre>";
            print_r($next);
            echo "</pre>";
            */

            $this->chapter = new Chapter(
                $tab[0]['CHA_ID'],
                $tab[0]['CHA_NAME'],
                $tab[0]['CHA_CONTENT'],
                $tab[0]['CHA_IMAGE'],
                $next
            );
        }
    }

    public function show()
    {
        //print_r($id);
        $playerId = $_SESSION['pla_id'] ?? null;

        if ($playerId) {
            $conn = connect_db();
            $play = $_SESSION['pla_id'];
            $rqp = $conn->prepare("SELECT 1 FROM HERO JOIN PLAYER USING(PLA_ID) WHERE PLA_ID = :pla_id");
            $rqp->execute(['pla_id' => $playerId]);

            if ($rqp->fetch()) {
                $sql1 = "SELECT cha_id FROM hero her 
            JOIN player pla ON her.PLA_ID = pla.PLA_ID
            WHERE pla.PLA_ID = :play";

                $cur1 = $conn->prepare($sql1);
                $cur1->execute([':play' => $play]);
                $tab1 = $cur1->fetchAll();

                // var_dump($play);
                // print_r($tab1);
                $chapId = $tab1[0]['cha_id'];
                $this->chargeChap($chapId);

                if ($this->chapter !== null) {
                    $chapter = $this->getChapter();
                    $next = $chapter->getNext();

                    include 'views/chapitre.php';
                    $this->show_inventory();
                    $this->show_treasure($chapId);
                } else {
                    header('HTTP/1.0 404 Not Found');
                    echo "Chapitre non trouvé!";
                }
            } else {
                $_SESSION['error_message'] = "Vous devez avoir un hero pour commencer une aventure";
                header("Location: ./");
            }
        } else {
            $this->afficherErreurAuth("Vous devez être connecté pour accéder à l'aventure.");
        }
    }

    public function showID($id)
    {
        //print_r($id);
        $this->chargeChap($id);
        $conn = connect_db();
        $play = $_SESSION['pla_id'];

        $sql = "UPDATE hero SET cha_id = :newId
        WHERE pla_id = :play";
        //print($sql);

        $cur = $conn->prepare($sql);
        $cur->execute([':newId' => $id, ':play' => $play]);

        if ($this->chapter !== null) {
            $chapter = $this->getChapter();
            $next = $chapter->getNext();

            include 'views/chapitre.php';
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé!";
        }
    }

    public function getChapter()
    {
        return $this->chapter;
    }

    function show_inventory()
    {
        $conn = connect_db();
        $play = $_SESSION['pla_id'];
        $sql = "SELECT ite_name, ite_poids, ite_value FROM items it
                JOIN inventory inv ON it.ite_id = inv.ite_id
                JOIN hero her ON her.her_id = inv.her_id
                JOIN player pla ON pla.pla_id = her.pla_id
                WHERE pla.pla_id = :playId
                ORDER BY her.her_id
                LIMIT 1";

        $cur = $conn->prepare($sql);
        $cur->execute([':playId' => $play]);
        $tab = $cur->fetchAll();
        //print_r($tab);
    }

    function show_treasure($id)
    {
        $conn = connect_db();
        $play = $_SESSION['pla_id'];
        $sql = "SELECT ite_name, ite_poids, ite_value FROM items it
                JOIN contains con ON it.ite_id = con.ite_id
                JOIN loot loo ON loo.loo_id = con.loo_id
                JOIN chapter cha ON cha.loo_id = loo.loo_id
                WHERE cha.cha_id = :id";

        $cur = $conn->prepare($sql);
        $cur->execute([':id' => $id]);
        $tab = $cur->fetchAll();
        print_r($tab);
    }

    private function afficherErreurAuth($message)
    {
        require 'views/auth_error.php';
    }
}
