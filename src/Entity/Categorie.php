<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups("categorie")]    
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Ouvrage::class)]
    private Collection $ouvrages;

    public function __construct()
    {
        $this->ouvrages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Ouvrage>
     */
    public function getOuvrages(): Collection
    {
        return $this->ouvrages;
    }

    public function addOuvrage(Ouvrage $ouvrage): static
    {
        if (!$this->ouvrages->contains($ouvrage)) {
            $this->ouvrages->add($ouvrage);
            $ouvrage->setCategorie($this);
        }

        return $this;
    }

    public function removeOuvrage(Ouvrage $ouvrage): static
    {
        if ($this->ouvrages->removeElement($ouvrage)) {
            // set the owning side to null (unless already changed)
            if ($ouvrage->getCategorie() === $this) {
                $ouvrage->setCategorie(null);
            }
        }

        return $this;
    }
}
