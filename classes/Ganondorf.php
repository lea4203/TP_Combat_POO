<?php


class Ganondorf extends Monster 
{
    private $id;
    private $name;
    private $health_point = 100;
    private $type;
  
    public function __construct(array $data)
    {
        $this->hydrate($data);
        $this->type = $data['type'] ?? 'Ganondorf';
    }

    
    


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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


    public function hit(Hero $hero){
        $damage = rand(5, 20);
        
        if($hero instanceof Gerudo){
            $damage = $damage * 2;
        }

        if ($hero->getHealthPoint() - $damage < 0) {
            $hero->setHealthPoint(0);
        }else{
            $hero->setHealthPoint($hero->getHealthPoint() - $damage);
        }
        return $damage;
    }
  
}