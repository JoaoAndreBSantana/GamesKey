<?php
namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity
 * @ORM\Table(name="carrinho")
 */
class Carrinho
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     */
    private $usuario;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $finalizado = false;


    /**
     * @ORM\OneToMany(targetEntity="ItemCarrinho", mappedBy="carrinho", cascade={"remove"})
     */
    private $itens;

    public function __construct()
    {
        $this->itens = new ArrayCollection();
    }

    // Getters e Setters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCarrinhoId(): ?int
    {
        return $this->id;
    }
    public function setCarrinhoId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }
    public function isFinalizado(): bool
    {
        return $this->finalizado;
    }
    public function setFinalizado(bool $finalizado): self
    {
        $this->finalizado = $finalizado;
        return $this;
    }
    public function getItens(): Collection
    {
        return $this->itens;
    }
    
    
}