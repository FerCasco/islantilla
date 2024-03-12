<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    #[ORM\JoinColumn(name: 'cliente_id', referencedColumnName: 'id')]
    private ?Cliente $cliente = null;

    #[ORM\ManyToOne(targetEntity: Habitacion::class)]
    #[ORM\JoinColumn(name: 'habitacion_id', referencedColumnName: 'id')]
    private ?Habitacion $habitacion = null;

    #[ORM\Column]
    private ?int $noches = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getHabitacion(): ?Habitacion
    {
        return $this->habitacion;
    }

    public function setHabitacion(?Habitacion $habitacion): static
    {
        $this->habitacion = $habitacion;

        return $this;
    }

    public function getNoches(): ?int
    {
        return $this->noches;
    }

    public function setNoches(int $noches): static
    {
        $this->noches = $noches;

        return $this;
    }
}
