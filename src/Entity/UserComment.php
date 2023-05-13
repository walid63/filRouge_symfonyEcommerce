<?php

namespace App\Entity;

use App\Repository\UserCommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCommentRepository::class)]
class UserComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userComments')]
    private ?User $author = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?int $count_comment = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'userComment', targetEntity: UserCommentLike::class)]
    private Collection $userCommentLike;

    public function __construct()
    {
        $this->userCommentLike = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCountComment(): ?int
    {
        return $this->count_comment;
    }

    public function setCountComment(int $count_comment): self
    {
        $this->count_comment = $count_comment;

        return $this;

    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, UserCommentLike>
     */
    public function getUserCommentLike(): Collection
    {
        return $this->userCommentLike;
    }

    public function addUserCommentLike(UserCommentLike $userCommentLike): self
    {
        if (!$this->userCommentLike->contains($userCommentLike)) {
            $this->userCommentLike->add($userCommentLike);
            $userCommentLike->setUserComment($this);
        }

        return $this;
    }

    public function removeUserCommentLike(UserCommentLike $userCommentLike): self
    {
        if ($this->userCommentLike->removeElement($userCommentLike)) {
            // set the owning side to null (unless already changed)
            if ($userCommentLike->getUserComment() === $this) {
                $userCommentLike->setUserComment(null);
            }
        }

        return $this;
    }
}
