<?php

// models/Chapter.php

class Chapter
{
    private $id;
    private $title;
    private $description;
    private $image;
    private $next;

    public function __construct($id, $title, $description, $image, $next)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->next = $next;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }


    public function getNext()
    {
        return $this->next;
    }
}
