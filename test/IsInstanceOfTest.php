<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\IsInstanceOf;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(IsInstanceOf::class)]
class IsInstanceOfTest extends TestCase
{
    public function testEvaluatesTrueForCorrectInstance(): void
    {
        $constraint = new IsInstanceOf(stdClass::class);
        $this->assertTrue($constraint->evaluate(new stdClass()));
    }

    public function testEvaluatesFalseForWrongInstance(): void
    {
        $constraint = new IsInstanceOf(stdClass::class);
        $this->assertFalse($constraint->evaluate($this));
    }

    public function testEvaluatesFalseForNonObject(): void
    {
        $constraint = new IsInstanceOf(stdClass::class);
        $this->assertFalse($constraint->evaluate('string'));
        $this->assertFalse($constraint->evaluate(123));
        $this->assertFalse($constraint->evaluate(null));
    }

    public function testWorksWithInterfaces(): void
    {
        $constraint = new IsInstanceOf(TestCase::class);
        $this->assertTrue($constraint->evaluate($this));
    }
}
