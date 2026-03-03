# Horde_Constraint

Modern constraint library for evaluating values against rules.

[![Build Status](https://github.com/horde/Constraint/workflows/CI/badge.svg)](https://github.com/horde/Constraint/actions)

## Overview

Horde_Constraint provides a flexible system for building and evaluating constraints (rules) that determine whether values satisfy certain conditions. It's useful for validation, filtering, and conditional logic.

**Dual-Stack API:**
- **PSR-4 Modern API** (`Horde\Constraint\*`) - PHP 8.1+ with full type safety
- **PSR-0 Legacy API** (`Horde_Constraint_*`) - Backward compatible

## Installation

```bash
composer require horde/constraint
```

## Quick Start

### Modern API (Recommended)

```php
use Horde\Constraint\AllOf;
use Horde\Constraint\IsEqual;
use Horde\Constraint\PregMatch;
use Horde\Constraint\Not;
use Horde\Constraint\IsNull;

// Simple constraint
$constraint = new IsEqual('test');
$constraint->evaluate('test');  // true
$constraint->evaluate('other'); // false

// Compound constraints (AND)
$allOf = new AllOf(
    new IsEqual('admin'),
    new PregMatch('/^[a-z]+$/')
);
$allOf->evaluate('admin'); // true

// Compound constraints (OR)
$anyOf = new AnyOf(
    new IsEqual('admin'),
    new IsEqual('moderator')
);
$anyOf->evaluate('admin'); // true

// Negation
$notNull = new Not(new IsNull());
$notNull->evaluate('value'); // true
$notNull->evaluate(null);    // false
```

### Legacy API

```php
$constraint = new Horde_Constraint_IsEqual('test');
$constraint->evaluate('test'); // true
```

## Available Constraints

### Logical Constraints

**AllOf** - All constraints must pass (AND logic)
```php
$constraint = new AllOf(
    new IsEqual('test'),
    new AlwaysTrue()
);
```

**AnyOf** - Any constraint must pass (OR logic)
```php
$constraint = new AnyOf(
    new IsEqual('foo'),
    new IsEqual('bar')
);
```

**Not** - Negates another constraint
```php
$constraint = new Not(new IsEqual('forbidden'));
```

### Comparison Constraints

**IsEqual** - Checks equality (loose comparison)
```php
$constraint = new IsEqual(123);
$constraint->evaluate('123'); // true (loose comparison)
```

**IsInstanceOf** - Checks if value is instance of a class
```php
$constraint = new IsInstanceOf(stdClass::class);
$constraint->evaluate(new stdClass()); // true
```

**IsNull** - Checks if value is null
```php
$constraint = new IsNull();
$constraint->evaluate(null); // true
```

### String Constraints

**PregMatch** - Matches against PCRE regex
```php
$constraint = new PregMatch('/^\d{3}-\d{4}$/');
$constraint->evaluate('555-1234'); // true
```

### Constant Constraints

**AlwaysTrue** - Always returns true
```php
$constraint = new AlwaysTrue();
```

**AlwaysFalse** - Always returns false
```php
$constraint = new AlwaysFalse();
```

## Usage Examples

### Building Complex Rules

```php
use Horde\Constraint\{AllOf, AnyOf, Not, IsEqual, PregMatch, IsNull};

// User must be admin OR moderator, AND account must be active
$rule = new AllOf(
    new AnyOf(
        new IsEqual('admin'),
        new IsEqual('moderator')
    ),
    new IsEqual('active')
);

// Validate
$role = 'admin';
$status = 'active';
$isValid = $rule->evaluate($role) && $rule->evaluate($status);
```

### Fluent Constraint Building

```php
$constraint = new AllOf(
    new IsEqual('value1'),
    new IsEqual('value2')
);

// Add more constraints dynamically
$constraint->addConstraint(new IsEqual('value3'));

// Chaining
$constraint
    ->addConstraint(new IsEqual('value4'))
    ->addConstraint(new IsEqual('value5'));
```

### Filtering with Constraints

```php
$isValidEmail = new PregMatch('/^[^@]+@[^@]+\.[^@]+$/');

$emails = ['valid@example.com', 'invalid', 'also@valid.com'];
$validEmails = array_filter($emails, fn($email) => $isValidEmail->evaluate($email));
// Result: ['valid@example.com', 'also@valid.com']
```

## Architecture

### Interface

All constraints implement:

```php
interface Constraint
{
    public function evaluate(mixed $value): bool;
}
```

### Compound Constraints

`CompoundConstraint` is the base for constraints that contain other constraints:

- Accepts variadic constructor: `new AllOf(...$constraints)`
- Supports fluent `addConstraint()` for dynamic building
- Automatically flattens nested constraints of the same type

```php
$inner = new AllOf(new IsEqual(1), new IsEqual(2));
$outer = new AllOf(new IsEqual(3), $inner);
// Result: 3 constraints total (flattened), not 2 with nesting
```

## Migration from PSR-0

### For Library Users

**No changes required** - PSR-0 API remains fully functional.

### For New Code (Recommended)

Use the modern PSR-4 API:

```php
// Before (PSR-0)
use Horde_Constraint_And;
use Horde_Constraint_PregMatch;

$constraint = new Horde_Constraint_And(
    new Horde_Constraint_PregMatch('/pattern/')
);

// After (PSR-4 - recommended)
use Horde\Constraint\AllOf;
use Horde\Constraint\PregMatch;

$constraint = new AllOf(
    new PregMatch('/pattern/')
);
```

### Class Mapping

| PSR-0 | PSR-4 (Modern) | PSR-4 (BC Alias) |
|-------|----------------|------------------|
| `Horde_Constraint` | `Horde\Constraint\Constraint` | - |
| `Horde_Constraint_And` | `Horde\Constraint\AllOf` | `AndCoupler` (deprecated) |
| `Horde_Constraint_Or` | `Horde\Constraint\AnyOf` | `OrCoupler` (deprecated) |
| `Horde_Constraint_Coupler` | `Horde\Constraint\CompoundConstraint` | `Coupler` (deprecated) |
| `Horde_Constraint_AlwaysTrue` | `Horde\Constraint\AlwaysTrue` | - |
| `Horde_Constraint_AlwaysFalse` | `Horde\Constraint\AlwaysFalse` | - |
| `Horde_Constraint_IsEqual` | `Horde\Constraint\IsEqual` | - |
| `Horde_Constraint_IsInstanceOf` | `Horde\Constraint\IsInstanceOf` | - |
| `Horde_Constraint_Null` | `Horde\Constraint\IsNull` | - |
| `Horde_Constraint_Not` | `Horde\Constraint\Not` | - |
| `Horde_Constraint_PregMatch` | `Horde\Constraint\PregMatch` | - |

## System Requirements

- **PHP ^8.1** (PSR-4 API)
- **PHP ^7.4** (PSR-0 API, legacy)

## Testing

```bash
# Run PSR-4 tests
vendor/bin/phpunit --testsuite=psr4

# Run with coverage
vendor/bin/phpunit --testsuite=psr4 --coverage-html coverage
```

**Test Coverage:** 40 tests, 68 assertions

## Contributing

Contributions are welcome! Please:

1. Follow PER-1 coding style for new code
2. Add tests for new constraints
3. Use Conventional Commits format
4. Ensure all tests pass on PHP 8.1+

## Changelog

See [doc/changelog.yml](doc/changelog.yml) for version history.

## License

BSD-2-Clause - see [LICENSE](LICENSE) for details.

## Links

- **Homepage**: https://www.horde.org/libraries/Horde_Constraint
- **GitHub**: https://github.com/horde/Constraint
- **Issues**: https://github.com/horde/Constraint/issues
- **Packagist**: https://packagist.org/packages/horde/constraint

## Support

- **Mailing List**: dev@lists.horde.org
- **GitHub Issues**: https://github.com/horde/Constraint/issues

## Credits

- **Original Author**: James Pepin
- **Lead**: Chuck Hagenbuch
- **Copyright**: 2009-2026 Horde LLC
- **License**: BSD-2-Clause
