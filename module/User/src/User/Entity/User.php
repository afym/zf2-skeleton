<?php

class User
{
    private $id;
    private $name;

    public function __construct()
    {
        $this->id = 0;
        $this->name = 'Angel';
    }

    public function getName()
    {
        return $this->name;
    }
}