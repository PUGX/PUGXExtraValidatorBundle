PUGXExtraValidatorBundle Documentation
======================================

Compare
-------

Compares two property of an object.

### Usage

In your Entity you must import the namespace:

```
use PUGX\ExtraValidatorBundle\Validator\Constraints as ExtraAssert;

```

Now, you can use CompareValidator just writing relevant assert
in annotation of your class. You must pass `from` and `to` and `comparator` options.

`From` and `to` should contain names of properties you want to validate while `comparator`
should contain one of this comparator:

- greater [`from` is strictly greater than `to`]
- less	[`from` is strictly less than `to`]
- equal [`from` is equals to `to`]
- different [`from` is not equals to `to`]
- greater_equal [`from` is greater or equals than `to`]
- less_equal [`from` is less or equals than `to`]

Below a basic example of use:

```
/**
 * @ExtraAssert\Compare(from="foo", to="bar", comparator="greater")
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