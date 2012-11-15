<?php
/**
 * ConstraintMinDate.php
 * @author Andrea Giuliano <giulianoand@gmail.com>
 *        Date: 22/08/12
 */
namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class MinDate extends Constraint
{
    public $message = 'Date must be greater than {{ limit }}.';
    public $limit;

    /**
     * {@inheritDoc}
     */
    public function getRequiredOptions()
    {
        return array('limit');
    }




}