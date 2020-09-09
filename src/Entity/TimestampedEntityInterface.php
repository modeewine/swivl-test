<?php

namespace App\Entity;

/**
 * Interface TimestampedEntityInterface
 *
 * @package App\Entity
 */
interface TimestampedEntityInterface
{
    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime;
}
