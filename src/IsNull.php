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
 * Constraint that checks if a value is null.
 *
 * Based on PHPUnit_Framework_Constraint_Null.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class IsNull implements Constraint
{
    /**
     * Check if the value is null.
     * 
     * @param mixed $value The value to evaluate
     * 
     * @return bool True if null
     */
    public function evaluate(mixed $value): bool
    {
        return $value === null;
    }
}
