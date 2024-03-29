<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde_Constraint_AlwaysFalse;
use Horde_Constraint_AlwaysTrue;
use Horde_Constraint_Not;
use Horde_Test_Case;

class NotTest extends Horde_Test_Case
{
    public function testNotMakesFalseConstraintTrue()
    {
        $not = new Horde_Constraint_Not(new Horde_Constraint_AlwaysFalse());
        $this->assertTrue($not->evaluate('foo'));
    }

    public function testNotMakesTrueConstraintFalse()
    {
        $not = new Horde_Constraint_Not(new Horde_Constraint_AlwaysTrue());
        $this->assertFalse($not->evaluate('foo'));
    }
}
