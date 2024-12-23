<?php

// controllers/ChapterController.php

require_once 'models/Chapter.php';
require_once 'database/connexion_db.php';
session_start();

class ChapterController
{
    private $chapter = null;


    public function chargeChap($chapId){
        
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

    public function show(){
        //print_r($id);
        if(isset($_SESSION['pla_id'])){
            $conn = connect_db();

            $play = $_SESSION['pla_id'];

            $sql1 = "SELECT cha_id FROM hero her 
            JOIN player pla ON her.PLA_ID = pla.PLA_ID
            WHERE pla.PLA_ID = :play";

            $cur1 = $conn->prepare($sql1);
                $cur1->execute([':play' => $play]);
            $tab1 = $cur1->fetchAll();

            print_r($tab1);

            $chapId = $tab1[0]['cha_id'];
            $this->chargeChap($chapId);

            if ($this->chapter !== null) {
                $chapter = $this->getChapter();
                $next = $chapter->getNext();

                include 'views/chapitre.php';
            } else {
                header('HTTP/1.0 404 Not Found');
                echo "Chapitre non trouvé!";
            }
        }
    }

    public function showID($id)
    {
        //print_r($id);
        $this->chargeChap($id);

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

    function show_inventory(){
        $play = $_SESSION['pla_id'];
        $sql = "SELECT ite_name, ite_poids, ite_value FROM items it
                JOIN inventory inv ON it.ite_id = inv.ite_id
                JOIN hero her ON her.her_id = inv.her_id
                JOIN player pla ON pla.pla_id = her.pla_id
                WHERE pla.pla_id = :playId
                ORDER BY her_id
                FETCH FIRST 1 ROW ONLY";

        $cur = $conn->prepare($sql);
        $cur->execute([':playId' => $play]);
        $tab = $cur->fetchAll();
        print_r($tab);
    }
}

