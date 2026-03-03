<?php
declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\AlwaysTrue;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AlwaysTrue::class)]
class AlwaysTrueTest extends TestCase
{
    public function testEvaluatesToTrue(): void
    {
        $constraint = new AlwaysTrue();
        $this->assertTrue($constraint->evaluate('anything'));
        $this->assertTrue($constraint->evaluate(null));
        $this->assertTrue($constraint->evaluate(123));
        $this->assertTrue($constraint->evaluate([]));
    }
}
