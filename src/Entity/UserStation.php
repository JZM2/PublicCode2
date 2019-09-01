<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserStation
 *
 * @ORM\Table(name="user_station")
 * @ORM\Entity
 */
class UserStation
{
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="station_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $stationId;

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getStationId(): ?int
    {
        return $this->stationId;
    }


}
