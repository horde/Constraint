<?php

/**
 * Backward compatibility alias for AllOf.
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
 * @deprecated Use AllOf instead
 */

declare(strict_types=1);

namespace Horde\Constraint;

/**
 * Backward compatibility alias for AllOf.
 *
 * @deprecated Use Horde\Constraint\AllOf instead
 *
 * @author    James Pepin <james@jamespepin.com>
 * @category  Horde
 * @copyright 2009-2026 Horde LLC
 * @license   http://www.horde.org/licenses/bsd BSD
 * @package   Constraint
 */
class AndCoupler extends AllOf
{
    // This class exists solely for backward compatibility
    // All functionality is provided by AllOf
}
