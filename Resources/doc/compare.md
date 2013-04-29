PUGXExtraValidatorBundle Documentation
======================================

Compare
-------


### Usage

In your Entity you must import the namespace:

```
use PUGX\ExtraValidatorBundle\Validator\Constraints as ExtraAssert;

```

After that you can use CompareValidator just writing relevant assert
in annotation of your class. You must pass "from" and "to" options, wich
should contain names of properties you want to validate.
Properties can be integers or DateTimes

```
/**
 * @ExtraAssert\Compare(from="foo", to="bar")
 */
class MYEntity
{
    // ...

    protected $foo;

    protected $bar;

    // ...

    public function getFoo()
    {
        return $this->foo;
    }

    public function getBar()
    {
        return $this->bar;
    }
}

```