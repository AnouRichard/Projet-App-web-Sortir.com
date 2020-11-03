<?php

namespace App\Entity;

use App\Repository\ParticipantsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ParticipantsRepository::class)
 */
class Participants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true, unique=true, nullable=false)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @Assert\NotBlank(message="Le prenom est obligatoire")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=250, unique=true, nullable=false)
     * @Assert\NotBlank(message="L'email est obligatoire")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=250, nullable=false)
     * @Assert\NotBlank(message="L'email est obligatoire")
     */
    private $motDePasse;

    /**
     * @ORM\Column (type="integer", nullable=false)
     */
    private $administrateur;

    /**
     * @ORM\Column (type="integer", nullable=false)
     */
    private $actif;

    /**
     * @ORM\Column (type="integer", nullable=false)
     */
    private $campusNoCampus;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @param mixed $motDePasse
     */
    public function setMotDePasse($motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * @return mixed
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    /**
     * @param mixed $administrateur
     */
    public function setAdministrateur($administrateur): void
    {
        $this->administrateur = $administrateur;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif): void
    {
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getCampusNoCampus()
    {
        return $this->campusNoCampus;
    }

    /**
     * @param mixed $campusNoCampus
     */
    public function setCampusNoCampus($campusNoCampus): void
    {
        $this->campusNoCampus = $campusNoCampus;
    }
}
