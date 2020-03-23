<?php
declare(strict_types=1);

namespace App\Database\Entities\MailChimp;

use App\Database\Entities\Entity;

abstract class MailChimpEntity extends Entity
{
    /**
     * Get validation rules for mailchimp entity.
     *
     * @return array
     */
    abstract public function getValidationRules(): array;

    /**
     * Get array representation of entity.
     *
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * Get mailchimp array representation of entity.
     *
     * @return array
     */
    public function toMailChimpArray(): array
    {
        $array = [];

        foreach ($this->toArray() as $property => $value) {
            if ($value === null) {
                continue;
            }

            $array[$property] = $value;
        }

        return $array;
    }
}
