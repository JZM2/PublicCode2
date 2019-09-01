<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

//, indexes={@ORM\Index(name="station_folder", columns={"folder_station"})}

/**
 * Folder
 *
 * @ORM\Table(name="folder")
 * @ORM\Entity
 */
class Folder
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
     * @ORM\Column(name="folder_name", type="string", length=150, nullable=false)
     */
    private $folderName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_qth", type="string", length=150, nullable=true)
     */
    private $folderQth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_gps", type="string", length=50, nullable=true)
     */
    private $folderGps;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_grid", type="string", length=10, nullable=true)
     */
    private $folderGrid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_contest", type="string", length=150, nullable=true)
     */
    private $folderContest;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="folder_contest_from", type="datetime", nullable=true)
     */
    private $folderContestFrom;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="folder_contest_to", type="datetime", nullable=true)
     */
    private $folderContestTo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_contest_cat", type="string", length=150, nullable=true)
     */
    private $folderContestCat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_tx", type="string", length=150, nullable=true)
     */
    private $folderTx;

    /**
     * @var int|null
     *
     * @ORM\Column(name="folder_tx_power", type="integer", nullable=true)
     */
    private $folderTxPower;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_tx_ant", type="string", length=150, nullable=true)
     */
    private $folderTxAnt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_rx", type="string", length=150, nullable=true)
     */
    private $folderRx;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folder_remarks", type="text", length=65535, nullable=true)
     */
    private $folderRemarks;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Station", inversedBy="folders")
     */
    private $station;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Log", mappedBy="folder")
     */
    private $logs;

    public function __construct()
    {
        $this->logs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFolderName(): ?string
    {
        return $this->folderName;
    }

    public function setFolderName(string $folderName): self
    {
        $this->folderName = $folderName;

        return $this;
    }

    public function getFolderQth(): ?string
    {
        return $this->folderQth;
    }

    public function setFolderQth(?string $folderQth): self
    {
        $this->folderQth = $folderQth;

        return $this;
    }

    public function getFolderGps(): ?string
    {
        return $this->folderGps;
    }

    public function setFolderGps(?string $folderGps): self
    {
        $this->folderGps = $folderGps;

        return $this;
    }

    public function getFolderGrid(): ?string
    {
        return $this->folderGrid;
    }

    public function setFolderGrid(?string $folderGrid): self
    {
        $this->folderGrid = $folderGrid;

        return $this;
    }

    public function getFolderContest(): ?string
    {
        return $this->folderContest;
    }

    public function setFolderContest(?string $folderContest): self
    {
        $this->folderContest = $folderContest;

        return $this;
    }

    public function getFolderContestFrom(): ?\DateTimeInterface
    {
        return $this->folderContestFrom;
    }

    public function setFolderContestFrom(?\DateTimeInterface $folderContestFrom): self
    {
        $this->folderContestFrom = $folderContestFrom;

        return $this;
    }

    public function getFolderContestTo(): ?\DateTimeInterface
    {
        return $this->folderContestTo;
    }

    public function setFolderContestTo(?\DateTimeInterface $folderContestTo): self
    {
        $this->folderContestTo = $folderContestTo;

        return $this;
    }

    public function getFolderContestCat(): ?string
    {
        return $this->folderContestCat;
    }

    public function setFolderContestCat(?string $folderContestCat): self
    {
        $this->folderContestCat = $folderContestCat;

        return $this;
    }

    public function getFolderTx(): ?string
    {
        return $this->folderTx;
    }

    public function setFolderTx(?string $folderTx): self
    {
        $this->folderTx = $folderTx;

        return $this;
    }

    public function getFolderTxPower(): ?int
    {
        return $this->folderTxPower;
    }

    public function setFolderTxPower(?int $folderTxPower): self
    {
        $this->folderTxPower = $folderTxPower;

        return $this;
    }

    public function getFolderTxAnt(): ?string
    {
        return $this->folderTxAnt;
    }

    public function setFolderTxAnt(?string $folderTxAnt): self
    {
        $this->folderTxAnt = $folderTxAnt;

        return $this;
    }

    public function getFolderRx(): ?string
    {
        return $this->folderRx;
    }

    public function setFolderRx(?string $folderRx): self
    {
        $this->folderRx = $folderRx;

        return $this;
    }

    public function getFolderRemarks(): ?string
    {
        return $this->folderRemarks;
    }

    public function setFolderRemarks(?string $folderRemarks): self
    {
        $this->folderRemarks = $folderRemarks;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }

    /**
     * @return Collection|log[]
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(log $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setFolder($this);
        }

        return $this;
    }

    public function removeLog(log $log): self
    {
        if ($this->logs->contains($log)) {
            $this->logs->removeElement($log);
            // set the owning side to null (unless already changed)
            if ($log->getFolder() === $this) {
                $log->setFolder(null);
            }
        }

        return $this;
    }


}
