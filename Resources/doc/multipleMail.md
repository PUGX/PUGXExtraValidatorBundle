PUGXExtraValidatorBundle Documentation
=====================================
---
MultipleMail
-------


### Usage

In your Entity you must import the namespace:

```
use PUGX\ExtraValidatorBundle\Validator\Constraints as ExtraAssert;

```

After that you can use MultipleMailValidator just writing relevant assert
in annotation of your property:

```
/**
 * @ExtraAssert\MultipleMail(separator="|")
 */
protected $mailAddresses;

```
##Options

###_separator_

**type**: string **default**: "," 

This separator is used to divide email
___


For Inherited options see: [Email documentation](http://symfony.com/doc/current/reference/constraints/Email.html)