<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SingleRepository")
 */
class Single
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $time;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Playlist", mappedBy="id_single")
     */
    private $id_playlist;

    public function __construct()
    {
        $this->id_playlist = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return Collection|Playlist[]
     */
    public function getIdPlaylist(): Collection
    {
        return $this->id_playlist;
    }

    public function addIdPlaylist(Playlist $idPlaylist): self
    {
        if (!$this->id_playlist->contains($idPlaylist)) {
            $this->id_playlist[] = $idPlaylist;
            $idPlaylist->addIdSingle($this);
        }

        return $this;
    }

    public function removeIdPlaylist(Playlist $idPlaylist): self
    {
        if ($this->id_playlist->contains($idPlaylist)) {
            $this->id_playlist->removeElement($idPlaylist);
            $idPlaylist->removeIdSingle($this);
        }

        return $this;
    }
}
