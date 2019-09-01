<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Station
 *
 * @ORM\Table(name="station", uniqueConstraints={@ORM\UniqueConstraint(name="Call", columns={"callsign"})})
 * @ORM\Entity
 */
class Station
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="callsign", type="string", length=20, nullable=false)
     */
    private $callsign;

    /**
     * @var string
     *
     * @ORM\Column(name="operator", type="string", length=50, nullable=false)
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="echolink", type="string", length=255, nullable=true)
     */
    private $echolink;

    /**
     * @var string|null
     *
     * @ORM\Column(name="post_code", type="string", length=10, nullable=true)
     */
    private $postCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=20, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="stations")
     */
    private $station;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Folder", mappedBy="station")
     */
    private $folders;

    public function __construct()
    {
        $this->station = new ArrayCollection();
        $this->folder = new ArrayCollection();
        $this->folders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCallsign(): ?string
    {
        return $this->callsign;
    }

    public function setCallsign(string $callsign): self
    {
        $this->callsign = $callsign;

        return $this;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEcholink(): ?string
    {
        return $this->echolink;
    }

    public function setEcholink(?string $echolink): self
    {
        $this->echolink = $echolink;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getStation(): Collection
    {
        return $this->station;
    }

    public function addStation(user $station): self
    {
        if (!$this->station->contains($station)) {
            $this->station[] = $station;
        }

        return $this;
    }

    public function removeStation(user $station): self
    {
        if ($this->station->contains($station)) {
            $this->station->removeElement($station);
        }

        return $this;
    }

    /**
     * @return Collection|folder[]
     */
    public function getFolders(): Collection
    {
        return $this->folders;
    }

    public function addFolder(folder $folder): self
    {
        if (!$this->folders->contains($folder)) {
            $this->folders[] = $folder;
            $folder->setStation($this);
        }

        return $this;
    }

    public function removeFolder(folder $folder): self
    {
        if ($this->folders->contains($folder)) {
            $this->folders->removeElement($folder);
            // set the owning side to null (unless already changed)
            if ($folder->getStation() === $this) {
                $folder->setStation(null);
            }
        }

        return $this;
    }
	
	/**
    * @return Folder
    */
    public function getFolderFromId($id): \App\Entity\Folder
    {
		foreach ($this->folders as $folder )
		{
			if ($folder->getId() == $id)
				return $folder;
		}
		return null;
		//$station = $this->getDoctrine()->getRepository( Station::class )->find($id)->findByName('ticket2');
        //return $station;
    }
	
	/**
	 * Method return bool folder exits in the station
	 * @param int $idFolder id folder for 
	 * @return bool Description
	 */
	public function isFolderInStation(int $idFolder): bool
	{
		foreach ($this->folders as $folder )
		{
			if ($folder->getId() == $idFolder)
				return true;
		}
		return false;
	}

}
