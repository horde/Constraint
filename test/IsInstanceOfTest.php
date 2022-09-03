<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde_Constraint_IsInstanceOf;
use Horde_Test_Case;
use StdClass;

class IsInstanceOfTest extends Horde_Test_Case
{
    public function testConstraintReturnsFalseWhenInstanceIsWrongClass()
    {
        $foo = new StdClass();
        $const = new Horde_Constraint_IsInstanceOf('FakeClassName');

        $this->assertFalse($const->evaluate($foo));
    }

    public function testConstraintReturnsTrueWhenInstanceIsCorrectClass()
    {
        $foo = new StdClass();
        $const = new Horde_Constraint_IsInstanceOf('StdClass');

        $this->assertTrue($const->evaluate($foo));
    }
}
