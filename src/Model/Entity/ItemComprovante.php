<?php
// src/model/entity/ItemComprovante.php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Entity\Comprovante;
use App\Model\Entity\Jogo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="itemcomprovante")
 */
class ItemComprovante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\model\entity\Comprovante", inversedBy="itens")
     * @ORM\JoinColumn(name="id_comprovante", referencedColumnName="id", nullable=false)
     */
    private $comprovante;

    /**
     * @ORM\ManyToOne(targetEntity="App\model\entity\Jogo")
     * @ORM\JoinColumn(name="id_jogo", referencedColumnName="id", nullable=false)
     */
    private $jogo;

    /**
     * @ORM\Column(type="float", name="preco_pago")
     */
    private $precoPago;


    // Getters e Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComprovante(): ?Comprovante
    {
        return $this->comprovante;
    }

    public function setComprovante(?Comprovante $comprovante): self
    {
        $this->comprovante = $comprovante;
        return $this;
    }

    public function getJogo(): ?Jogo
    {
        return $this->jogo;
    }

    public function setJogo(Jogo $jogo): self
    {
        $this->jogo = $jogo;
        return $this;
    }

    public function getPrecoPago(): ?float
    {
        return $this->precoPago;
    }

    public function setPrecoPago(float $precoPago): self
    {
        $this->precoPago = $precoPago;
        return $this;
    }

}
