<?php

class FightsManager
{
    public function createMonster() : Monster
    {
        $randomMonster = [
          'Sorcier',
          'Ogre',
          'Fantassin'
        ];

        $monsterKey = array_rand($randomMonster);
        $monsterType = $randomMonster[$monsterKey];

        $monster = new $monsterType();
        $monster->setName('Alexis');
        return $monster;
    }
    public function fight(Hero $hero, Monster $monster) : array
    {
        $fightResult = [];

        while($hero->getLifePoint() > 0 || $monster->getLifePoint() > 0) {

            $fightResult[] = "<td class='bg-danger'>" . $monster->getName() . " inflige " . $monster->hit($hero) . " dégats à " . $hero->getName();

            if($hero->getLifePoint() <= 0) {
                $fightResult[] = "<td class='bg-info'>" . $hero->getName() . " est mort";
                break;
            }

            if($hero->getMana() >= $hero->getManaCost()) {
                $fightResult[] = "<td class='bg-info'>" . $hero->getName() . " inflige " . $hero->specialHit($monster) . " dégats à " . $monster->getName() . " grâce à son attaque spéciale ⭐";
            } else {
                $fightResult[] = "<td class='bg-info'>" . $hero->getName() . " inflige " . $hero->hit($monster) . " dégats à " . $monster->getName();
            }


            if($monster->getLifePoint() <= 0) {
                $fightResult[] = "<td class='bg-danger'>" . $monster->getName() . " est mort";
                break;
            }

        }
        return $fightResult;

    }





}