<?php

// controllers/ChapterController.php

require_once 'models/Chapter.php';
require_once 'database/connexion_db.php';

class ChapterController
{
    private $chapter = null;

    public function __construct()
    {
        $conn = connect_db();
        $sql = "select * from 
        CHAPTER cha join LINK lin on cha.cha_id = lin.cha_id 
        where cha.CHA_ID = 2;";
        $cur = $conn->prepare($sql);
        $res = $cur->execute();
        $tab = $cur->fetchAll();
        /*
        echo "<pre>";
        print_r($tab);
        echo "</pre>";
        */
        $next = array();
        foreach ($tab as $next_chap) {
            $next[$next_chap['CHA_ID_1']] = $next_chap['LIN_CONTENT'];
        }

        /*
        echo "<pre>";
        print_r($next);
        echo "</pre>";
        */
        $this->chapter = new Chapter($tab[0]['CHA_ID'], $tab[0]['CHA_NAME'], $tab[0]['CHA_CONTENT'], $tab[0]['CHA_IMAGE'], $next);
    }

    public function show()
    {
        $chapter = $this->getChapter();
        $next = $chapter->getNext();
        if ($chapter != null) {
            include 'views/chapitre.php'; // Charge la vue pour le chapitre
        } else {
            // Si le chapitre n'existe pas, redirige vers un chapitre par défaut ou affiche une erreur
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé!";
        }
    }

    public function getChapter()
    {
        return $this->chapter;
    }
}
