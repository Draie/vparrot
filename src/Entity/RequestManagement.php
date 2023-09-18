<?php

namespace App\Entity;

use App\Repository\RequestManagementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestManagementRepository::class)]
class RequestManagement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\ManyToOne(inversedBy: 'requestManagement')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $object = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 500)]
    private ?string $RequestObject = null;

    #[ORM\Column]
    private ?int $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getObject(): ?Service
    {
        return $this->object;
    }

    public function setObject(?Service $object): static
    {
        $this->object = $object;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getRequestObject(): ?string
    {
        return $this->RequestObject;
    }

    public function setRequestObject(string $RequestObject): static
    {
        $this->RequestObject = $RequestObject;

        return $this;
    }


    public function getStatus(): ?bool
    {
        return $this->status;
    }
    
    public function setStatus(?bool $status): self
    {
        $this->status = $status;
    
        return $this;
    }

    

}
