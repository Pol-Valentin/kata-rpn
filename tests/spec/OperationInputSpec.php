<?php

namespace spec\RPN;

use PhpSpec\ObjectBehavior;
use RPN\OperationInput;

class OperationInputSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beAnInstanceOf(OperationInput::class);
    }

    public function it_should_calculate_simple_operation_to_two_number_and_one_operand()
    {
        $notation = '5 3 +';
        $this->beConstructedWith($notation);
        $this->calculate()
            ->shouldBe(8);
    }

    public function it_should_calculate_two_simple_operation_to_two_nested_operation()
    {
        $notation = '7 5 2 - +';
        $this->beConstructedWith($notation);
        $this->calculate()
            ->shouldBe(10);
    }
}