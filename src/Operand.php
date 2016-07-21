<?php

namespace RPN;

class Operand implements Token
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * Operand constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function toScalar()
    {
        return $this->value;
    }

    public function isNumeric()
    {
        return true;
    }
}