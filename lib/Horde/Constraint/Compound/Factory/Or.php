<?
/**
 * create Or constraints
 *
 * @author James Pepin <james@jamespepin.com>
 */
class Horde_Constraint_Compound_Factory_Or implements Horde_Constraint_Compound_Factory
{
    public function create(Horde_Constraint $a, Horde_Constraint $b)
    {
        return new Horde_Constraint_Or($a, $b);
    }
    public function createsConstraintType(Horde_Constraint $constraint)
    {
        return $constraint instanceof Horde_Constraint_Or;
    }
}
