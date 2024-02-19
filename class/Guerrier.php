<?php

class Guerrier extends Hero
{
    protected int $manaCost = 50;
    public function specialHit(Monster $monster) : int // Mon attaque spéciale si j'ai le mana
    {
        $damage = rand(25, 50);
        $this->setMana($this->getMana() - $this->manaCost);
        $monster->setLifePoint($monster->getLifePoint() - $damage);
        return $damage;
    }

}