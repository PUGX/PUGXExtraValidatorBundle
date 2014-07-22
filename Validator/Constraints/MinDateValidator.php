<?php

/*
 * This file is part of the ExtraValidatorBundle package.
 *
 * (c) Andrea Giuliano <giulianoand@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MinDateValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof \DateTime) {
            return false;
        }

        if (false === strtotime($constraint->limit)) {
            $this->context->addViolation('limit option must be valid date string');

            return false;
        }

        $limit = new \DateTime($constraint->limit);

        if ($limit > $value) {
            $this->context->addViolation($constraint->message, array(
                '{{ limit }}' => $constraint->limit,
            ));

            return false;
        }

        return true;
    }
}
