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
     *@ORM\Column(type="integer", nullable= false)
     */
    private $sortie_no_sortie;

    /**
     *@ORM\Column(type="integer", nullable= false)
     */
    private $participants_no_participants;

    public function getId(): ?int
    {
        return $this->id;
    }
}
