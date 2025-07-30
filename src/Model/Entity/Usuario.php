<?php
// src/entity/Usuario.php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Model\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
 */
class Usuario
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
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $senha;

    /**
     * @ORM\OneToMany(targetEntity="BibliotecaUsuario", mappedBy="usuario")
    */
    private $bibliotecaUsuarios;

    public function __construct()
    {
        $this->bibliotecaUsuarios = new ArrayCollection();
    }

    // Getters e Setters (similar ao Administrador)
    // ...
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): self
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
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getSenha(): ?string
    {
        return $this->senha;
    }
    public function setSenha(string $senha): self
    {
        $this->senha = $senha;
        return $this;
    }

    public function getBibliotecaUsuarios(): Collection
    {
        return $this->bibliotecaUsuarios;
    }
}