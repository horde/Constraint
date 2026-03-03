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
 * Constraint that always evaluates to true.
 *
 * Useful for testing and as a default/placeholder constraint.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class AlwaysTrue implements Constraint
{
    /**
     * Always returns true.
     *
     * @param mixed $value The value to evaluate (ignored)
     *
     * @return bool Always true
     */
    public function evaluate(mixed $value): bool
    {
        return true;
    }
}
