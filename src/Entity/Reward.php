<?php

namespace App\Entity;

use App\Repository\RewardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RewardRepository::class)]
#[ORM\Table(name: 'reward')] // Changer le nom de la table en "reward"
class Reward
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $created_at = null;

    // Relation avec l'utilisateur
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'rewards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct(string $name, User $user)
    {
        $this->name = $name;
        $this->created_at = new \DateTime();
        $this->user = $user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
