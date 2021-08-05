<?php

namespace Horde\Constraint\Test;
use Horde_Test_Case;
use \Horde_Constraint_PregMatch;

class PregMatchTest extends Horde_Test_Case
{
    public function testPregReturnsTrueWhenRegexMatches()
    {
        $preg = new Horde_Constraint_PregMatch('/somestring/');
        $this->assertTrue($preg->evaluate('somestring'));
    }

    public function testPregReturnsFalseWhenRegex_DoesNot_Match()
    {
        $preg = new Horde_Constraint_PregMatch('/somestring/');
        $this->assertFalse($preg->evaluate('some other string'));
    }
}
