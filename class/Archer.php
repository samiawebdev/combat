<?php

class Archer extends Hero
{
    protected int $manaCost = 40;
    public function specialHit(Monster $monster) : int // Mon attaque spéciale si j'ai le mana
    {
        $damage = 30;
        $this->setMana($this->getMana() - $this->manaCost); // le héros perd du mana
        $monster->setLifePoint($monster->getLifePoint() - $damage);
        return $damage;
    }

}