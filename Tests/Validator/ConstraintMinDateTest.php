<?php

/*
 * This file is part of the ExtraValidatorBundle package.
 *
 * (c) Andrea Giuliano <giulianoand@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PUGX\ExtraValidatorBundle\Tests\Validator;

use PUGX\ExtraValidatorBundle\Validator\Constraints\MinDate;
use PUGX\ExtraValidatorBundle\Validator\Constraints\MinDateValidator;

class ConstraintMinDateTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new MinDateValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testLimitIsValidDate()
    {
        $targetDate = new \DateTime("-24 years");

        $constraint = new MinDate(array(
            'limit' => "foo",
        ));
        $this->context->expects($this->atLeastOnce())
            ->method('addViolation');

        $this->validator->validate($targetDate, $constraint);
    }

    public function testNullDoesNotAddViolation()
    {
        $constraint = new MinDate(array(
            'limit' => 'now',
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, $constraint);
    }

    /**
     * @dataProvider getDateValid
     */
    public function testDateValid($date)
    {
        $constraint = new MinDate(array(
            'limit' => '-18 years',
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($date, $constraint);
    }

    public function getDateValid()
    {
        return array(
            array(new \DateTime("-10 years")),
            array(new \DateTime()),
            array(new \DateTime("-18 years +1 days")),
        );
    }

    /**
     * @dataProvider getDateInvalid
     */
    public function testDateInvalid($date)
    {
        $constraint = new MinDate(array(
            'limit' => '-18 years',
        ));

        $this->context->expects($this->once())
            ->method('addViolation');

        $this->validator->validate($date, $constraint);
    }

    public function getDateInvalid()
    {
        return array(
            array(new \DateTime("-18 years -1 days")),//18 years and 1 day
            array(new \DateTime("-18 years -1 minutes")),
            array(new \DateTime("-20 years")),
        );
    }
}
