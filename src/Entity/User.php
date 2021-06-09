<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Profile::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $profile;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Meeting::class, mappedBy="requester")
     */
    private $meetingsRequested;

    /**
     * @ORM\OneToMany(targetEntity=Meeting::class, mappedBy="hoster")
     */
    private $meetingsHosted;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="rater")
     */
    private $ratingsRated;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="rated")
     */
    private $ratings;

    /**
     * @ORM\OneToMany(targetEntity=Recommandation::class, mappedBy="user")
     */
    private $recommandations;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->meetingsRequested = new ArrayCollection();
        $this->meetingsHosted = new ArrayCollection();
        $this->ratingsRated = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->recommandations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): self
    {
        // set the owning side of the relation if necessary
        if ($profile->getUser() !== $this) {
            $profile->setUser($this);
        }

        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Meeting[]
     */
    public function getMeetingsRequested(): Collection
    {
        return $this->meetingsRequested;
    }

    public function addMeetingRequested(Meeting $meeting): self
    {
        if (!$this->meetingsRequested->contains($meeting)) {
            $this->meetingsRequested[] = $meeting;
            $meeting->setRequester($this);
        }

        return $this;
    }

    public function removeMeetingRequested(Meeting $meeting): self
    {
        if ($this->meetingsRequested->removeElement($meeting)) {
            // set the owning side to null (unless already changed)
            if ($meeting->getRequester() === $this) {
                $meeting->setRequester(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Meeting[]
     */
    public function getMeetingsHosted(): Collection
    {
        return $this->meetingsHosted;
    }

    public function addMeetingsHosted(Meeting $meetingsHosted): self
    {
        if (!$this->meetingsHosted->contains($meetingsHosted)) {
            $this->meetingsHosted[] = $meetingsHosted;
            $meetingsHosted->setHoster($this);
        }

        return $this;
    }

    public function removeMeetingsHosted(Meeting $meetingsHosted): self
    {
        if ($this->meetingsHosted->removeElement($meetingsHosted)) {
            // set the owning side to null (unless already changed)
            if ($meetingsHosted->getHoster() === $this) {
                $meetingsHosted->setHoster(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatingsRated(): Collection
    {
        return $this->ratingsRated;
    }

    public function addRatingsRated(Rating $ratingsRated): self
    {
        if (!$this->ratingsRated->contains($ratingsRated)) {
            $this->ratingsRated[] = $ratingsRated;
            $ratingsRated->setRater($this);
        }

        return $this;
    }

    public function removeRatingsRated(Rating $ratingsRated): self
    {
        if ($this->ratingsRated->removeElement($ratingsRated)) {
            // set the owning side to null (unless already changed)
            if ($ratingsRated->getRater() === $this) {
                $ratingsRated->setRater(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setRated($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getRated() === $this) {
                $rating->setRated(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recommandation[]
     */
    public function getRecommandations(): Collection
    {
        return $this->recommandations;
    }

    public function addRecommandation(Recommandation $recommandation): self
    {
        if (!$this->recommandations->contains($recommandation)) {
            $this->recommandations[] = $recommandation;
            $recommandation->setUser($this);
        }

        return $this;
    }

    public function removeRecommandation(Recommandation $recommandation): self
    {
        if ($this->recommandations->removeElement($recommandation)) {
            // set the owning side to null (unless already changed)
            if ($recommandation->getUser() === $this) {
                $recommandation->setUser(null);
            }
        }

        return $this;
    }
  
}
