<?php

/**
 * Copyright 2009-2026 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (BSD). If you
 * did not receive this file, see http://www.horde.org/licenses/bsd.
 *
 * @author   James Pepin <james@jamespepin.com>
 * @category Horde
 * @license  http://www.horde.org/licenses/bsd BSD
 * @package  Constraint
 */

declare(strict_types=1);

namespace Horde\Constraint;

use InvalidArgumentException;

/**
 * Base class for compound constraints (constraints containing other constraints).
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
abstract class CompoundConstraint implements Constraint
{
    /**
     * Child constraints.
     *
     * @var Constraint[]
     */
    protected array $constraints = [];

    /**
     * Constructor.
     *
     * @param Constraint ...$constraints Child constraints to add
     *
     * @throws InvalidArgumentException If any argument is not a Constraint
     */
    public function __construct(Constraint ...$constraints)
    {
        foreach ($constraints as $constraint) {
            $this->addConstraint($constraint);
        }
    }

    /**
     * Add a constraint to this compound constraint.
     *
     * If the constraint being added is of the same type as this compound
     * constraint, its children will be flattened into this one.
     *
     * @param Constraint $constraint The constraint to add
     *
     * @return self For method chaining
     */
    public function addConstraint(Constraint $constraint): self
    {
        // Flatten nested compound constraints of the same type
        if ($constraint instanceof static) {
            foreach ($constraint->getConstraints() as $child) {
                $this->addConstraint($child);
            }
        } else {
            $this->constraints[] = $constraint;
        }

        return $this;
    }

    /**
     * Get all child constraints.
     *
     * @return Constraint[]
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }
}
