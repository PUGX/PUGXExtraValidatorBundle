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

namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

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
        $toMethod   = 'get' . Container::camelize($constraint->to);
        $compareMethod = 'is' . Container::camelize($constraint->comparator);

        if (!method_exists($this, $compareMethod)) {
            throw new ConstraintDefinitionException(sprintf("'%s' is not a valid comparator.", $constraint->comparator));
        }

        if (!$this->$compareMethod($object->{$fromMethod}(), $object->{$toMethod}())) {
            $this->context->addViolation($constraint->message, array(
                '{{ from }}'        => $constraint->from,
                '{{ to }}'          => $constraint->to,
                '{{ comparator }}'  => $constraint->comparator,
            ));
        }
    }

    protected function isLess($from, $to)
    {
        return ($from < $to);
    }

    protected function isLessEqual($from, $to)
    {
        return ($from <= $to);
    }

    protected function isGreater($from, $to)
    {
        return ($from > $to);
    }

    protected function isGreaterEqual($from, $to)
    {
        return ($from >= $to);
    }

    protected function isEqual($from, $to) {
        return ($from == $to);
    }

    protected function isDifferent($from, $to) {
        return ($from != $to);
    }
}