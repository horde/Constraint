<?php

/**
 * Backward compatibility alias for AnyOf.
 *
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
 * @deprecated Use AnyOf instead
 */

declare(strict_types=1);

namespace Horde\Constraint;

/**
 * Backward compatibility alias for AnyOf.
 *
 * @deprecated Use Horde\Constraint\AnyOf instead
 *
 * @author    James Pepin <james@jamespepin.com>
 * @author    Chuck Hagenbuch <chuck@horde.org>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class OrCoupler extends AnyOf
{
    // This class exists solely for backward compatibility
    // All functionality is provided by AnyOf
}
