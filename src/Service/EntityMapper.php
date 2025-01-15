<?php

declare(strict_types=1);

namespace App\Service;

class EntityMapper
{
    public function mapToEntity(array $data, string $entityClass)
    {
        // Créer une instance de l'entité
        $entity = new $entityClass();

        // Pour chaque champ de l'entité, assigner la valeur correspondante dans $data
        foreach ($data as $key => $value) {
            $setterKey = str_replace('_', '', ucwords($key, '_'));
            $setter = 'set' . $setterKey;

            // Si le champ contient "at" (ex : created_at), convertir en DateTime
            if (str_contains($key, '_at') && null !== $value) {
                $value = new \DateTime($value);
            }

            // Si le setter existe, on l'appelle
            if (method_exists($entity, $setter)) {
                $entity->$setter($value);
            }
        }

        return $entity;
    }

    /**
     * Convertit un tableau de résultats en un tableau d'objets d'entités.
     */
    public function mapToEntities(array $rows, string $entityClass): array
    {
        $entities = [];

        foreach ($rows as $row) {
            $entities[] = $this->mapToEntity($row, $entityClass);
        }

        return $entities;
    }
}
