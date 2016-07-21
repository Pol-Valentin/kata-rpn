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

    public function execute($input)
    {
        $members = $this->buildMembers($input);

        return $this->calculate($members);
    }

    /**
     * @param Token[] $result
     * @return mixed
     */
    private function calculate($result)
    {
        $numerics = [];
        foreach ($result as $member) {
            if ($member->isNumeric()) {
                $numerics[] = $member;
            } else {
                $operand2 = array_pop($numerics);
                $operand1 = array_pop($numerics);
                $numerics[] = $member->applyTo($operand1, $operand2);
            }
        }
        return reset($numerics);
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