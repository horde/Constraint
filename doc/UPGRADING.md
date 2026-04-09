# Upgrading Horde_Constraint

## From 2.x to 3.x

### Overview

Horde_Constraint 3.0 introduces a modernized PSR-4 API with PHP 8.1+ type declarations while maintaining full backward compatibility with the PSR-0 API.

### For Existing Users: Zero Breaking Changes

**If you're using the PSR-0 API (`Horde_Constraint_*`), nothing changes:**

```php
// This code works exactly the same in 3.0
$constraint = new Horde_Constraint_And(
    new Horde_Constraint_IsEqual('test'),
    new Horde_Constraint_AlwaysTrue()
);
```

✅ No code changes required
✅ No migration required
✅ Drop-in compatible upgrade

### For New Projects: Modern PSR-4 API

New projects should use the PSR-4 API:

```php
use Horde\Constraint\AllOf;
use Horde\Constraint\IsEqual;
use Horde\Constraint\AlwaysTrue;

$constraint = new AllOf(
    new IsEqual('test'),
    new AlwaysTrue()
);
```

**Key improvements:**
- ✅ Full PHP 8.1+ type declarations (`mixed`, `bool`, `readonly`)
- ✅ Modern class names (`AllOf`/`AnyOf` instead of `And`/`Or Coupler`)
- ✅ Variadic constructors for cleaner syntax
- ✅ Immutable constraints with readonly properties
- ✅ Better semantics (`AllOf` is clearer than `AndCoupler`)

### Migration Path (Optional)

When you're ready to upgrade to modern PSR-4:

#### Option 1: Use Backward Compatibility Aliases

```php
// Minimal changes - use BC aliases
use Horde\Constraint\AndCoupler;  // BC alias for AllOf
use Horde\Constraint\OrCoupler;   // BC alias for AnyOf

$constraint = new AndCoupler(/* ... */);
```

**Note:** BC aliases are deprecated and will be removed in 4.0.

#### Option 2: Migrate to Modern Names (Recommended)

```php
// Before (PSR-0)
use Horde_Constraint_And;
use Horde_Constraint_Or;
use Horde_Constraint_PregMatch;
use Horde_Constraint_Not;
use Horde_Constraint_Null;

$constraint = new Horde_Constraint_And(
    new Horde_Constraint_PregMatch('/^admin$/'),
    new Horde_Constraint_Not(new Horde_Constraint_Null())
);

// After (PSR-4)
use Horde\Constraint\AllOf;
use Horde\Constraint\AnyOf;
use Horde\Constraint\PregMatch;
use Horde\Constraint\Not;
use Horde\Constraint\IsNull;

$constraint = new AllOf(
    new PregMatch('/^admin$/'),
    new Not(new IsNull())
);
```

### Class Name Changes

| PSR-0 Name | PSR-4 Name | Reason for Change |
|------------|------------|-------------------|
| `Horde_Constraint_And` | `AllOf` | Clearer semantics (all constraints must pass) |
| `Horde_Constraint_Or` | `AnyOf` | Clearer semantics (any constraint must pass) |
| `Horde_Constraint_Coupler` | `CompoundConstraint` | More descriptive name |
| `Horde_Constraint_Null` | `IsNull` | Consistent with `IsEqual`, `IsInstanceOf` |

### API Improvements

**Variadic Constructor:**

```php
// Before (PSR-0) - must pass as separate arguments or use addConstraint
$and = new Horde_Constraint_And();
$and->addConstraint(new Horde_Constraint_IsEqual('a'));
$and->addConstraint(new Horde_Constraint_IsEqual('b'));

// After (PSR-4) - can pass any number of constraints
$allOf = new AllOf(
    new IsEqual('a'),
    new IsEqual('b'),
    new IsEqual('c')  // As many as needed
);
```

**Readonly Properties:**

```php
// PSR-4 constraints use readonly properties for immutability
class IsEqual implements Constraint
{
    public function __construct(
        private readonly mixed $expectedValue
    ) {}
}
```

**Type Safety:**

```php
// PSR-4 interface with full types
interface Constraint
{
    public function evaluate(mixed $value): bool;
}
```

### Example: Horde_Log Migration

Horde_Log is the primary consumer of Horde_Constraint. Here's how to migrate:

**Before (PSR-0):**
```php
use Horde_Constraint_And;
use Horde_Constraint_PregMatch;
use Horde_Constraint_Not;
use Horde_Constraint_Null;

$filter = new ConstraintFilter(new Horde_Constraint_And());
$filter->addConstraint('message', new Horde_Constraint_PregMatch('/error/i'));
$filter->addConstraint('priority', new Horde_Constraint_Not(new Horde_Constraint_Null()));
```

**After (PSR-4):**
```php
use Horde\Constraint\AllOf;
use Horde\Constraint\PregMatch;
use Horde\Constraint\Not;
use Horde\Constraint\IsNull;

$filter = new ConstraintFilter(new AllOf());
$filter->addConstraint('message', new PregMatch('/error/i'));
$filter->addConstraint('priority', new Not(new IsNull()));
```

### System Requirements

- **PHP ^8.1** (PSR-4 API)
- **PHP ^7.4 || ^8** (PSR-0 API, legacy)

### Deprecation Notice

The following are deprecated and will be removed in 4.0:

- `Horde\Constraint\AndCoupler` (use `AllOf`)
- `Horde\Constraint\OrCoupler` (use `AnyOf`)
- `Horde\Constraint\Coupler` (use `CompoundConstraint`)

### Testing Your Migration

```bash
# Test PSR-4 code
vendor/bin/phpunit --testsuite=psr4

# Test PSR-0 code (if you have existing tests)
vendor/bin/phpunit --testsuite=psr0
```

### Getting Help

- **Mailing List**: dev@lists.horde.org
- **GitHub Issues**: https://github.com/horde/Constraint/issues
- **Documentation**: https://www.horde.org/libraries/Horde_Constraint
