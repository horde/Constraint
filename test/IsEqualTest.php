<?php
declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\IsEqual;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(IsEqual::class)]
class IsEqualTest extends TestCase
{
    public function testEvaluatesTrueForEqualValues(): void
    {
        $constraint = new IsEqual('test');
        $this->assertTrue($constraint->evaluate('test'));
    }

    public function testEvaluatesFalseForDifferentValues(): void
    {
        $constraint = new IsEqual('test');
        $this->assertFalse($constraint->evaluate('other'));
    }

    public function testUsesLooseComparison(): void
    {
        $constraint = new IsEqual(123);
        $this->assertTrue($constraint->evaluate('123'));
        $this->assertTrue($constraint->evaluate(123));
    }

    public function testWorksWithNull(): void
    {
        $constraint = new IsEqual(null);
        $this->assertTrue($constraint->evaluate(null));
        // Note: In PHP loose comparison, null is equal to many "empty" values
        $this->assertTrue($constraint->evaluate(''));
        $this->assertTrue($constraint->evaluate(0));
        $this->assertTrue($constraint->evaluate(false));
        $this->assertTrue($constraint->evaluate([]));
        // But not these
        $this->assertFalse($constraint->evaluate('text'));
        $this->assertFalse($constraint->evaluate(1));
    }

    public function testWorksWithArrays(): void
    {
        $constraint = new IsEqual(['a' => 1]);
        $this->assertTrue($constraint->evaluate(['a' => 1]));
        $this->assertFalse($constraint->evaluate(['a' => 2]));
    }
}
