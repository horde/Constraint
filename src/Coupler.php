<?php

/**
 * Backward compatibility alias for CompoundConstraint.
 *
 * Copyright 2009-2026 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (BSD). If you
 * did not receive this file, see http://www.horde.org/licenses/bsd.
 *
 * @author   James Pepin <james@jamespepin.com>
 * @category Horde
 * @license  http://www.horde.org/licenses/bsd BSD
 * @package  Constraint
 * @deprecated Use CompoundConstraint instead
 */

declare(strict_types=1);

namespace Horde\Constraint;

/**
 * Backward compatibility alias for CompoundConstraint.
 *
 * @deprecated Use Horde\Constraint\CompoundConstraint instead
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
abstract class Coupler extends CompoundConstraint
{
    // This class exists solely for backward compatibility
    // All functionality is provided by CompoundConstraint
}
