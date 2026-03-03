<?php
declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\PregMatch;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PregMatch::class)]
class PregMatchTest extends TestCase
{
    public function testMatchesPattern(): void
    {
        $constraint = new PregMatch('/^test/');
        $this->assertTrue($constraint->evaluate('test123'));
        $this->assertFalse($constraint->evaluate('123test'));
    }

    public function testMatchesComplexPattern(): void
    {
        $constraint = new PregMatch('/\d{3}-\d{4}/');
        $this->assertTrue($constraint->evaluate('Phone: 555-1234'));
        $this->assertFalse($constraint->evaluate('Phone: 55-1234'));
    }

    public function testCaseSensitiveByDefault(): void
    {
        $constraint = new PregMatch('/Test/');
        $this->assertTrue($constraint->evaluate('Test'));
        $this->assertFalse($constraint->evaluate('test'));
    }

    public function testCaseInsensitiveWithModifier(): void
    {
        $constraint = new PregMatch('/test/i');
        $this->assertTrue($constraint->evaluate('Test'));
        $this->assertTrue($constraint->evaluate('TEST'));
        $this->assertTrue($constraint->evaluate('test'));
    }
}
