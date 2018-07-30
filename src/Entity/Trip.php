<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass="\App\Repository\TripRepository")
 * @ORM\Table(name="trips")
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;

    /** @ORM\Column(type="string") */
    private $longitude;

    /** @ORM\Column(type="string") */
    private $latitude;

    /** @ORM\Column(type="string") */
    private $elevation;

    /** @ORM\Column(type="string") */
    private $date;

    /** @ORM\Column(type="string") */
    private $time;

    /**
     * @ORM\Column(name="user_id", type = "int")
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user_id;

    public function __construct($name, $longitude, $latitude, $elevation, $date, $time, $user_id) {
        $this->name = $name;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->elevation = $elevation;
        $this->date = $date;
        $this->time = $time;
        $this->user_id = $user_id;
    }

    /** @param $id */
    public function setId($id) {
        $this->id = $id;
    }

    /** @return int */
    public function getId() {
        return $this->id;
    }

    /** @param $name */
    public function setName($name) {
        $this->name = $name;
    }

    /** @return string */
    public function getName() {
        return $this->name;
    }

    /** @param $longitude */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    /** @return string */
    public function getLongitude() {
        return $this->longitude;
    }

    /** @param $latitude */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    /** @return string */
    public function getLatitude() {
        return $this->latitude;
    }

    /** @param $elevation */
    public function setElevation($elevation) {
        $this->elevation = $elevation;
    }

    /** @return string */
    public function getElevation() {
        return $this->elevation;
    }

    /** @param $date */
    public function setDate($date) {
        $this->date = $date;
    }

    /** @return date */
    public function getDate() {
        return $this->date;
    }

    /** @param $date */
    public function setTime($time) {
        $this->time = $time;
    }

    /** @return time */
    public function getTime() {
        return $this->time;
    }
}
