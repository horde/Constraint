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

/**
 * Constraint that negates another constraint.
 *
 * Based on PHPUnit_Framework_Constraint_Not.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class Not implements Constraint
{
    private readonly Constraint $constraint;

    public function __construct(Constraint $constraint)
    {
        $this->constraint = $constraint;
    }

    /**
     * Evaluate the negation of the wrapped constraint.
     * 
     * @param mixed $value The value to evaluate
     * 
     * @return bool True if the wrapped constraint is false
     */
    public function evaluate(mixed $value): bool
    {
        return !$this->constraint->evaluate($value);
    }
}
