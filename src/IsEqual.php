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
 * Constraint that checks for equality.
 *
 * Uses loose comparison (==).
 * 
 * Based on PHPUnit_Framework_Constraint_IsEqual.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class IsEqual implements Constraint
{
    private readonly mixed $expectedValue;

    public function __construct(mixed $expectedValue)
    {
        $this->expectedValue = $expectedValue;
    }

    /**
     * Check if the value equals the expected value.
     * 
     * @param mixed $value The value to evaluate
     * 
     * @return bool True if equal
     */
    public function evaluate(mixed $value): bool
    {
        return $this->expectedValue == $value;
    }
}
