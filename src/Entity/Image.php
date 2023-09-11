<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NoSuspiciousCharacters]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: 'string')]
    private string $photo;

    #[ORM\Column(type: 'string')]
    private ?string $photo2;

    #[ORM\Column]
    private ?string $photo3 = null;

    #[ORM\Column]
    private int $price;

    #[ORM\Column]
    private int $kms ;

    #[ORM\Column]
    private ?string $equipement = null;

    #[ORM\Column]
    private ?string $Nbplaces = null;

    #[ORM\Column]
    private ?string $carburant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }


    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }


    public function getPhoto2(): string
    {
        return $this->photo2;
    }

    public function setPhoto2(string $photo2): self
    {
        $this->photo2 = $photo2;

        return $this;
    }



    public function getPhoto3(): string
    {
        return $this->photo3;
    }

    public function setPhoto3(string $photo3): self
    {
        $this->photo3 = $photo3;

        return $this;
    }


    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }


    public function setKms(int $kms): self
    {
        $this->kms = $kms;

        return $this;
    }

    public function getKms(): ?int
    {
        return $this->kms;
    }


    public function getEquipement(): ?string
{
    return $this->equipement;
}

public function setEquipement(string $equipement): static
{
    $this->equipement = $equipement;

    return $this;
}


public function setNbplaces(string $nbplaces): self
    {
        $this->Nbplaces = $nbplaces;

        return $this;
    }

    public function getNbplaces(): ?string
    {
        return $this->Nbplaces;
    }



    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

}



