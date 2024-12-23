<?php

// controllers/ChapterController.php

require_once 'models/Chapter.php';
require_once 'database/connexion_db.php';

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
        $chapId = isset($_GET['cha_id']) ? (int)$_GET['cha_id'] : 1;
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

    public function getChapter()
    {
        return $this->chapter;
    }
}
