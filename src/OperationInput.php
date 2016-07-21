<?php

namespace RPN;

class Parser
{

    const OPERANDS = '+-x\/';

    public function extract($input)
    {

        $result = [''];
        $key = 0;
        foreach (str_split($input) as $char) {
            if ($char == ' ') {
                $result[++$key] = '';
            } else {

                $result[$key] .= $char;
            }
        }
        foreach ($result as &$op) {
            if (is_numeric($op)) {
                $op = (int)$op;
            }
        }

        return $this->transform($result);
    }

    private function transform($result)
    {
        if(count($result) === 3){
            return $result;
        }
        for ($index = 0; $index < count($result) - 2; $index++)
            if (
                is_int($result[$index])
                && (is_int($result[$index + 1]) || is_array($result[$index + 1]))
                && is_string($result[$index + 2])
            ) {
                $result[$index] = [
                    $result[$index],
                    $result[$index + 1],
                    $result[$index + 2]
                ];
                unset($result[$index + 1]);
                unset($result[$index + 2]);
                return $this->transform(array_values($result));
            }
        return $result;
    }


}