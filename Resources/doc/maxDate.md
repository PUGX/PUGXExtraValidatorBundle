PUGXExtraValidatorBundle Documentation
=====================================
---
MaxDate
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
 * @ExtraAssert\MaxDate(limit="+2 years")
 */
protected $date;

```

Limit option must be compliant to php documentation: [Supported php Date and Time Formats](http://php.net/manual/en/datetime.formats.php)