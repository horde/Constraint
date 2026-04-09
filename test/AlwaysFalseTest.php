<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\AlwaysFalse;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AlwaysFalse::class)]
class AlwaysFalseTest extends TestCase
{
    public function testEvaluatesToFalse(): void
    {
        $constraint = new AlwaysFalse();
        $this->assertFalse($constraint->evaluate('anything'));
        $this->assertFalse($constraint->evaluate(null));
        $this->assertFalse($constraint->evaluate(123));
        $this->assertFalse($constraint->evaluate([]));
    }
}
