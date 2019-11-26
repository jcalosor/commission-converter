<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Entities;

use Commissioner\CommissionTask\Exceptions\EntityValidationException;
use Commissioner\CommissionTask\Interfaces\EntityInterface;
use Illuminate\Contracts\Validation\Validator;

abstract class AbstractEntity
{
    /** @var \Illuminate\Contracts\Validation\Validator */
    protected $validator;

    /**
     * AbstractEntity constructor.
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validates values within entity entities against it's defined rules.
     *
     * @return void
     *
     * @throws \Commissioner\CommissionTask\Exceptions\EntityValidationException
     */
    protected function validateEntity(EntityInterface $entity)
    {
        if ($this->validator->validate($this->getEntityContent(), $this->getRules()) === true) {
            return;
        }

        throw new EntityValidationException('Entity validation fail', null, null, null, $this->validator->errors()->all());
    }

    /**
     * Get entity contents via reflection, this is used so there's no reliance
     * on entity methods.
     */
    private function getEntityContent(EntityInterface $entity): array
    {
        $contents = [];

        foreach ($entity->getAttributes() as $property => $value) {
            $getter = \sprintf('get%s', \ucfirst($this->transformToStudly($property)));

            // Remove backticks from column name
            $contents[\trim($property, '`')] = $entity->$getter();
        }

        return $contents;
    }

    /**
     * Return transformed string to studly case.
     */
    private function transformToStudly(string $value): string
    {
        $value = \ucwords(str_replace(['-', '_'], ' ', $value));

        return \lcfirst(\str_replace(' ', '', $value));
    }

    /**
     * Returns the set of rules for the entities.
     */
    abstract protected function getRules(): array;
}
