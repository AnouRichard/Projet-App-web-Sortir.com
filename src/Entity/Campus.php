<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue ()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     *@ORM\Column (type="string", length=30, nullable= false)
     */
    private $nom_campus;

    /**
     * @ORM\OneToMany(targetEntity=Participants::class, mappedBy="campus")
     */
    private $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getNomCampus()
    {
        return $this->nom_campus;
    }

    /**
     * @param mixed $nom_campus
     */
    public function setNomCampus($nom_campus): void
    {
        $this->nom_campus = $nom_campus;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Participants[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setCampus($this);
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getCampus() === $this) {
                $participant->setCampus(null);
            }
        }

        return $this;
    }
}
