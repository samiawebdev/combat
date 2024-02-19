<?php

class HeroesManager
{
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
 // CRUD : C = Create R = Read U = Update D = Delete
    public function add(Hero $hero) : void // Je met en paramètre un objet de la classe Hero, donc je peux utiliser les méthodes de cette classe
    {
        // je crée une requête SQL pour ajouter un héros en BDD
        $request = $this->db->prepare("INSERT INTO hero (name, class) VALUES (:name, :class)");
        $request->execute([
           'name' => $hero->getName(),
            'class' => $hero->getClass()
        ]); // j'exécute ma requête SQL avec les données de mon objet Hero

        $id = $this->db->lastInsertId();
        $hero->setId($id); // je donne un id à mon objet Hero
    }

    public function findAllAlive() : array
    {
        $request = $this->db->query("SELECT * FROM hero WHERE hero.health_point > 0");
        // ma requête me retourne un tableau de héros qui ont des points de vie supérieur à 0
        $heroesAlives = $request->fetchAll();

        $heroes = []; // je crée un tableau vide

        foreach ($heroesAlives as $heroAlive) { // je fais une boucle sur mes héros en vie grâce à la requête SQL
            $class = $heroAlive['class'];
            $hero = new $class($heroAlive); // je crée un objet Hero avec les données de chaque héros en vie, $heroAlive est un tableau
            $hero->setId($heroAlive['id']); // je donne un id à mon objet Hero
            $heroes[] = $hero; // j'ajoute mon objet Hero dans mon tableau $heroes
        }

        return $heroes; // je retourne mon tableau $heroes qui est un tableau d'OBJETS Hero
    }

//PDO SELECT WHERE. Appelez cette méthode find() dans HeroesManager,
// elle prendra en argument un entier que vous récupérerez avec $_POST['hero_id'] (en fonction du nom de votre input hidden).
//La méthode find crée ensuite une nouvelle instance de Hero avec les informations récupérées et le retourne.
    public function find($id) : Hero
    {
        $request = $this->db->prepare("SELECT * FROM hero WHERE id = :id");
        $request->execute([
           'id' => $id,
        ]);
        $heroInfo = $request->fetch();

        $class = $heroInfo['class'];

        $hero = new $class($heroInfo);
        $hero->setId($heroInfo['id']);

        return $hero;
    }

    public function update(Hero $hero) : void
    {
        $request = $this->db->prepare("UPDATE hero SET health_point = :health_point WHERE id = :id");
        $request->execute([
           'health_point' => $hero->getLifePoint(),
           'id' => $hero->getId()
        ]);

    }



}