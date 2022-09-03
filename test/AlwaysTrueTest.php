<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde_Constraint_AlwaysTrue;
use Horde_Test_Case;

class AlwaysTrueTest extends Horde_Test_Case
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
    public function testEvaluateIsAlwaysTrue($value)
    {
        $const = new Horde_Constraint_AlwaysTrue();
        $this->assertTrue($const->evaluate($value));
    }
}
