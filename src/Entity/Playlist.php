<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaylistRepository")
 */
class Playlist
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Single", inversedBy="id_playlist")
     */
    private $id_single;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id_playlist")
     */
    private $id_user;

    public function __construct()
    {
        $this->id_single = new ArrayCollection();
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

    /**
     * @return Collection|Single[]
     */
    public function getIdSingle(): Collection
    {
        return $this->id_single;
    }

    public function addIdSingle(Single $idSingle): self
    {
        if (!$this->id_single->contains($idSingle)) {
            $this->id_single[] = $idSingle;
        }

        return $this;
    }

    public function removeIdSingle(Single $idSingle): self
    {
        if ($this->id_single->contains($idSingle)) {
            $this->id_single->removeElement($idSingle);
        }

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }
}
