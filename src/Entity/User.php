<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(nullable: true)]
    private ?int $code_postal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isAdmin = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isBanned = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tel = null;

    #[ORM\OneToMany(mappedBy: 'vendor', targetEntity: Annonce::class)]
    private Collection $annonces;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: PostLike::class)]
    private Collection $postLikes;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserPictures::class)]
    private Collection $pictures;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ip_address = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: PostComment::class)]
    private Collection $postComments;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $avatar = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: UserComment::class)]
    private Collection $userComments;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: AnnonceComment::class)]
    private Collection $annonceComments;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: AnnonceCommentLike::class)]
    private Collection $annonceCommentLikes;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->postLikes = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->postComments = new ArrayCollection();
        $this->userComments = new ArrayCollection();
        $this->annonceComments = new ArrayCollection();
        $this->annonceCommentLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(?int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(?bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function isIsBanned(): ?bool
    {
        return $this->isBanned;
    }

    public function setIsBanned(?bool $isBanned): self
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setVendor($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getVendor() === $this) {
                $annonce->setVendor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostLike>
     */
    public function getPostLikes(): Collection
    {
        return $this->postLikes;
    }

    public function addPostLike(PostLike $postLike): self
    {
        if (!$this->postLikes->contains($postLike)) {
            $this->postLikes->add($postLike);
            $postLike->setAuthor($this);
        }

        return $this;
    }

    public function removePostLike(PostLike $postLike): self
    {
        if ($this->postLikes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getAuthor() === $this) {
                $postLike->setAuthor(null);
            }
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, UserPictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(UserPictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setUser($this);
        }

        return $this;
    }

    public function removePicture(UserPictures $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getUser() === $this) {
                $picture->setUser(null);
            }
        }

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function setIpAddress(?string $ip_address): self
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    /**
     * @return Collection<int, PostComment>
     */
    public function getPostComments(): Collection
    {
        return $this->postComments;
    }

    public function addPostComment(PostComment $postComment): self
    {
        if (!$this->postComments->contains($postComment)) {
            $this->postComments->add($postComment);
            $postComment->setAuthor($this);
        }

        return $this;
    }

    public function removePostComment(PostComment $postComment): self
    {
        if ($this->postComments->removeElement($postComment)) {
            // set the owning side to null (unless already changed)
            if ($postComment->getAuthor() === $this) {
                $postComment->setAuthor(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->firstname;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, UserComment>
     */
    public function getUserComments(): Collection
    {
        return $this->userComments;
    }

    public function addUserComment(UserComment $userComment): self
    {
        if (!$this->userComments->contains($userComment)) {
            $this->userComments->add($userComment);
            $userComment->setAuthor($this);
        }

        return $this;
    }

    public function removeUserComment(UserComment $userComment): self
    {
        if ($this->userComments->removeElement($userComment)) {
            // set the owning side to null (unless already changed)
            if ($userComment->getAuthor() === $this) {
                $userComment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnnonceComment>
     */
    public function getAnnonceComments(): Collection
    {
        return $this->annonceComments;
    }

    public function addAnnonceComment(AnnonceComment $annonceComment): self
    {
        if (!$this->annonceComments->contains($annonceComment)) {
            $this->annonceComments->add($annonceComment);
            $annonceComment->setAuthor($this);
        }

        return $this;
    }

    public function removeAnnonceComment(AnnonceComment $annonceComment): self
    {
        if ($this->annonceComments->removeElement($annonceComment)) {
            // set the owning side to null (unless already changed)
            if ($annonceComment->getAuthor() === $this) {
                $annonceComment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnnonceCommentLike>
     */
    public function getAnnonceCommentLikes(): Collection
    {
        return $this->annonceCommentLikes;
    }

    public function addAnnonceCommentLike(AnnonceCommentLike $annonceCommentLike): self
    {
        if (!$this->annonceCommentLikes->contains($annonceCommentLike)) {
            $this->annonceCommentLikes->add($annonceCommentLike);
            $annonceCommentLike->setAuthor($this);
        }

        return $this;
    }

    public function removeAnnonceCommentLike(AnnonceCommentLike $annonceCommentLike): self
    {
        if ($this->annonceCommentLikes->removeElement($annonceCommentLike)) {
            // set the owning side to null (unless already changed)
            if ($annonceCommentLike->getAuthor() === $this) {
                $annonceCommentLike->setAuthor(null);
            }
        }

        return $this;
    }
}
