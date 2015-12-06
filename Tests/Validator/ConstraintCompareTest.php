<?php

/*
 * This file is part of the ExtraValidatorBundle package.
 *
 * (c) Massimiliano Arione <garakkio@gmail.com>
 * (c) Andrea Giuliano <giulianoand@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PUGX\ExtraValidatorBundle\Tests\Validator;

use PUGX\ExtraValidatorBundle\Validator\Constraints\Compare;
use PUGX\ExtraValidatorBundle\Validator\Constraints\CompareValidator;

class ConstraintCompareTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new CompareValidator();
        $this->validator->initialize($this->context);
        $this->object = $this->getMock('\\StdClass', array('getFrom', 'getTo'));
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ConstraintDefinitionException
     */
    public function testInvalidComparatorShouldThrowsException()
    {
        $this->object
            ->expects($this->never())
            ->method('getFrom')
            ->will($this->returnValue(10));
        $this->object
            ->expects($this->never())
            ->method('getTo')
            ->will($this->returnValue(20));

        $constraint = new Compare(array(
            'from' => 'from',
            'to' => 'to',
            'comparator' => 'foo',
        ));

        $this->validator->validate($this->object, $constraint);
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testInvalidObjectShouldThrowsException()
    {
        $string = 'bar';

        $constraint = new Compare(array(
            'from' => 'from',
            'to' => 'to',
            'comparator' => 'foo',
        ));

        $this->validator->validate($string, $constraint);
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ConstraintDefinitionException
     */
    public function testNotFoundMethodShouldThrowsException()
    {
        $constraint = new Compare(array(
            'from' => 'from',
            'to' => 'to',
            'comparator' => 'foo',
        ));

        $this->validator->validate($this->object, $constraint);
    }

    /**
     * @dataProvider getValidValues
     */
    public function testValidValues($value)
    {
        $this->object
            ->expects($this->once())
            ->method('getFrom')
            ->will($this->returnValue($value['from']));
        $this->object
            ->expects($this->once())
            ->method('getTo')
            ->will($this->returnValue($value['to']));

        $constraint = new Compare(array(
            'from' => 'from',
            'to' => 'to',
            'comparator' => $value['comparator'],
        ));

        $this->context->expects($this->never())->method('addViolation');

        $this->validator->validate($this->object, $constraint);
    }

    /**
     * @dataProvider getInvalidValues
     */
    public function testInvalidValues($value)
    {
        $this->object
            ->expects($this->once())
            ->method('getFrom')
            ->will($this->returnValue($value['from']));

        $this->object
            ->expects($this->once())
            ->method('getTo')
            ->will($this->returnValue($value['to']));

        $constraint = new Compare(array(
            'from' => 'from',
            'to' => 'to',
            'comparator' => $value['comparator'],
        ));

        $this->context->expects($this->once())->method('addViolation');

        $this->validator->validate($this->object, $constraint);
    }

    public function getValidValues()
    {
        return array(
            array(
                array(
                    'from' => 10,
                    'comparator' => 'less',
                    'to' => 20,
                ),
            ),
            array(
                array(
                    'from' => 10,
                    'comparator' => 'equal',
                    'to' => 10,
                ),
            ),
            array(
                array(
                    'from' => 10,
                    'comparator' => 'less_equal',
                    'to' => 12,
                ),
            ),
            array(
                array(
                    'from' => 30,
                    'comparator' => 'greater',
                    'to' => 20,
                ),
            ),
            array(
                array(
                    'from' => 10,
                    'comparator' => 'greater_equal',
                    'to' => 10,
                ),
            ),
            array(
                array(
                    'from' => 'foo',
                    'comparator' => 'different',
                    'to' => 'bar',
                ),
            ),
            array(
                array(
                    'from' => 'foo',
                    'comparator' => 'equal',
                    'to' => 'foo',
                ),
            ),
            array(
                array(
                    'from' => new \stdClass(),
                    'comparator' => 'equal',
                    'to' => new \stdClass(),
                ),
            ),
        );
    }

    public function getInvalidValues()
    {
        return array(
            array(
                array(
                    'from' => 10,
                    'comparator' => 'greater',
                    'to' => 20,
                ),
            ),
            array(
                array(
                    'from' => 10,
                    'comparator' => 'greater',
                    'to' => 10,
                ),
            ),
            array(
                array(
                    'from' => 9,
                    'comparator' => 'greater_equal',
                    'to' => 10,
                ),
            ),
            array(
                array(
                    'from' => 12,
                    'comparator' => 'less',
                    'to' => 10,
                ),
            ),
            array(
                array(
                    'from' => 12,
                    'comparator' => 'less_equal',
                    'to' => 10,
                ),
            ),
            array(
                array(
                    'from' => 10,
                    'comparator' => 'equal',
                    'to' => 12,
                ),
            ),
            array(
                array(
                    'from' => 'foo',
                    'comparator' => 'equal',
                    'to' => 'bar',
                ),
            ),
            array(
                array(
                    'from' => 'foo',
                    'comparator' => 'different',
                    'to' => 'foo',
                ),
            ),
            array(
                array(
                    'from' => new \stdClass(),
                    'comparator' => 'different',
                    'to' => new \stdClass(),
                ),
            ),
        );
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }
}
