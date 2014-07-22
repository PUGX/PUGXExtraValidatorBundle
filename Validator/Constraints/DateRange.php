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
