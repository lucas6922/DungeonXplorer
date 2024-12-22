<?php
    require_once 'models/Hero.php';
    require_once 'database/connexion_db.php';
    
    class fenetreCombatController {
        private $hero = null;
        public function __construct(){

            $conn = connect_db();
            $sql = "select * from HERO where HER_ID = 1;";
            $cur = $conn->prepare($sql);
            $res = $cur->execute();
            $tab = $cur->fetchAll();
            $this->hero = new Hero($tab[0]['HER_ID'], $tab[0]['CLA_ID'], $tab[0]['PLA_ID'], $tab[0]['HER_NAME'], $tab[0]['HER_IMAGE'], $tab[0]['HER_BIOGRAPHY'], $tab[0]['HER_PV'], $tab[0]['HER_MANA'], $tab[0]['HER_STRENGTH'], $tab[0]['HER_INITIATIVE'], $tab[0]['HER_ARMOR'], $tab[0]['HER_PRIM_WEAPON'], $tab[0]['HER_SEC_WEAPON'], $tab[0]['HER_SHIELD'], $tab[0]['HER_SPELL_LIST'], $tab[0]['HER_XP'], $tab[0]['HER_CURRENT_LEVEL']);
        }

        public function getHero()
        {
            return $this->hero; 
        }
        

        public function combat() {
            $hero = $this->getHero();
            if ($hero != null) {
                include 'views/fenetreCombat.php'; // Charge la vue pour le hero
            } else {
                // Si le chapitre n'existe pas, redirige vers un chapitre par défaut ou affiche une erreur
                header('HTTP/1.0 404 Not Found');
                echo "Héros non trouvé!";
            }
        }
    }