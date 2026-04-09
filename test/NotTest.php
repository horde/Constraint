<?php

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\Not;
use Horde\Constraint\AlwaysTrue;
use Horde\Constraint\AlwaysFalse;
use Horde\Constraint\IsEqual;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Not::class)]
class NotTest extends TestCase
{
    public function testNegatesTrue(): void
    {
        $constraint = new Not(new AlwaysTrue());
        $this->assertFalse($constraint->evaluate('test'));
    }

    public function testNegatesFalse(): void
    {
        $constraint = new Not(new AlwaysFalse());
        $this->assertTrue($constraint->evaluate('test'));
    }

    public function testNegatesIsEqual(): void
    {
        $constraint = new Not(new IsEqual('test'));
        $this->assertFalse($constraint->evaluate('test'));
        $this->assertTrue($constraint->evaluate('other'));
    }

    public function testDoubleNegation(): void
    {
        $constraint = new Not(new Not(new AlwaysTrue()));
        $this->assertTrue($constraint->evaluate('test'));
    }
}
