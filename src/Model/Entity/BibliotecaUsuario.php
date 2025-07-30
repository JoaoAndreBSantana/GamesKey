<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="biblioteca_usuario")
 */
class BibliotecaUsuario
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
     * @ORM\ManyToOne(targetEntity="Jogo")
     * @ORM\JoinColumn(name="id_jogo", referencedColumnName="id", nullable=false)
     */
    private $jogo;

    /**
     * @ORM\Column(type="datetime", name="data_resgate", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dataResgate;

    public function __construct(){
        $this->dataResgate = new \DateTime();
    }

    
    public function setJogo(?Jogo $jogo): self
    {
        $this->jogo = $jogo;
        return $this;
    }
    public function getJogo(): ?Jogo
    {
        return $this->jogo;
    }
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getDataResgate(): ?\DateTime
    {
        return $this->dataResgate;
    }


}