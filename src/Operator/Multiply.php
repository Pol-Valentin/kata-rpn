<?php

namespace RPN\Operator;

use RPN\Operand;
use RPN\Operator;

class Multiply extends Operator
{
    const OPERATOR = 'x';

    static function canHandle($member)
    {
        return $member == self::OPERATOR;
    }

    public function applyTo(Operand $operand1, Operand $operand2)
    {
        return new Operand($operand1->toScalar() * $operand2->toScalar());
    }

}