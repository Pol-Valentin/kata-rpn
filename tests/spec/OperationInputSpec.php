<?php

namespace spec\RPN;

use PhpSpec\ObjectBehavior;
use RPN\Parser;

class ParserSpec extends ObjectBehavior
{

    private $operators = ['-', '+', '/', '*'];

    private $firstOperand;

    private $secondOperand;

    private $firstOperator;

    private $notation;
    private $thirdOperand;
    private $secondOperator;


    public function it_is_initializable()
    {
        $this->beAnInstanceOf(Parser::class);
    }

    public function it_should_extract_simple_operation_to_two_number_and_one_operand()
    {
        $this->given_there_is_a_simple_operation();

        $this->extract($this->notation)
            ->shouldBe(
                [
                    $this->firstOperand,
                    $this->secondOperand,
                    $this->firstOperator
                ]
            );
    }

    public function it_should_extract_two_simple_operation_to_two_nested_operation()
    {
        $this->given_there_is_two_followed_simple_operation();
        echo $this->notation . "\n";
        $this->extract($this->notation)
            ->shouldBe(
                [
                    $this->firstOperand,
                    [
                        $this->secondOperand,
                        $this->thirdOperand,
                        $this->firstOperator
                    ],
                    $this->secondOperator
                ]
            );
    }

    private function given_there_is_a_simple_operation()
    {
        $this->firstOperand = rand(0, 1000);

        $this->secondOperand = rand(0, 1000);

        $this->firstOperator = $this->operators[array_rand($this->operators)];

        $this->notation = sprintf(
            '%d %d %s',
            $this->firstOperand,
            $this->secondOperand,
            $this->firstOperator
        );
    }

    private function given_there_is_two_followed_simple_operation()
    {
        $this->firstOperand = rand();

        $this->secondOperand = rand();

        $this->thirdOperand = rand();

        $this->firstOperator = $this->operators[array_rand($this->operators)];
        $this->secondOperator = $this->operators[array_rand($this->operators)];

        $this->notation = sprintf(
            '%d %d %d %s %s',
            $this->firstOperand,
            $this->secondOperand,
            $this->thirdOperand,
            $this->firstOperator,
            $this->secondOperator
        );
    }
}