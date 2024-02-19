<?php

class Fantassin extends Monster
{
    public function hit(Hero $hero) : int
    {
        $damage = rand(0, 50);
        if($hero instanceof Archer) {
            $damage *= 2;
        }
        $hero->setLifePoint($hero->getLifePoint() - $damage);
        return $damage;
    }
}