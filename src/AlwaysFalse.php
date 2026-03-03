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
 * Constraint that always evaluates to false.
 *
 * Useful for testing and as a fail-safe constraint.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class AlwaysFalse implements Constraint
{
    /**
     * Always returns false.
     * 
     * @param mixed $value The value to evaluate (ignored)
     * 
     * @return bool Always false
     */
    public function evaluate(mixed $value): bool
    {
        return false;
    }
}
