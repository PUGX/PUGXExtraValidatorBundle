<?php

/*
 * This file is part of the ExtraValidatorBundle package.
 *
 * (c) Massimiliano Arione <garakkio@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * CompareValidator
 */
class CompareValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($object, Constraint $constraint)
    {
        $fromMethod = 'get' . Container::camelize($constraint->from);
        $toMethod = 'get' . Container::camelize($constraint->to);
        if ($object->{$fromMethod}() > $object->{$toMethod}()) {
            $this->context->addViolation($constraint->message, array(
                '{{ from }}' => $constraint->from,
                '{{ to }}'   => $constraint->to,
            ));
        }
    }
}