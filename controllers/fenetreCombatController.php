<?php
    require_once 'models/Hero.php';
    require_once 'database/connexion_db.php';
    
    class fenetreCombatController {
        private $hero = null;

        public function chargeHeros($herId){

            $conn = connect_db();
            $sql = "select * from HERO where HER_ID = :herId;";
            $cur = $conn->prepare($sql);
            $cur->execute([':herId' => $herId]);
            $tab = $cur->fetchAll();
            $this->hero = new Hero();
            $this->hero->setId($tab[0]['HER_ID']);
            $this->hero->setClaId($tab[0]['CLA_ID']);
            $this->hero->setJoueurID($tab[0]['PLA_ID']);
            $this->hero->setNom($tab[0]['HER_NAME']);
            $this->hero->setImage($tab[0]['HER_IMAGE']);
            $this->hero->setBiographie($tab[0]['HER_BIOGRAPHY']);
            $this->hero->setPV($tab[0]['HER_PV']);
            $this->hero->setMana($tab[0]['HER_MANA']);
            $this->hero->setStrength($tab[0]['HER_STRENGTH']);
            $this->hero->setInitiative($tab[0]['HER_INITIATIVE']);
            $this->hero->setArmor($tab[0]['HER_ARMOR']);
            $this->hero->setPrimWeapon($tab[0]['HER_PRIM_WEAPON']);
            $this->hero->setSecWeapon($tab[0]['HER_SEC_WEAPON']);
            $this->hero->setShield($tab[0]['HER_SHIELD']);
            $this->hero->setSpellList($tab[0]['HER_SPELL_LIST']);
            $this->hero->setXP($tab[0]['HER_XP']);
            $this->hero->setCurrentLevel($tab[0]['HER_CURRENT_LEVEL']);

        }

        public function getHero()
        {
            return $this->hero; 
        }
        

        public function combat($herId) {
            $this->chargeHeros($herId);
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