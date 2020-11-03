<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *@ORM\Column (type="string", length=30, nullable= false)
     */
    private $nom_campus;

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
}
