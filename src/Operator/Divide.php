<?php

namespace RPN;

class Divide implements Operator
{
    const OPERATOR = '/';

    public function applyTo(Opperand $opperand1, Opperrand $opperrand2)
    {
        return $opperand1->toScalar() / $opperrand2->toScalar();
    }

}