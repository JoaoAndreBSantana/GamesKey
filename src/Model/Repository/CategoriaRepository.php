<?php
// src/Model/Repository/CategoriaRepository.php
namespace App\Model\Repository;

use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends EntityRepository
{
    public function buscarTodas()
    {
        return $this->findAll();
    }
}
