<?php

namespace RPN;

interface Operator
{
    public function applyTo(Opperand $opperand1, Opperrand $opperrand2);
}