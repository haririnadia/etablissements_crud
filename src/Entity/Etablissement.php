<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EtablissementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=EtablissementRepository::class)
 */
class Etablissement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomEtablissement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $natureEtablissement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secteurEtablissement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;
     /**
     * @ORM\Column(type="string", length=255)
     */
  
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commune;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $academie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOuverture;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="etablissement",cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $relationEtablissement;

    public function __construct()
    {
        $this->relationEtablissement = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomEtablissement()
    {
        return $this->nomEtablissement;
    }

    /**
     * @param mixed $nomEtablissement
     */
    public function setNomEtablissement($nomEtablissement): void
    {
        $this->nomEtablissement = $nomEtablissement;
    }

    /**
     * @return mixed
     */
    public function getNatureEtablissement()
    {
        return $this->natureEtablissement;
    }

    /**
     * @param mixed $natureEtablissement
     */
    public function setNatureEtablissement($natureEtablissement): void
    {
        $this->natureEtablissement = $natureEtablissement;
    }

    /**
     * @return mixed
     */
    public function getSecteurEtablissement()
    {
        return $this->secteurEtablissement;
    }

    /**
     * @param mixed $secteurEtablissement
     */
    public function setSecteurEtablissement($secteurEtablissement): void
    {
        $this->secteurEtablissement = $secteurEtablissement;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param mixed $departement
     */
    public function setDepartement($departement): void
    {
        $this->departement = $departement;
    }

    /**
     * @return mixed
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * @param mixed $commune
     */
    public function setCommune($commune): void
    {
        $this->commune = $commune;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getAcademie()
    {
        return $this->academie;
    }

    /**
     * @param mixed $academie
     */
    public function setAcademie($academie): void
    {
        $this->academie = $academie;
    }

    /**
     * @return mixed
     */
    public function getDateOuverture()
    {
        return $this->dateOuverture;
    }

    /**
     * @param mixed $dateOuverture
     */
    public function setDateOuverture($dateOuverture): void
    {
        $this->dateOuverture = $dateOuverture;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getRelationEtablissement(): Collection
    {
        return $this->relationEtablissement;
    }

    public function addRelationEtablissement(Commentaires $relationEtablissement): self
    {
        if (!$this->relationEtablissement->contains($relationEtablissement)) {
            $this->relationEtablissement[] = $relationEtablissement;
            $relationEtablissement->setEtablissement($this);
        }

        return $this;
    }

    public function removeRelationEtablissement(Commentaires $relationEtablissement): self
    {
        if ($this->relationEtablissement->removeElement($relationEtablissement)) {
            // set the owning side to null (unless already changed)
            if ($relationEtablissement->getEtablissement() === $this) {
                $relationEtablissement->setEtablissement(null);
            }
        }

        return $this;
    }


}