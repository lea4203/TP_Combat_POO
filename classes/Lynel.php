<?php


class Lynel extends Monster
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->setHealthPoint($this->getHealthPoint() + 20);
    }

 
    
    
}