<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * Trait TimestampedEntityTrait
 *
 * @package App\Entity\Traits
 */
trait TimestampedEntityTrait
{
    /**
     * @var \DateTime $created
     *
     * @ORM\Column(type="datetime")
     *
     * @Serializer\Groups({"default"})
     */
    protected ?\DateTime $createdAt = null;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
}
