<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Jour = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $morningStartTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $morningEndTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $afterStartTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $afterEndTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->Jour;
    }

    public function setJour(string $Jour): static
    {
        $this->Jour = $Jour;

        return $this;
    }

    public function getMorningStartTime(): ?\DateTimeInterface
    {
        return $this->morningStartTime;
    }

    public function setMorningStartTime(\DateTimeInterface $morningStartTime): static
    {
        $this->morningStartTime = $morningStartTime;

        return $this;
    }

    public function getMorningEndTime(): ?\DateTimeInterface
    {
        return $this->morningEndTime;
    }

    public function setMorningEndTime(\DateTimeInterface $morningEndTime): static
    {
        $this->morningEndTime = $morningEndTime;

        return $this;
    }

    public function getAfterStartTime(): ?\DateTimeInterface
    {
        return $this->afterStartTime;
    }

    public function setAfterStartTime(\DateTimeInterface $afterStartTime): static
    {
        $this->afterStartTime = $afterStartTime;

        return $this;
    }

    public function getAfterEndTime(): ?\DateTimeInterface
    {
        return $this->afterEndTime;
    }

    public function setAfterEndTime(\DateTimeInterface $afterEndTime): static
    {
        $this->afterEndTime = $afterEndTime;

        return $this;
    }
}
