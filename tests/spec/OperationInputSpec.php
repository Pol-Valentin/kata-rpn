<?php

namespace spec\RPN;

use PhpSpec\ObjectBehavior;
use RPN\OperationInput;

class OperationInputSpec extends ObjectBehavior
{
    public function let(){
        $this->beConstructedWith(new \RPN\Operator\OperatorFactory());
    }

    public function it_is_initializable()
    {
        $this->beAnInstanceOf(OperationInput::class);
    }

    public function it_should_calculate_simple_operation_to_two_number_and_one_operand()
    {
        $notation = '5 3 +';
        $this->execute($notation)
            ->toScalar()->shouldBe(8);
    }

    public function it_should_calculate_two_simple_operation_to_two_nested_operation()
    {
        $notation = '7 5 2 - +';
        $this->execute($notation)
            ->toScalar()->shouldBe(10);
    }

    public function it_should_calculate_nested_operation()
    {
        $notation = '3 5 8 x 7 + x';
        $this->execute($notation)
            ->toScalar()->shouldBe(141);
    }

}