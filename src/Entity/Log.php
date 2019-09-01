<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogRepository")
 */
class Log
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     */
    private $logDate;

    /**
     * @ORM\Column(type="float")
     */
    private $logFrequency;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $logMode;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $logCall;

    /**
     * @ORM\Column(type="integer")
     */
    private $logYouRst;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logYouQsl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logYouQslManager;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $logYouGrid;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $logYouDxcc;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $logYouIota;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logYouQth;

    /**
     * @ORM\Column(type="integer")
     */
    private $logMyRst;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logYouContest;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $logMyNum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logMyQsl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logMyContest;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $logPoints;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logRemarks;

    /**
     * @ORM\Column(type="integer")
     */
    private $folderId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Folder", inversedBy="logs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $folder;

    public function getId(): ?int
    {
        return $this->id;
    }
	
    public function getLogDate(): ?\DateTimeInterface
    {
        return $this->logDate;
    }

    public function setLogDate(\DateTimeInterface $logDate): self
    {
        $this->logDate = $logDate;

        return $this;
    }

    public function getLogFrequency(): ?float
    {
        return $this->logFrequency;
    }

    public function setLogFrequency(float $frequency): self
    {
        $this->logFrequency = $frequency;

        return $this;
    }

    public function getLogMode(): ?string
    {
        return $this->logMode;
    }

    public function setLogMode(string $logMode): self
    {
        $this->logMode = $logMode;

        return $this;
    }

    public function getLogCall(): ?string
    {
        return $this->logCall;
    }

    public function setLogCall(string $logCall): self
    {
        $this->logCall = $logCall;

        return $this;
    }

    public function getLogYouRst(): ?int
    {
        return $this->logYouRst;
    }

    public function setLogYouRst(int $logYouRst): self
    {
        $this->logYouRst = $logYouRst;

        return $this;
    }

    public function getLogYouQsl(): ?string
    {
        return $this->logYouQsl;
    }

    public function setLogYouQsl(string $logYouQsl): self
    {
        $this->logYouQsl = $logYouQsl;

        return $this;
    }

    public function getLogYouQslManager(): ?string
    {
        return $this->logYouQslManager;
    }

    public function setLogYouQslManager(?string $logYouQslManager): self
    {
        $this->logYouQslManager = $logYouQslManager;

        return $this;
    }

    public function getLogYouGrid(): ?string
    {
        return $this->logYouGrid;
    }

    public function setLogYouGrid(?string $logYouGrid): self
    {
        $this->logYouGrid = $logYouGrid;

        return $this;
    }

    public function getLogYouDxcc(): ?string
    {
        return $this->logYouDxcc;
    }

    public function setLogYouDxcc(?string $logYouDxcc): self
    {
        $this->logYouDxcc = $logYouDxcc;

        return $this;
    }

    public function getLogYouIota(): ?string
    {
        return $this->logYouIota;
    }

    public function setLogYouIota(?string $logYouIota): self
    {
        $this->logYouIota = $logYouIota;

        return $this;
    }

    public function getLogYouQth(): ?string
    {
        return $this->logYouQth;
    }

    public function setLogYouQth(?string $logYouQth): self
    {
        $this->logYouQth = $logYouQth;

        return $this;
    }

    public function getLogMyRst(): ?int
    {
        return $this->logMyRst;
    }

    public function setLogMyRst(int $logMyRst): self
    {
        $this->logMyRst = $logMyRst;

        return $this;
    }

    public function getLogYouContest(): ?string
    {
        return $this->logYouContest;
    }

    public function setLogYouContest(?string $logYouContest): self
    {
        $this->logYouContest = $logYouContest;

        return $this;
    }

    public function getLogMyNum(): ?int
    {
        return $this->logMyNum;
    }

    public function setLogMyNum(?int $logMyNum): self
    {
        $this->logMyNum = $logMyNum;

        return $this;
    }

    public function getLogMyQsl(): ?string
    {
        return $this->logMyQsl;
    }

    public function setLogMyQsl(string $logMyQsl): self
    {
        $this->logMyQsl = $logMyQsl;

        return $this;
    }

    public function getLogMyContest(): ?string
    {
        return $this->logMyContest;
    }

    public function setLogMyContest(?string $logMyContest): self
    {
        $this->logMyContest = $logMyContest;

        return $this;
    }

    public function getLogPoints(): ?int
    {
        return $this->logPoints;
    }

    public function setLogPoints(?int $logPoints): self
    {
        $this->logPoints = $logPoints;

        return $this;
    }

    public function getLogRemarks(): ?string
    {
        return $this->logRemarks;
    }

    public function setLogRemarks(?string $logRemarks): self
    {
        $this->logRemarks = $logRemarks;

        return $this;
    }

    public function getFolderId(): ?int
    {
        return $this->folderId;
    }

    public function setFolderId(int $folderId): self
    {
        $this->folderId = $folderId;

        return $this;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): self
    {
        $this->folder = $folder;

        return $this;
    }
}
