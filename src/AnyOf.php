<?php

/**
 * Copyright 2009-2026 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (BSD). If you
 * did not receive this file, see http://www.horde.org/licenses/bsd.
 *
 * @author   James Pepin <james@jamespepin.com>
 * @author   Chuck Hagenbuch <chuck@horde.org>
 * @category Horde
 * @license  http://www.horde.org/licenses/bsd BSD
 * @package  Constraint
 */

declare(strict_types=1);

namespace Horde\Constraint;

/**
 * Constraint that evaluates to true if ANY child constraint evaluates to true.
 *
 * Equivalent to logical OR operation across all constraints.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @author    Chuck Hagenbuch <chuck@horde.org>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class AnyOf extends CompoundConstraint
{
    /**
     * Evaluate whether a value satisfies ANY child constraint.
     *
     * @param mixed $value The value to evaluate
     *
     * @return bool True if at least one child constraint is satisfied
     */
    public function evaluate(mixed $value): bool
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->evaluate($value)) {
                return true;
            }
        }

        return false;
    }
}
