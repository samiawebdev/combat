<?php

abstract class Hero
{
    private int $id;
    private string $name;
    private int $lifePoint = 100;
    protected int $mana = 0; // protected permet de rendre la propriété accessible aux classes filles
    private string $class;

    protected int $manaCost = 0;

    public function __construct(array $data) {
        $this->hydrate($data); // hydrate() va permettre d'hydrater l'objet Hero avec les données de la BDD ou du formulaire
    }

    public function hit(Monster $monster) : int
    {
        $damage = rand(0, 50);
        $monster->setLifePoint($monster->getLifePoint() - $damage);
        $this->setMana($this->getMana() + 20);
        return $damage;
    }
    abstract public function specialHit(Monster $monster);

    public function hydrate(array $data) : void
    {
        if(isset($data['id'])) {
            $this->setId($data['id']); // le formulaire ne contient pas d'id, donc on vérifie et on ne l'hydrate pas si il n'est pas présent
        }

        if(isset($data['name'])) {
            $this->setName($data['name']);
        }

        if(isset($data['lifePoint'])) {
            $this->setLifePoint($data['lifePoint']);
        }

        if(isset($data['mana'])) {
            $this->setMana($data['mana']);
        }

        if(isset($data['class'])) {
            $this->setClass($data['class']);
        }
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setLifePoint(int $lifePoint) : void
    {
        $this->lifePoint = $lifePoint;
    }

    public function getLifePoint() : int
    {
        return $this->lifePoint;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setClass($class) : void
    {
        $this->class = $class;
    }

    public function getClass() : string
    {
        return $this->class;
    }

    public function setMana(int $mana) : void
    {
        $this->mana = $mana;
    }

    public function getMana() : int
    {
        return $this->mana;
    }

    public function setManaCost(int $manaCost) : void
    {
        $this->manaCost = $manaCost;
    }

    public function getManaCost() : int
    {
        return $this->manaCost;
    }
}
