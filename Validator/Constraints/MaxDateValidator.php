<?php
/**
 * ConstraintMinDateValidator.php
 * @author Andrea Giuliano <giulianoand@gmail.com>
 *        Date: 22/08/12
 */
namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxDateValidator extends ConstraintValidator
{


    /**
     * @param $value
     * @param Symfony\Component\Validator\Constraint $constraint
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

        if ($limit < $value) {
            $this->context->addViolation($constraint->message, array(
                '{{ limit }}' => $constraint->limit,
            ));
            return false;
        }

        return true;

    }
}