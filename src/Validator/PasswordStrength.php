<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class PasswordStrength extends Constraint
{
    public $message = 'Пароль должен содержать хотя бы одну заглавную букву, одну цифру и один специальный символ.';
    public $messageNoDigit = 'Пароль должен содержать хотя бы одну цифру.';
    public $messageNoUppercase = 'Пароль должен содержать хотя бы одну заглавную букву.';
    public $messageNoSpecial = 'Пароль должен содержать хотя бы один специальный символ.';
}
