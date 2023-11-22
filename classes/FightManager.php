<?php

include_once 'Hero.php';
include_once 'Monster.php';
include_once 'Lynel.php';
include_once 'Moblin.php';
include_once 'Lezalfos.php';



class FightManager 
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     */
    public function setDb($db): self
    {
        $this->db = $db;
        return $this;
    }

    public function createMonster(): Monster
    {
        $monsterType = $this->generateMonsterType();
        $monster = null;
        switch ($monsterType) {
            case 'lezalfos':
                $monster = new Lezalfos(['name' => 'Lezalfos']);
                break;
            case 'moblin':
                $monster = new Moblin(['name' => 'Moblin']);
                break;
            case 'lynel':
                $monster = new Lynel(['name' => 'Lynel']);
                break;
            case 'ganondorf':
                $monster = new Ganondorf(['name' => 'Ganondorf']);
                break;
        }
        return $monster;
    }
   


    private function generateMonsterType(): string
    {
        $monsterTypes = ['lezalfos', 'moblin', 'lynel', 'ganondorf'];
        $randomIndex = array_rand($monsterTypes);
        return $monsterTypes[$randomIndex];
    }

    public function fight(Hero $hero, Monster $monster){
        $history = [];
        while ($hero->getHealthPoint() > 0 && $monster->getHealthPoint() > 0) {
            $damage = $monster->hit($hero);
            $history[] = ' Le ' . $monster->getName().' a frappé '. $hero->getName() .' et lui a enlevé ' . $damage . ' points de vie';

            $damage = $hero->hit($monster);
            $history[] = $hero->getName() .' a frappé  '. $monster->getName() .' et lui a enlevé ' . $damage . ' points de vie';

        }
        return $history;
    }


}
