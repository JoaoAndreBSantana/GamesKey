<?php
// src/model/entity/Comprovante.php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="comprovante")
 */
class Comprovante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id", nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="datetime", name="data_compra")
     */
    private $dataCompra;

    /**
     * @ORM\Column(type="float", name="valor_total")
     */
    private $valorTotal;

    /**
     * @ORM\OneToMany(targetEntity="ItemComprovante", mappedBy="comprovante", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $itens;

    /**
    * @ORM\Column(type="string", length=12, unique=true, name="chave_gerada")
    */
    private $chaveGerada;

    /**
     * @ORM\Column(type="boolean", name="resgatado", options={"default": false})
     */
    private $resgatado = false;

    public function __construct()
    {
        $this->dataCompra = new \DateTime();
        $this->itens = new ArrayCollection();
    }

    // Getters e Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getDataCompra(): ?\DateTimeInterface
    {
        return $this->dataCompra;
    }

    public function setDataCompra(\DateTimeInterface $dataCompra): self
    {
        $this->dataCompra = $dataCompra;
        return $this;
    }

    public function getValorTotal(): ?float
    {
        return $this->valorTotal;
    }

    public function setValorTotal(float $valorTotal): self
    {
        $this->valorTotal = $valorTotal;
        return $this;
    }

    /**
     * @return Collection|ItemComprovante[]
     */
    public function getItens(): Collection
    {
        return $this->itens;
    }
    

    public function addItem(ItemComprovante $item): self
    {
        if (!$this->itens->contains($item)) {
            $this->itens[] = $item;
            $item->setComprovante($this); 
        }
        return $this;
    }

    public function removeItem(ItemComprovante $item): self
    {
        if ($this->itens->removeElement($item)) {
            if ($item->getComprovante() === $this) {
                $item->setComprovante(null);
            }
        }
        return $this;
    }



    public function getChaveGerada(): ?string
    {
        return $this->chaveGerada;
    }
    public function setChaveGerada(string $chaveGerada): self
    {
        $this->chaveGerada = $chaveGerada;
        return $this;
    }   
    public function isResgatado(): ?bool
    {
        return $this->resgatado;
    }   
    
    public function setResgatado(bool $resgatado): self
    {
        $this->resgatado = $resgatado;
        return $this;
}
}
