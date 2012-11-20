<?php
/**
 * MultipleMailValidator.php
 * @author Andrea Giuliano <giulianoand@gmail.com>
 *         Date: 20/11/12
 */
namespace PUGX\ExtraValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;

class MultipleMailValidator extends EmailValidator
{

    public function validate($value, Constraint $constraint)
    {

        if (null === $value || '' === $value) {
            return;
        }

        $addresses = explode($constraint->separator, $value);

        foreach($addresses as $address)
        {
            $mail = trim($address);
            parent::validate($mail, new Email());
        }

    }

}
