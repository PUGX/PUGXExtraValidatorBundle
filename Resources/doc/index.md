PUGXExtraValidatorBundle Documentation
=====================================

## Prerequisites

This version of the bundle requires Symfony 2.1 or higher

## Installation

1. Download PUGXExtraValidatorBundle
2. Enable the Bundle
3. Usage

### 1. Download PUGXExtraValidatorBundle

**Using composer**

Add the following lines in your composer.json:

```
{
    "require": {
        "pugx/extravalidator-bundle": "dev-master"
    }
}

```

Now, run the composer to download the bundle:

``` bash
$ php composer.phar update pugx/extravalidator-bundle
```

### 2. Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new PUGX\PUGXExtraValidatorBundle(),
    );
}
```

### 3. Usage

In your Entity you must import the namespace:

```
use PUGX\ExtraValidatorBundle\Validator\Constraints;

```

After that you can use DateRangeValidator just writing relevant assert
in annotation of your property:

```
/**
 * @DateRange(min="20-10-2012", max="+1 years")
 */
protected $date;

```

Min and max options must be compliant to php documentation

[Supported php Date and Time Formats]http://php.net/manual/en/datetime.formats.php