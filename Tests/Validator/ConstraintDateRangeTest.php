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

use PUGX\ExtraValidatorBundle\Validator\Constraints\DateRange;
use PUGX\ExtraValidatorBundle\Validator\Constraints\DateRangeValidator;

class ConstraintDateRangeTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new DateRangeValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testMinAndMaxIsValidDateFormat()
    {
        $targetDate = new \DateTime();

        $constraint = new DateRange(array(
            'min' => 'foo',
            'max' => 'bar',
        ));
        $this->context->expects($this->atLeastOnce())
            ->method('addViolation');

        $this->validator->validate($targetDate, $constraint);
    }

    public function testNullIsValid()
    {
        $date = 'now';

        $constraint = new DateRange(array(
            'min' => $date,
            'max' => $date,
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, $constraint);
    }

    /**
     * @dataProvider getDateOutOfRange
     */
    public function testDateOutOfRange($minDate, $maxDate, $targetDate)
    {
        $constraint = new DateRange(array(
            'min' => $minDate,
            'max' => $maxDate,
        ));

        $this->context->expects($this->atLeastOnce())
            ->method('addViolation');

        $this->validator->validate($targetDate, $constraint);
    }

    public function getDateOutOfRange()
    {
        return array(
            array(
                'minDate' => '-1 years',
                'maxDate' => '+1 years',
                'targetDate' => new \DateTime('+2 years'),
            ),

            array(
                'minDate' => '-1 years',
                'maxDate' => '+1 years',
                'targetDate' => new \DateTime('-2 years'),
            ),
            array(
                'minDate' => '-1 years',
                'maxDate' => '+1 years',
                'targetDate' => new \DateTime('+1 days +1 years'),
            ),
            array(
                'minDate' => '-1 years',
                'maxDate' => '+1 years',
                'targetDate' => new \DateTime('-1 days -1 years'),
            ),
        );
    }

    /**
     * @dataProvider getDateInRange
     */
    public function testDateInRange($minDate, $maxDate, $targetDate)
    {
        $constraint = new DateRange(array(
            'min' => $minDate,
            'max' => $maxDate,
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($targetDate, $constraint);
    }

    public function getDateInRange()
    {
        return array(
            array(
                'minDate' => '-1 years',
                'maxDate' => '+1 years',
                'targetDate' => new \DateTime(''),
            ),
            array(
                'minDate' => '-1 years',
                'maxDate' => '+1 years',
                'targetDate' => new \DateTime('-1 days +1 years'),
            ),
            array(
                'minDate' => '-1 years',
                'maxDate' => '+1 years',
                'targetDate' => new \DateTime('+1 days -1 years'),
            ),
        );
    }
}
