<?php




class Monster
{

    private $name;
    private $health_point = 100;


    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data){
        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
        if (isset($data['health_point'])) {
            $this->setHealthPoint($data['health_point']);
        }
    } 

    public function hit(Hero $hero){
        $damage = rand(5, 20);
        if ($hero->getHealthPoint() - $damage < 0) {
            $hero->setHealthPoint(0);
        }else{
            $hero->setHealthPoint($hero->getHealthPoint() - $damage);
        }
        return $damage;
    }

    //GETTER


    public function getName(){
        return $this->name;
    }
    public function getHealthPoint(){
        return $this->health_point;
    }

    //SETTER

    public function setName($name){
        $this->name = $name;
    }

    public function setHealthPoint($health_point){
        $this->health_point = $health_point;
    }
}