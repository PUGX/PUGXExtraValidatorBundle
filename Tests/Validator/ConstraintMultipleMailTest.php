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

use PUGX\ExtraValidatorBundle\Validator\Constraints\MultipleMail;
use PUGX\ExtraValidatorBundle\Validator\Constraints\MultipleMailValidator;

class ConstraintMultipleMailTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\\Component\\Validator\\ExecutionContext', array(), array(), '', false);
        $this->validator = new MultipleMailValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testNullDoesNotAddViolation()
    {
        $constraint = new MultipleMail(array(
            'separator' => ',',
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, $constraint);
    }

    /**
     * @dataProvider getValidMailAddressesWithSeparator
     */
    public function testValidMailCommaSeparated($data)
    {
        $constraint = new MultipleMail(array(
            'separator' => $data['separator'],
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($data['mail'], $constraint);
    }

    public function getValidMailAddressesWithSeparator()
    {
        return array(
            array(
                'mail'      => 'foo@bar.com',
                'separator' => ','
            ),
            array(
                'mail'      => 'foo@bar.com,info@example.com , chuck@norris.com',
                'separator' => ','
            ),
            array(
                'mail'      => 'foo@bar.com,info@example.com , chuck@norris.com',
            ),
            array(
                'mail'      => 'foo@bar.com | info@example.com |chuck@norris.com',
                'separator' => '|'
            ),
        );

    }

    /**
     * @dataProvider getInvalidEmail
     */
    public function testInvalidEmail($data)
    {
        $constraint = new MultipleMail(array(
            'separator' => $data['separator'],
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($data['mail'], $constraint);
    }

    public function getInvalidEmail()
    {
        return array(
            array(
                'mail'      => 'foo[at]bar.com',
                'separator' => ','
            ),
            array(
                'mail'      => 'foo[at]bar.com,info#example.com',
                'separator' => ','
            ),
            array(
                'mail'      => 'foo@bar.com|info@example.com | chuck@norris.com',
            )
        );
    }

    /**
     * @dataProvider getInvalidSeparatorForEmail
     */
    public function testInvalidSeparatorForEmail($data)
    {
        $constraint = new MultipleMail(array(
            'separator' => $data['separator'],
        ));

        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($data['mail'], $constraint);
    }

    public function getInvalidSeparatorForEmail()
    {
        return array(
            array(
                'mail'      => 'foo@bar.com#info#example.com',
                'separator' => '#'
            ),
            array(
                'mail'      => 'foo@bar.com,info@example.com',
                'separator' => '|'
            )
        );
    }
}