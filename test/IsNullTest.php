<?php
declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\IsNull;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(IsNull::class)]
class IsNullTest extends TestCase
{
    public function testEvaluatesTrueForNull(): void
    {
        $constraint = new IsNull();
        $this->assertTrue($constraint->evaluate(null));
    }

    public function testEvaluatesFalseForNonNull(): void
    {
        $constraint = new IsNull();
        $this->assertFalse($constraint->evaluate(''));
        $this->assertFalse($constraint->evaluate(0));
        $this->assertFalse($constraint->evaluate(false));
        $this->assertFalse($constraint->evaluate([]));
    }
}
