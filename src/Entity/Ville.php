<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length=30, nullable= false)
     */
    private $nom;

    /**
     * @ORM\Column (type="integer", length=5, nullable= false)
     */
    private $code_postal;

    /**
     * @ORM\OneToMany(targetEntity=Lieux::class, mappedBy="ville")
     */
    private $lieuxes;

    public function __construct()
    {
        $this->lieuxes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal): void
    {
        $this->code_postal = $code_postal;
    }

    /**
     * @return Collection|Lieux[]
     */
    public function getLieuxes(): Collection
    {
        return $this->lieuxes;
    }

    public function addLieux(Lieux $lieux): self
    {
        if (!$this->lieuxes->contains($lieux)) {
            $this->lieuxes[] = $lieux;
            $lieux->setVille($this);
        }

        return $this;
    }

    public function removeLieux(Lieux $lieux): self
    {
        if ($this->lieuxes->removeElement($lieux)) {
            // set the owning side to null (unless already changed)
            if ($lieux->getVille() === $this) {
                $lieux->setVille(null);
            }
        }

        return $this;
    }
}
