<?php

require_once 'database/connexion_db.php';


class Hero
{
    private $her_id;
    private $cla_id;
    private $pla_id;
    private $her_name;
    private $her_image;
    private $her_biography;
    private $her_pv;
    private $her_mana;
    private $her_strength;
    private $her_initiative;
    private $her_armor;
    private $her_prim_weapon;
    private $her_sec_weapon;
    private $her_shield;
    private $her_spell_list;
    private $her_xp;
    private $her_current_level;

    public function setClasseId($classe_id)
    {
        $this->cla_id = $classe_id;
    }
    public function setJoueurId($joueur_id)
    {
        $this->pla_id = $joueur_id;
    }
    public function setNom($nom)
    {
        $this->her_name = $nom;
    }
    public function setImage($image)
    {
        $this->her_image = $image;
    }
    public function setBiographie($biographie)
    {
        $this->her_biography = $biographie;
    }
    public function setClaId($cla_id)
    {
        $this->cla_id = $cla_id;
    }
    public function setId($id)
    {
        $this->her_id = $id;
    }
    public function setPV($pv)
    {
        $this->her_pv = $pv;
    }
    public function setMana($mana)
    {
        $this->her_mana = $mana;
    }
    public function setStrength($strength)
    {
        $this->her_strength = $strength;
    }
    public function setInitiative($initiative)
    {
        $this->her_initiative = $initiative;
    }
    public function setArmor($armor)
    {
        $this->her_armor = $armor;
    }
    public function setPrimWeapon($weapon)
    {
        $this->her_prim_weapon = $weapon;
    }
    public function setSecWeapon($weapon)
    {
        $this->her_sec_weapon = $weapon;
    }
    public function setShield($shield)
    {
        $this->her_shield = $shield;
    }
    public function setSpellList($spellList)
    {
        $this->her_spell_list = $spellList;
    }
    public function setXP($xp)
    {
        $this->her_xp = $xp;
    }
    public function setCurrentLevel($level)
    {
        $this->her_current_level = $level;
    }



    public function getName()
    {
        return $this->her_name;
    }
    public function getClaId()
    {
        return $this->cla_id;
    }
    public function getId()
    {
        return $this->her_id;
    }
    public function getPV()
    {
        return $this->her_pv;
    }
    public function getMana()
    {
        return $this->her_mana;
    }
    public function getStrength()
    {
        return $this->her_strength;
    }
    public function getInitiative()
    {
        return $this->her_initiative;
    }
    public function getArmor()
    {
        return $this->her_armor;
    }
    public function getPrimWeapon()
    {
        return $this->her_prim_weapon;
    }
    public function getSecWeapon()
    {
        return $this->her_sec_weapon;
    }
    public function getShield()
    {
        return $this->her_shield;
    }
    public function getSpellList()
    {
        return $this->her_spell_list;
    }

    public function save()
    {
        $conn = connect_db();


        $classe = Classe::getById($this->cla_id);

        if (!$classe) {
            throw new Exception("Classe non trouvée.");
        }

        $rqp = $conn->prepare('
            INSERT INTO HERO 
            (CLA_ID, PLA_ID,CHA_ID, HER_NAME, HER_IMAGE, HER_BIOGRAPHY, HER_PV, HER_MANA, HER_STRENGTH, HER_INITIATIVE, HER_ARMOR, HER_PRIM_WEAPON, HER_SEC_WEAPON, HER_SHIELD, HER_SPELL_LIST, HER_XP, HER_CURRENT_LEVEL) 
            VALUES (?, ?,1, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL, NULL, NULL, 0, 1)
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

    public function getAllHeros($pla_id)
    {
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
