<?php

/**
 * Tests for AnyOf compound constraint.
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

use Horde\Constraint\AnyOf;
use Horde\Constraint\AlwaysFalse;
use Horde\Constraint\AlwaysTrue;
use Horde\Constraint\IsEqual;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AnyOf::class)]
class AnyOfTest extends TestCase
{
    public function testEvaluatesTrueWhenOneConstraintIsTrue(): void
    {
        $anyOf = new AnyOf(
            new AlwaysTrue(),
            new AlwaysFalse()
        );

        $this->assertTrue($anyOf->evaluate('test'));
    }

    public function testEvaluatesFalseWhenBothConstraintsAreFalse(): void
    {
        $anyOf = new AnyOf(
            new AlwaysFalse(),
            new AlwaysFalse()
        );

        $this->assertFalse($anyOf->evaluate('test'));
    }

    public function testEvaluatesTrueWhenBothConstraintsAreTrue(): void
    {
        $anyOf = new AnyOf(
            new AlwaysTrue(),
            new AlwaysTrue()
        );

        $this->assertTrue($anyOf->evaluate('test'));
    }

    public function testEvaluatesTrueWhenTrueConstraintIsAddedViaSetter(): void
    {
        $anyOf = new AnyOf(
            new AlwaysFalse(),
            new AlwaysFalse()
        );

        $anyOf->addConstraint(new AlwaysTrue());

        $this->assertTrue($anyOf->evaluate('test'));
    }

    public function testAddConstraintReturnsAnyOf(): void
    {
        $anyOf = new AnyOf(
            new AlwaysFalse(),
            new AlwaysFalse()
        );

        $returned = $anyOf->addConstraint(new AlwaysTrue());

        $this->assertInstanceOf(AnyOf::class, $returned);
    }

    public function testReturnedAnyOfEvaluatesTrueWhenTrueConstraintIsAdded(): void
    {
        $anyOf = new AnyOf(
            new AlwaysFalse(),
            new AlwaysFalse()
        );

        $anyOf = $anyOf->addConstraint(new AlwaysTrue());

        $this->assertTrue($anyOf->evaluate('test'));
    }

    public function testEmptyAnyOfEvaluatesFalse(): void
    {
        $anyOf = new AnyOf();

        $this->assertFalse($anyOf->evaluate('test'));
    }

    public function testFlattensNestedAnyOf(): void
    {
        $inner = new AnyOf(
            new IsEqual(1),
            new IsEqual(2)
        );

        $outer = new AnyOf(
            new IsEqual(3),
            $inner
        );

        // Should have 3 constraints, not 2 (one being nested)
        $this->assertCount(3, $outer->getConstraints());
    }

    public function testShortCircuitsOnFirstTrue(): void
    {
        $anyOf = new AnyOf(
            new AlwaysTrue(),
            new IsEqual('should-not-evaluate')
        );

        // Should return true without evaluating second constraint
        $this->assertTrue($anyOf->evaluate('test'));
    }

    public function testEvaluatesWithMultipleConstraints(): void
    {
        $anyOf = new AnyOf(
            new IsEqual('test'),
            new IsEqual('other'),
            new IsEqual('another')
        );

        $this->assertTrue($anyOf->evaluate('test'));
        $this->assertTrue($anyOf->evaluate('other'));
        $this->assertFalse($anyOf->evaluate('none'));
    }
}
