<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\OneToMany(mappedBy: 'object', targetEntity: RequestManagement::class)]
    private Collection $requestManagement;

    public function __construct()
    {
        $this->requestManagement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }


    public function __toString()
    {
        return $this->Title;
    }
    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, RequestManagement>
     */
    public function getRequestManagement(): Collection
    {
        return $this->requestManagement;
    }

    public function addRequestManagement(RequestManagement $requestManagement): static
    {
        if (!$this->requestManagement->contains($requestManagement)) {
            $this->requestManagement->add($requestManagement);
            $requestManagement->setObject($this);
        }

        return $this;
    }

    public function removeRequestManagement(RequestManagement $requestManagement): static
    {
        if ($this->requestManagement->removeElement($requestManagement)) {
            // set the owning side to null (unless already changed)
            if ($requestManagement->getObject() === $this) {
                $requestManagement->setObject(null);
            }
        }

        return $this;
    }
}
