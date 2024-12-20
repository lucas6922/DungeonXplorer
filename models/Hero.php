<?php

require_once 'database/connexion_db.php';


class Hero{
    private $cla_id;
    private $pla_id;
    private $her_name;
    private $her_image;
    private $her_biography;

    public function setClasseId($classe_id) { $this->cla_id = $classe_id; }
    public function setJoueurId($joueur_id) { $this->pla_id = $joueur_id; }
    public function setNom($nom) { $this->her_name = $nom; }
    public function setImage($image) { $this->her_image = $image; }
    public function setBiographie($biographie) { $this->her_biography = $biographie; }

    public function save()
    {
        $conn = connect_db();

        
        $classe = Classe::getById($this->cla_id);

        if (!$classe) {
            throw new Exception("Classe non trouvée.");
        }

        $rqp = $conn->prepare('
            INSERT INTO HERO 
            (CLA_ID, PLA_ID, HER_NAME, HER_IMAGE, HER_BIOGRAPHY, HER_PV, HER_MANA, HER_STRENGTH, HER_INITIATIVE, HER_ARMOR, HER_PRIM_WEAPON, HER_SEC_WEAPON, HER_SHIELD, HER_SPELL_LIST, HER_XP, HER_CURRENT_LEVEL) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, 0, 1)
        ');

        $rqp->execute([
            $this->cla_id,
            $this->pla_id,
            $this->her_name,
            $this->her_image,
            $this->her_biography,
            $classe['CLA_BASE_PV'],
            $classe['CLA_BASE_MANA'],
            $classe['CLA_STRENGTH'],
            $classe['CLA_INITIATIVE']
        ]);
    }

    public function getAllHeros($pla_id){
        $conn = connect_db();
        $rqp = $conn->prepare('SELECT * FROM HERO JOIN CLASS USING(CLA_ID) WHERE PLA_ID = ?');
        $rqp->execute([$pla_id]);
        $res =  $rqp->fetchAll(PDO::FETCH_ASSOC);
        /*
        echo '<pre>';
        print_r($res);
        echo '</pre>';
        */

        return $res;
    }

}
