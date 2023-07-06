<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups("auteur")]    
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    #[Groups("auteur")]    
    private ?string $prenom = null;

    #[ORM\ManyToMany(targetEntity: Ouvrage::class, inversedBy: 'auteurs')]
    private Collection $ouvrage;

    public function __construct()
    {
        $this->ouvrage = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Ouvrage>
     */
    public function getOuvrage(): Collection
    {
        return $this->ouvrage;
    }

    public function addOuvrage(Ouvrage $ouvrage): static
    {
        if (!$this->ouvrage->contains($ouvrage)) {
            $this->ouvrage->add($ouvrage);
        }

        return $this;
    }

    public function removeOuvrage(Ouvrage $ouvrage): static
    {
        $this->ouvrage->removeElement($ouvrage);

        return $this;
    }
}
