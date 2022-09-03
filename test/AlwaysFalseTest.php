<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde_Constraint_AlwaysFalse;
use Horde_Test_Case;

class AlwaysFalseTest extends Horde_Test_Case
{
    public static function randomObjectProvider()
    {
        return [
            ['teststring'],
            [''],
            [true],
            [false],
        ];
    }

    /**
     * @dataProvider randomObjectProvider
     */
    public function testEvaluateIsAlwaysFalse($value)
    {
        $const = new Horde_Constraint_AlwaysFalse();
        $this->assertFalse($const->evaluate($value));
    }
}
