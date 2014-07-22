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

use Symfony\Component\Validator\Constraint;

/**
 * Compare
 *
 * @Annotation
 */
class Compare extends Constraint
{
    public $message = '{{ from }} must be {{ comparator }} than {{ to }}.';
    public $from;
    public $to;
    public $comparator;

    /**
     * {@inheritDoc}
     */
    public function getRequiredOptions()
    {
        return array('from', 'to', 'comparator');
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOption()
    {
        return 'message';
    }

    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
