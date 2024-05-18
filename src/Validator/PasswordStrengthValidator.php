<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PasswordStrengthValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $containsDigit = preg_match('/\d/', $value);
        $containsUppercase = preg_match('/[A-Z]/', $value);
        $containsSpecial = preg_match('/[^\w\d\s]/', $value);

        if (!$containsDigit) {
            $this->context->buildViolation($constraint->messageNoDigit)
                ->addViolation();
        }

        if (!$containsUppercase) {
            $this->context->buildViolation($constraint->messageNoUppercase)
                ->addViolation();
        }

        if (!$containsSpecial) {
            $this->context->buildViolation($constraint->messageNoSpecial)
                ->addViolation();
        }

        if (!$containsDigit || !$containsUppercase || !$containsSpecial) {
            return;
        }
    }
}
