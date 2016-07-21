<?php

namespace RPN;

class Add implements Operator
{
    const OPERATOR = '+';

    public function applyTo(Opperand $opperand1, Opperrand $opperrand2)
    {
        return $opperand1 + $opperrand2;
    }

}