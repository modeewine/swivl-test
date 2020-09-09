<?php

namespace App\Entity;

use App\Entity\Traits\TimestampedEntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * Class Classroom
 *
 * @package App\Entity
 *
 * @ORM\Table(name="classroom")
 * @ORM\Entity(repositoryClass="App\Repository\ClassroomRepository")
 * @ORM\HasLifecycleCallbacks
 *
 */
class Classroom implements TimestampedEntityInterface
{
    use TimestampedEntityTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Groups({"default"})
     */
    protected int $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     *
     * @Serializer\Groups({"default", "name"})
     */
    protected ?string $name = null;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     *
     * @Serializer\Groups({"default"})
     */
    protected bool $active = true;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
