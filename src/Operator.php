<?php

namespace RPN;

abstract class Operator implements Token
{
    abstract static function canHandle($member);

    abstract public function applyTo(Operand $operand1, Operand $operand2);

    public function isNumeric()
    {
        return false;
    }
}