<?php
namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_carrinho")
 */
class ItemCarrinho
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Carrinho", inversedBy="itens")
     * @ORM\JoinColumn(name="id_carrinho", referencedColumnName="id")
     */
    private $carrinho;

    /**
     * @ORM\ManyToOne(targetEntity="Jogo")
     * @ORM\JoinColumn(name="id_jogo", referencedColumnName="id")
     */
    private $jogo;
/**
 * @ORM\Column(name="preco_unitario", type="decimal", precision=10, scale=2)
 */
private $precoUnitario;

    // Getters e Setters
   
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCarrinho(): ?Carrinho
    {
        return $this->carrinho;
    }
    public function setCarrinho(?Carrinho $carrinho): self
    {
        $this->carrinho = $carrinho;
        return $this;
    }
    public function getJogo(): ?Jogo
    {
        return $this->jogo;
    }
    public function setJogo(?Jogo $jogo): self
    {
        $this->jogo = $jogo;
        return $this;
    }
    public function getPrecoUnitario(): ?float
    {
        return $this->precoUnitario;
    }

    public function setPrecoUnitario(float $precoUnitario): self
    {
        $this->precoUnitario = $precoUnitario;
        return $this;
    }
    
}