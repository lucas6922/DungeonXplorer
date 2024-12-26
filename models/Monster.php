<?php

// models/Monster.php

class Monster
{
    protected $id;
    protected $name;
    protected $health;
    protected $mana;
    protected $initiative;
    protected $strength;
    protected $experienceValue;
    protected $treasure;

    public function __construct($id, $name, $health, $mana, $initiative, $strength, $experienceValue, $treasure)
    {
        $this->id = $id;
        $this->name = $name;
        $this->health = $health;
        $this->mana = $mana;
        $this->initiative = $initiative;
        $this->strength = $strength;
        $this->experienceValue = $experienceValue;
        $this->treasure = $treasure;
    }


    public function getName()
    {
        return $this->name;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getMana()
    {
        return $this->mana;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getInitiative()
    {
        return $this->initiative;
    }

    public function getExperienceValue()
    {
        return $this->experienceValue;
    }

    public function getTreasure()
    {
        return $this->treasure;
    }
}
