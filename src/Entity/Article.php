<?php
// src/Entity/Article.php
namespace App\Entity;


use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "articles")]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "L'utilisateur associé à la publication ne peut pas être nul.")]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $content = null;

    // Ajout de la propriété createdAt
    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $image = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime(); // Initialiser la date de création
    }

    // Getters et setters
    public function getId(): ?int
    {
        return $this->id;
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;
        return $this;
    }
    public function setContent(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
