<?php

/**
 * Modern test bootstrap for Horde_Constraint.
 *
 * Copyright 2009-2026 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (BSD). If you
 * did not receive this file, see http://www.horde.org/licenses/bsd.
 *
 * @category   Horde
 * @package    Constraint
 * @subpackage UnitTests
 * @license    http://www.horde.org/licenses/bsd BSD
 */

declare(strict_types=1);

$candidates = [
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php',
];

foreach ($candidates as $candidate) {
    if (file_exists($candidate)) {
        require_once $candidate;
        break;
    }
}
