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

Use _"dev-master"_ or _"2.1.*"_ depending on which version of Symfony in your composer.json
```
{
    "require": {    
        "pugx/extravalidator-bundle": "2.2.*"
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
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new PUGX\ExtraValidatorBundle\PUGXExtraValidatorBundle(),
    );
}
```

### 3. Validators


* ####Date Validators

	* [DateRange](dateRange.md)
	* [MinDate](minDate.md)
	* [MaxDate](maxDate.md)

* ####Mail Validator
	* [MultipleMail](multipleMail.md)

* ####Compare Validator
	* [Compare](compare.md)

