<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuotationRepository")
 */
class Quotation
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
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $delay;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activityArea;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="quotations")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $printSubproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objectSubproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webSubproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marketingSubproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motionSubproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infographicSubproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $exeSubproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $textile_subproduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $evenementiel_subproduct;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isNew;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAccepted;


    public function __construct()
    {

        $this->createdAt = new \DateTime();
        $this->isNew = true;
    }

    public function getId(): ?int
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDelay(): ?string
    {
        return $this->delay;
    }

    public function setDelay(string $delay): self
    {
        $this->delay = $delay;

        return $this;
    }

    public function getActivityArea(): ?string
    {
        return $this->activityArea;
    }

    public function setActivityArea(string $activityArea): self
    {
        $this->activityArea = $activityArea;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReference(): ? string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrintSubproduct(): ?string
    {
        return $this->printSubproduct;
    }

    public function setPrintSubproduct(string $printSubproduct): self
    {
        $this->printSubproduct = $printSubproduct;

        return $this;
    }

    public function getObjectSubproduct(): ?string
    {
        return $this->objectSubproduct;
    }

    public function setObjectSubproduct(?string $objectSubproduct): self
    {
        $this->objectSubproduct = $objectSubproduct;

        return $this;
    }

    public function getWebSubproduct(): ?string
    {
        return $this->webSubproduct;
    }

    public function setWebSubproduct(?string $webSubproduct): self
    {
        $this->webSubproduct = $webSubproduct;

        return $this;
    }

    public function getMarketingSubproduct(): ?string
    {
        return $this->marketingSubproduct;
    }

    public function setMarketingSubproduct(?string $marketingSubproduct): self
    {
        $this->marketingSubproduct = $marketingSubproduct;

        return $this;
    }

    public function getMotionSubproduct(): ?string
    {
        return $this->motionSubproduct;
    }

    public function setMotionSubproduct(?string $motionSubproduct): self
    {
        $this->motionSubproduct = $motionSubproduct;

        return $this;
    }

    public function getInfographicSubproduct(): ?string
    {
        return $this->infographicSubproduct;
    }

    public function setInfographicSubproduct(?string $infographicSubproduct): self
    {
        $this->infographicSubproduct = $infographicSubproduct;

        return $this;
    }

    public function getExeSubproduct(): ?string
    {
        return $this->exeSubproduct;
    }

    public function setExeSubproduct(?string $exeSubproduct): self
    {
        $this->exeSubproduct = $exeSubproduct;

        return $this;
    }

    public function getTextileSubproduct(): ?string
    {
        return $this->textile_subproduct;
    }

    public function setTextileSubproduct(?string $textile_subproduct): self
    {
        $this->textile_subproduct = $textile_subproduct;

        return $this;
    }

    public function getEvenementielSubproduct(): ?string
    {
        return $this->evenementiel_subproduct;
    }

    public function setEvenementielSubproduct(?string $evenementiel_subproduct): self
    {
        $this->evenementiel_subproduct = $evenementiel_subproduct;

        return $this;
    }

    public function getIsNew(): ?bool
    {
        return $this->isNew;
    }

    public function setIsNew(bool $isNew): self
    {
        $this->isNew = $isNew;

        return $this;
    }

    public function getIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(?bool $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }
}
