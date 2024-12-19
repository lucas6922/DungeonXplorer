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
        $sql = "select * from CHAPTER where CHA_ID = 1;";
        $cur = $conn->prepare($sql);
        $res = $cur->execute();
        $tab = $cur->fetchAll();
        //print_r($tab);
        $this->chapter = new Chapter($tab[0]['CHA_ID'], $tab[0]['CHA_NAME'], $tab[0]['CHA_CONTENT'], $tab[0]['CHA_IMAGE'], [1,2]);
    }

    public function show()
    {
        $chapter = $this->getChapter();

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
