<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category
{
    private $id;
    private $name;
    private $subtitle;
    private $picture;

    /**
     * Récupère toutes les catégories
     *
     * @return array Liste des catégories
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM categories';
        $stmt = $pdo->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Conversion en objets
        $categoryObjects = [];
        foreach ($categories as $categoryData) {
            $categoryObjects[] = self::hydrate($categoryData);
        }
        return $categoryObjects;
    }

    /**
     * Récupère une catégorie par son ID
     *
     * @param int $id
     * @return Category|null
     */
    public static function find($id)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM categories WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

        return $categoryData ? self::hydrate($categoryData) : null;
    }

    /**
     * Hydrate un tableau de données en un objet Category
     *
     * @param array $data
     * @return Category
     */
    private static function hydrate(array $data): Category
    {
        $category = new self();
        $category->setId($data['id']);
        $category->setName($data['name']);
        $category->setSubtitle($data['subtitle']);
        $category->setPicture($data['picture']);

        return $category;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
}
