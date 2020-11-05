<?php

namespace App\Entity;

use App\Repository\SortiesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortiesRepository::class)
 */
class Sorties
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
     * @ORM\Column(type="datetime", nullable= false)
     */
    private $dateDeDebut;

    /**
     *@ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime", nullable= false)
     */
    private $dateCloture;

    /**
     *@ORM\Column(type="integer", nullable= false)
     */
    private $nbInscriptionMax;

    /**
     * @ORM\Column (type="text", length=500)
     */
    private $descriptionInfos;

    /**
     *@ORM\Column(type="integer")
     */
    private $etatSortie;

    /**
     * @ORM\Column (type="text", length=250)
     */
    private $urlPhoto;

    /**
     *@ORM\Column(type="integer")
     */
    private $organisateur;

    /**
     *
     */
    private $lieux;


    /**
     *
     */
    private $etats;

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
    public function getDateDeDebut()
    {
        return $this->dateDeDebut;
    }

    /**
     * @param mixed $dateDeDebut
     */
    public function setDateDeDebut($dateDeDebut): void
    {
        $this->dateDeDebut = $dateDeDebut;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getDateCloture()
    {
        return $this->dateCloture;
    }

    /**
     * @param mixed $dateCloture
     */
    public function setDateCloture($dateCloture): void
    {
        $this->dateCloture = $dateCloture;
    }

    /**
     * @return mixed
     */
    public function getNbInscriptionMax()
    {
        return $this->nbInscriptionMax;
    }

    /**
     * @param mixed $nbInscriptionMax
     */
    public function setNbInscriptionMax($nbInscriptionMax): void
    {
        $this->nbInscriptionMax = $nbInscriptionMax;
    }

    /**
     * @return mixed
     */
    public function getDescriptionInfos()
    {
        return $this->descriptionInfos;
    }

    /**
     * @param mixed $descriptionInfos
     */
    public function setDescriptionInfos($descriptionInfos): void
    {
        $this->descriptionInfos = $descriptionInfos;
    }

    /**
     * @return mixed
     */
    public function getEtatSortie()
    {
        return $this->etatSortie;
    }

    /**
     * @param mixed $etatSortie
     */
    public function setEtatSortie($etatSortie): void
    {
        $this->etatSortie = $etatSortie;
    }

    /**
     * @return mixed
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * @param mixed $urlPhoto
     */
    public function setUrlPhoto($urlPhoto): void
    {
        $this->urlPhoto = $urlPhoto;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return mixed
     */
    public function getLieux()
    {
        return $this->lieux;
    }

    /**
     * @param mixed $lieux
     */
    public function setLieux($lieux): void
    {
        $this->lieux = $lieux;
    }

    /**
     * @return mixed
     */
    public function getEtats()
    {
        return $this->etats;
    }

    /**
     * @param mixed $etats
     */
    public function setEtats($etats): void
    {
        $this->etats = $etats;
    }

}
