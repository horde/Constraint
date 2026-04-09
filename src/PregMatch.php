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
 * Constraint that matches values against a PCRE regex.
 *
 * Based on PHPUnit_Framework_Constraint_PCREMatch.
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class PregMatch implements Constraint
{
    private readonly string $pattern;

    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * Check if the value matches the regex pattern.
     *
     * @param mixed $value The value to evaluate
     *
     * @return bool True if the pattern matches
     */
    public function evaluate(mixed $value): bool
    {
        return preg_match($this->pattern, (string) $value) > 0;
    }
}
