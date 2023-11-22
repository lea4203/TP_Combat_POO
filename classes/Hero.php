<?php



class Hero 
{

    private $id;
    private $name;
    private $health_point = 100;
    private $type;
 



    public function __construct(array $data)
    {
        $this->hydrate($data);
        $this->type = $data['type'] ?? 'Hero';
    }

    public function hydrate(array $data){
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }
        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
        if (isset($data['health_point'])) {
            $this->setHealthPoint($data['health_point']);
        }
        if (isset($data['type'])) {
            $this->setType($data['type']);
        }
       

        
      
    } 

    public function hit(Monster $monster){
        $damage = rand(5, 20);
            
        if ($monster->getHealthPoint() - $damage < 0) {
            $monster->setHealthPoint(0);
        }else{
            $monster->setHealthPoint($monster->getHealthPoint() - $damage);
        }
        return $damage;
    }

    //GETTER
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }
    public function getHealthPoint(){
        return $this->health_point;
    }

    //SETTER
    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setHealthPoint($health_point){
        $this->health_point = $health_point;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getType(){
        return $this->type;
    }


    
    

    



}