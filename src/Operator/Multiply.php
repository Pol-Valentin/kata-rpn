<?php

namespace RPN;

class Substract implements Operator
{
    public function applyTo(Opperand $opperand1, Opperrand $opperrand2)
    {
        return $opperand1 - $opperrand2;
    }

}