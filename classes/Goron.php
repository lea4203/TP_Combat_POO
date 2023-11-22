<?php

class Goron extends Hero
{

    private $name;
    private $health_point = 100;
    private $type;
    

     
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->setHealthPoint($this->getHealthPoint() - 20);
        $this->type = 'Goron';
    }



    


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of health_point
     */
    public function getHealthPoint()
    {
        return $this->health_point;
    }

    /**
     * Set the value of health_point
     */
    public function setHealthPoint($health_point): self
    {
        $this->health_point = $health_point;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }
}