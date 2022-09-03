<?php
/**
 * Copyright 2009-2017 Horde LLC (http://www.horde.org/)
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
 * Matches against a PCRE regex
 *
 * Based on PHPUnit_Framework_Constraint_PCREMatch
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2017 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class PregMatch implements Constraint
{
    private $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function evaluate($value)
    {
        return preg_match($this->regex, $value) > 0;
    }
}
