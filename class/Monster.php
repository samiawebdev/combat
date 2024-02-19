<?php

abstract class Monster
{
    private string $name;
    private int $lifePoint = 100;
    abstract public function hit(Hero $hero);

    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setLifePoint($hp) : void
    {
        $this->lifePoint = $hp;
    }

    public function getLifePoint() : int
    {
        return $this->lifePoint;
    }

}