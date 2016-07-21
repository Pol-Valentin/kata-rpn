<?php

namespace RPN;

use RPN\Operator\OperatorFactory;

class OperationInput
{

    /**
     * @var OperatorFactory
     */
    private $operatorsFactory;

    /**
     * OperationInput constructor.
     * @param OperatorFactory $operatorsFactory
     */
    public function __construct(OperatorFactory $operatorsFactory)
    {
        $this->operatorsFactory = $operatorsFactory;
    }

    public function calculate($input)
    {
        $members = $this->buildMembers($input);

        return $this->transform($members);
    }

    private function transform($result)
    {

        if (count($result) == 1) {
            return ($result[0]);
        }

        foreach ($result as $key => $member) {
            if ($member instanceof Operator) {
                $calculatedValue = $member->applyTo($result[$key - 2], $result[$key - 1]);
                $result[$key] = $calculatedValue;
                unset($result[$key - 1]);
                unset($result[$key - 2]);

                return $this->transform(array_values($result));
            }
        }

        /*if (count($result) === 3) {
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
            }*/
    }

    private function buildMember($member)
    {
        if (is_numeric($member)) {
            return new Operand($member);
        }
        return $this->operatorsFactory->build($member);
    }

    /**
     * @param $input
     * @return array
     */
    public function buildMembers($input)
    {
        $result = [];
        foreach (explode(' ', $input) as $member) {
            $result[] = $this->buildMember($member);
        }
        return $result;
    }


}