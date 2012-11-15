PUGXExtraValidatorBundle Documentation
=====================================
---
DateRange
-------


### Usage

In your Entity you must import the namespace:

```
use PUGX\ExtraValidatorBundle\Validator\Constraints as ExtraAssert;

```

After that you can use DateRangeValidator just writing relevant assert
in annotation of your property:

```
/**
 * @ExtraAssert\DateRange(min="20-10-2012", max="+1 years")
 */
protected $date;

```

Min and max options must be compliant to php documentation: [Supported php Date and Time Formats](http://php.net/manual/en/datetime.formats.php)