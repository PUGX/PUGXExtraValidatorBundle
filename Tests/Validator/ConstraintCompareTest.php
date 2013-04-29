<?php

/*
 * This file is part of the ExtraValidatorBundle package.
 *
 * (c) Massimiliano Arione <garakkio@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PUGX\ExtraValidatorBundle\Tests\Validator;

use PUGX\ExtraValidatorBundle\Validator\Constraints\CompareValidator;
use PUGX\ExtraValidatorBundle\Validator\Constraints\Compare;

class ConstraintCompareTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new CompareValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testValidValues()
    {
        $object = new Stub1();

        $constraint = new Compare(array(
            'from' => 'from',
            'to'   => 'to',
        ));

        $this->context->expects($this->never())->method('addViolation');

        $this->validator->validate($object, $constraint);
    }

    public function testInvalidValues()
    {
        $object = new Stub2();

        $constraint = new Compare(array(
            'from' => 'from',
            'to'   => 'to',
        ));

        $this->context->expects($this->once())->method('addViolation');

        $this->validator->validate($object, $constraint);
    }
}

class Stub1
{
    public function getFrom()
    {
        return 10;
    }

    public function getTo()
    {
        return 11;
    }
}

class Stub2 extends Stub1
{
    public function getFrom()
    {
        return 12;
    }
}