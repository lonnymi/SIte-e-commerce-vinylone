<?php

namespace App\Models;

/**
 * CoreModel est une classe de base destinée à être étendue par tous les autres modèles.
 * Elle contient les propriétés et méthodes communes à tous les modèles.
 */
abstract class CoreModel
{
    // Propriétés communes à tous les modèles
    protected $id;
    protected $created_at;
    protected $updated_at;

    /**
     * Récupère l'identifiant unique.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Définit l'identifiant unique.
     *
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Récupère la date de création.
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Définit la date de création.
     *
     * @param string $created_at
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Récupère la date de dernière mise à jour.
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Définit la date de dernière mise à jour.
     *
     * @param string $updated_at
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * Méthode abstraite pour récupérer le nom de la table associée au modèle.
     * Chaque modèle enfant doit implémenter cette méthode.
     *
     * @return string
     */
    abstract public static function getTableName(): string;

    /**
     * Méthode abstraite pour hydrater les données depuis la base.
     * Chaque modèle enfant doit implémenter cette méthode.
     *
     * @param array $data
     * @return self
     */
    abstract public static function hydrate(array $data): self;
}
