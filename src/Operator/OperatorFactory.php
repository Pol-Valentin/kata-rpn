<?php
/**
 * Created by PhpStorm.
 * User: pol
 * Date: 21/07/16
 * Time: 18:31
 */

namespace RPN;


class OperatorFactory
{
    private $operators = [];

    public function __construct()
    {
        $this->operators = [
            Add::class,
            Divide::class,
            Multiply::class,
            Substract::class
        ];
    }

    public function build($member)
    {
        foreach ($this->operators as $operator) {
            if ($operator->) {

            }
        }
    }
}