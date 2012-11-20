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
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;

class MultipleMailValidator extends EmailValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value)
        {
            return false;
        }

        $addresses = explode($constraint->separator, $value);

        foreach($addresses as $address)
        {
            $mail = trim($address);
            parent::validate($mail, new Email());
        }
        return true;
    }
}
