<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity
 */
class Config
{
    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=255, nullable=false, options={"default"="''"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $key = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false, options={"default"="''"})
     */
    private $value = '\'\'';

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }


}
