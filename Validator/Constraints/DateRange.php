<?php
/**
 * DateRange.php.
 * @author Andrea Giuliano <giulianoand@gmail.com>
 * Date: 09/08/12
 */

namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */


class DateRange extends Constraint
{
    public $message = 'Date must be between {{ min }} and {{ max }}.';
    public $min;
    public $max;

    /**
     * {@inheritDoc}
     */
    public function getRequiredOptions()
    {
        return array('min', 'max');
    }

}