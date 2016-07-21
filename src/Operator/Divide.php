<?php

namespace RPN\Operator;

use RPN\Operand;
use RPN\Operator;

class Divide implements Operator
{
    const OPERATOR = '/';

    static function canHandle($member)
    {
        return $member == self::OPERATOR;
    }

    public function applyTo(Operand $opperand1, Operand $opperrand2)
    {
        return new Operand($opperand1->toScalar() / $opperrand2->toScalar());
    }

}