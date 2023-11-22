<?php


class HeroManager
{

    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add(Hero $hero)
    {
        $req = $this->db->prepare("INSERT INTO heroes (name, type) VALUES (:name, :type)");
        $req->bindValue(':name', $hero->getName());
        $req->bindValue(':type', $hero->getType());
        $req->execute();
    }

  

    public function findAllAlive()
    {
        $req = $this->db->prepare("SELECT * FROM heroes WHERE health_point > 0");
        $req->execute();
        $heroesArray = $req->fetchAll(PDO::FETCH_ASSOC);
        $heroes = [];
        foreach ($heroesArray as $heroArray) {
            $heroes[] = new Hero($heroArray);
        }
        return $heroes;
        
    }


    public function find(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM heroes WHERE id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        $heroArray = $req->fetch(PDO::FETCH_ASSOC);        
        return new Hero($heroArray);
    }

    public function update(Hero $hero)
    {
        $req = $this->db->prepare("UPDATE heroes SET health_point = :health_point WHERE id = :id");
        $req->bindValue(':health_point', $hero->getHealthPoint());
        $req->bindValue(':id', $hero->getId());
        $req->execute();
    }

 
   

  
}
