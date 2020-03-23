<?php
declare(strict_types=1);

namespace App\Database\Entities;

use EoneoPay\Utils\Str;

abstract class Entity
{
    /**
     * Entity constructor.
     *
     * @param array|null $data
     */
    public function __construct(?array $data = null)
    {
        if ($data !== null) {
            $this->fill($data);
        }
    }

    /**
     * Update entity properties with given data.
     *
     * @param array $data
     *
     * @return \App\Database\Entities\Entity
     */
    public function fill(array $data): self
    {
        $str = new Str();

        foreach ($data ?? [] as $property => $value) {
            $setter = \sprintf('set%s', $str->studly($property));

            // If setter for current property exist then call it to set value
            if (\method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }

        return $this;
    }
}
