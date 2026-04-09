<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde_Constraint_Null;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Horde_Constraint_Null::class)]
class NullTest extends TestCase
{
    public function testNullReturnsTrueWhenValueisNull()
    {
        $const = new Horde_Constraint_Null();
        $this->assertTrue($const->evaluate(null));
    }

    public function testNullReturnsFalseWhenValue_IsNot_Null()
    {
        $const = new Horde_Constraint_Null();
        $this->assertFalse($const->evaluate('not null value'));
    }
}
