<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProcesosRepository")
 */
class Procesos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $serial;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="date")
     */
    private $creacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sedes")
     */
    private $sede;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $presupuesto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerial(): ?string
    {
        return $this->serial;
    }

    public function setSerial(string $serial): self
    {
        $this->serial = $serial;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCreacion(): ?\DateTimeInterface
    {
        return $this->creacion;
    }

    public function setCreacion(\DateTimeInterface $creacion): self
    {
        $this->creacion = $creacion;

        return $this;
    }

    public function getSede(): ?Sedes
    {
        return $this->sede;
    }

    public function setSede(?Sedes $sede): self
    {
        $this->sede = $sede;

        return $this;
    }

    public function getPresupuesto(): ?float
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(?float $presupuesto): self
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }
}
