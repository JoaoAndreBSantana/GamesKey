<?php
// src/entity/Jogo.php

namespace App\Model\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Model\Repository\JogoRepository")
 * @ORM\Table(name="jogo")
 */
class Jogo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\Column(type="text")
     */
    private $descricao;


    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $preco;


    /**
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumn(name="id_categoria", referencedColumnName="id")
     */
    private $categoria;


    /**
     * @ORM\OneToMany(targetEntity="BibliotecaUsuario", mappedBy="jogo")
    */
    private $bibliotecaUsuarios;


    /**
    * @ORM\OneToMany(targetEntity="ItemComprovante", mappedBy="jogo")
    */
private $itensComprovante;

    public function __construct()
    {
        $this->bibliotecaUsuarios = new ArrayCollection();
        $this->itensComprovante = new ArrayCollection();
    }

    

    
    public function getJogoId(): ?int
    {
        return $this->id;
    }
    public function setJogoId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getNome(): ?string
    {
        return $this->nome;
    }
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }
   
    public function getPreco(): ?float
    {
        return $this->preco;
    }   
    public function setPreco(float $preco): self
    {
        $this->preco = $preco;
        return $this;
    }
    
    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }
    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;
        return $this;
    }
    public function getBibliotecaUsuarios(): Collection
    {
        return $this->bibliotecaUsuarios;
    }
}