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