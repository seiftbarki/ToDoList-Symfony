<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"catégorie obligatoire")]
    #[Assert\Length(min: 3,minMessage: "saisir au moins 3 caractères")]
    private ?string $namecategorie = null;
    
    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Task::class)]
    private Collection $tasks;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?User $user = null;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamecategorie(): ?string
    {
        return $this->namecategorie;
    }

    public function setNamecategorie(string $namecategorie): static
    {
        $this->namecategorie = $namecategorie;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setCategorie($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getCategorie() === $this) {
                $task->setCategorie(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
