PUGXExtraValidatorBundle Documentation
======================================

## Prerequisites

This version of the bundle requires Symfony 2.1 or higher

## Installation

1. Download PUGXExtraValidatorBundle
2. Enable the Bundle
3. Usage

### 1. Download PUGXExtraValidatorBundle

Run from terminal:

``` bash
$ php composer.phar require pugx/extravalidator-bundle:2.*
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


* #### Date Validators

	* [DateRange](dateRange.md)
	* [MinDate](minDate.md)
	* [MaxDate](maxDate.md)

* #### Mail Validator
	* [MultipleMail](multipleMail.md)

* #### Compare Validator
	* [Compare](compare.md)
