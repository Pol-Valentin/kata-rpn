<?php

namespace RPN;

interface Operator
{
    static function canHandle($member);

    public function applyTo(Operand $opperand1, Operand $opperrand2);
}