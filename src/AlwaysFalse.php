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
 * Always returns false
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2017 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class AlwaysFalse implements Constraint
{
    public function evaluate($value)
    {
        return false;
    }
}
