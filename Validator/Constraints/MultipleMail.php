<?php
/**
 * MultipleMail.php
 * @author Andrea Giuliano <giulianoand@gmail.com>
 */
namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class MultipleMail extends Constraint
{
    public $message = 'Multiple mail must be separated by {{ separator }}';
    public $separator;

    /**
     * {@inheritDoc}
     */
    public function getRequiredOptions()
    {
        return array('separator');
    }




}