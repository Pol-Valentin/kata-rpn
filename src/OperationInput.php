<?php

namespace RPN;

class OperationInput
{

    const OPERANDS = '+-x\/';
    /**
     * @var string
     */
    private $input;

    /**
     * OperationInput constructor.
     * @param string $input
     */
    public function __construct($input, OperatorFactory $operatorsFactory)
    {
        $this->input = $input;
    }

    public function calculate()
    {
        $result = [];
        foreach (explode(' ', $this->input) as $member) {
            $result[] = $this->buildMember();
        }

        return $this->transform($result);
    }

    private function transform($result)
    {
        if (count($result) === 3) {
            $result = eval(
                'return ' . $result[0]
                . $result[2]
                . $result[1] . ';'
            );
            return $result;
        }
        for ($index = 0; $index < count($result) - 2; $index++)
            if (
                is_int($result[$index])
                && (is_int($result[$index + 1]) || is_array($result[$index + 1]))
                && is_string($result[$index + 2])
            ) {
                $result[$index] = eval(
                    'return ' . $result[$index]
                    . $result[$index + 2]
                    . $result[$index + 1] . ';'
                );
                unset($result[$index + 1]);
                unset($result[$index + 2]);
                return $this->transform(array_values($result));
            }
    }

    private function buildMember($member)
    {
        if (is_numeric($member)) {
            return new Operand($member);
        }
        for ($operators as $operator) {
            if ($operator::validate($member)) {
                return $operator;
            }
    }


}