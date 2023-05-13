<?php

namespace App\Entity;

use App\Repository\UsercommentLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsercommentLikeRepository::class)]
class UserCommentLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $count_like = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'userCommentLike')]
    private ?UserComment $userComment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountLike(): ?int
    {
        return $this->count_like;
    }

    public function setCountLike(int $count_like): self
    {
        $this->count_like = $count_like;

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

    public function getUserComment(): ?UserComment
    {
        return $this->userComment;
    }

    public function setUserComment(?UserComment $userComment): self
    {
        $this->userComment = $userComment;

        return $this;
    }
}
