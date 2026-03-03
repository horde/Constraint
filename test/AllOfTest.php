<?php

/**
 * Tests for AllOf compound constraint.
 *
 * Copyright 2009-2026 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (BSD). If you
 * did not receive this file, see http://www.horde.org/licenses/bsd.
 *
 * @category   Horde
 * @package    Constraint
 * @subpackage UnitTests
 * @license    http://www.horde.org/licenses/bsd BSD
 */

declare(strict_types=1);

namespace Horde\Constraint\Test;

use Horde\Constraint\AllOf;
use Horde\Constraint\AlwaysFalse;
use Horde\Constraint\AlwaysTrue;
use Horde\Constraint\IsEqual;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AllOf::class)]
class AllOfTest extends TestCase
{
    public function testEvaluatesFalseWhenOneConstraintIsFalse(): void
    {
        $allOf = new AllOf(
            new AlwaysTrue(),
            new AlwaysFalse()
        );

        $this->assertFalse($allOf->evaluate('test'));
    }

    public function testEvaluatesFalseWhenBothConstraintsAreFalse(): void
    {
        $allOf = new AllOf(
            new AlwaysFalse(),
            new AlwaysFalse()
        );

        $this->assertFalse($allOf->evaluate('test'));
    }

    public function testEvaluatesTrueWhenBothConstraintsAreTrue(): void
    {
        $allOf = new AllOf(
            new AlwaysTrue(),
            new AlwaysTrue()
        );

        $this->assertTrue($allOf->evaluate('test'));
    }

    public function testEvaluatesFalseWhenFalseConstraintIsAddedViaSetter(): void
    {
        $allOf = new AllOf(
            new AlwaysTrue(),
            new AlwaysTrue()
        );

        $allOf->addConstraint(new AlwaysFalse());

        $this->assertFalse($allOf->evaluate('test'));
    }

    public function testAddConstraintReturnsAllOf(): void
    {
        $allOf = new AllOf(
            new AlwaysTrue(),
            new AlwaysTrue()
        );

        $returned = $allOf->addConstraint(new AlwaysFalse());

        $this->assertInstanceOf(AllOf::class, $returned);
    }

    public function testReturnedAllOfEvaluatesFalseWhenFalseConstraintIsAdded(): void
    {
        $allOf = new AllOf(
            new AlwaysTrue(),
            new AlwaysTrue()
        );

        $allOf = $allOf->addConstraint(new AlwaysFalse());

        $this->assertFalse($allOf->evaluate('test'));
    }

    public function testEmptyAllOfEvaluatesTrue(): void
    {
        $allOf = new AllOf();

        $this->assertTrue($allOf->evaluate('test'));
    }

    public function testFlattensNestedAllOf(): void
    {
        $inner = new AllOf(
            new IsEqual(1),
            new IsEqual(2)
        );

        $outer = new AllOf(
            new IsEqual(3),
            $inner
        );

        // Should have 3 constraints, not 2 (one being nested)
        $this->assertCount(3, $outer->getConstraints());
    }

    public function testEvaluatesWithMultipleConstraints(): void
    {
        $allOf = new AllOf(
            new IsEqual('test'),
            new AlwaysTrue(),
            new AlwaysTrue(),
            new AlwaysTrue()
        );

        $this->assertTrue($allOf->evaluate('test'));
        $this->assertFalse($allOf->evaluate('other'));
    }
}
