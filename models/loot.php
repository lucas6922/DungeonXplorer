<?php

// models/loot.php

class loot{
    private $id;
    private $elt;

    public function __construct($id, $elt)
    {
        $this->id = $id;
        $this->elt = $elt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getElt()
    {
        return $this->elt;
    }
}