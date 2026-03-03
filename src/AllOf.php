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
 * Constraint that evaluates to true only if ALL child constraints evaluate to true.
 *
 * Equivalent to logical AND operation across all constraints.
 *
 * Based on PHPUnit_Framework_Constraint_And.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class AllOf extends CompoundConstraint
{
    /**
     * Evaluate whether a value satisfies ALL child constraints.
     *
     * @param mixed $value The value to evaluate
     *
     * @return bool True if all child constraints are satisfied
     */
    public function evaluate(mixed $value): bool
    {
        foreach ($this->constraints as $constraint) {
            if (!$constraint->evaluate($value)) {
                return false;
            }
        }

        return true;
    }
}
