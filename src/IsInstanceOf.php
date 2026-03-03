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
 * Constraint that checks if a value is an instance of a class.
 *
 * Based on PHPUnit_Framework_Constraint_IsInstanceOf.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class IsInstanceOf implements Constraint
{
    private readonly string $expectedType;

    public function __construct(string $expectedType)
    {
        $this->expectedType = $expectedType;
    }

    /**
     * Check if the value is an instance of the expected type.
     * 
     * @param mixed $value The value to evaluate
     * 
     * @return bool True if instanceof matches
     */
    public function evaluate(mixed $value): bool
    {
        return $value instanceof $this->expectedType;
    }
}
