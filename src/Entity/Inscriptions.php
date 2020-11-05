<?php

namespace App\Entity;

use App\Repository\InscriptionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionsRepository::class)
 */
class Inscriptions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable= false)
     */
    private $dateInscription;

    /**
     * @ORM\ManyToOne(targetEntity=Participants::class, inversedBy="inscriptions")
     */
    private $Participant;

    /**
     * @ORM\ManyToOne(targetEntity=Sorties::class, inversedBy="inscriptions")
     */
    private $sortie;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription($dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    public function getParticipant(): ?Participants
    {
        return $this->Participant;
    }

    public function setParticipant(?Participants $Participant): self
    {
        $this->Participant = $Participant;

        return $this;
    }

    public function getSortie(): ?Sorties
    {
        return $this->sortie;
    }

    public function setSortie(?Sorties $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }


}
