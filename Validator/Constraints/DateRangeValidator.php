<?php
/**
 * ConstraintDateRangeValidator.php.
 * @author Andrea Giuliano <giulianoand@gmail.com>
 * Date: 09/08/12
 */
namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DateRangeValidator extends ConstraintValidator
{


    /**
     * @param $value
     * @param Symfony\Component\Validator\Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (false === strtotime($constraint->min) || false === strtotime($constraint->min)) {
            $this->context->addViolation('min and/or max option must be valid date string');
            return false;
        }
        if ($value == null || !$value instanceof \DateTime) {
            return false;
        }

        $min = new \DateTime($constraint->min);

        $max = new \DateTime($constraint->max);

        if ($value < $min || $value > $max) {

            $this->context->addViolation($constraint->message, array(
                '{{ min }}' => $constraint->min,
                '{{ max }}' => $constraint->max,
            ));
            return false;
        }

        return true;
    }
}