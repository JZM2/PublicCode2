<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Station;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_8D93D649E7927C74", columns={"email"})})
 * @ORM\Entity
 */
class User implements UserInterface
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
     * @ORM\Column(name="email", type="string", length=180, nullable=false)
     */
    private $email;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="json", length=65535, nullable=false)
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Station", mappedBy="station")
     */
    private $stations;
	
	/**
	 * @var array Array paramateres
	 * @ORM\Column(name="config", type="json", length=65535, nullable=true)
	 */
	private $config;
	
	/**
	 * @var EntityManager Description
	 */
	protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->stations = new ArrayCollection();
		$this->entityManager = $entityManager;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): ?array
    {
		$roles = $this->roles;
		$roles[] = 'ROLE_USER';
        return $roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

	public function getUsername()
	{
		return $this->email;
	}
	
    /**
     * @return Collection|Station[]
     */
    public function getStations(): Collection
    {
        return $this->stations;
    }

    public function addStation(Station $station): self
    {
        if (!$this->stations->contains($station)) {
            $this->stations[] = $station;
            $station->addStation($this);
        }

        return $this;
    }

    public function removeStation(Station $station): self
    {
        if ($this->stations->contains($station)) {
            $this->stations->removeElement($station);
            $station->removeStation($this);
        }

        return $this;
    }
	
	/**
     * @return Station
     */
    public function getStationFromId($id): \App\Entity\Station
    {
		foreach ($this->stations as $station )
		{
			if ($station->getId() == $id)
				return $station;
		}
		return null;
		//$station = $this->getDoctrine()->getRepository( Station::class )->find($id)->findByName('ticket2');
        //return $station;
    }

	/**
	 * @see UserInterface
	 */
	/*
	public function getPassword()
	{
		
	}
*/
	/**
	 * @see UserInterface
	 */
	public function getSalt()
	{
		
	}
	
	/**
	 * @see UserInterface
	 */
	public function eraseCredentials()
	{
		
	}
	
	public function setConfig( array $config )
	{
		$this->config = $config;
		
		//$this->entityManager->getRepository(User::class);
		//$entityManager = $this->getDoctrine()->getManager();
		//$entityManager->persist($this);
		//var_dump($this->entityManager);
		//$this->entityManager->persist($this);
		//$this->entityManager->flush();
	}
	
	public function getConfig() : array
	{
		$this->config;
	}
	
	public function getSelectStation() :int
	{
		return $this->config['select_station'];
	}
}
