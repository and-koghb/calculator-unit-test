<?php

namespace PhpShow\Calculator;

class Calculator {

    private $firstVariable;
    private $secondVariable;
    private $operation;

    private $validOperations = ['add', 'subtract', 'multiply', 'divide'];
    private $operations = [
        'add' => 'plus',
        'subtract' => '-',
        'multiply' => '*',
        'devide' => '/'
    ];

    private $validationErrors = [];


    const FIRST_VARIABLE_INPUT = 'first';
    const FIRST_VARIABLE_NAME = 'First value';
    const SECOND_VARIABLE_INPUT = 'second';
    const SECOND_VARIABLE_NAME = 'Second value';
    const OPERATION_INPUT = 'operation';
    const OPERATION_NAME = 'Operation';

    public function __construct($firstVar, $secondVar, $operation)
    {
        $this->firstVariable = $firstVar;
        $this->secondVariable = $secondVar;
        $this->operation = $operation;
    }

    public function getResult()
    {
        if(!empty($this->validationErrors)) {
            return ['errors' => $this->validationErrors];
        }

        $result = $this->calculate();
        return ['data' => $result];
    }

    private function calculate()
    {
        $actionString = '';
        $result = '';
        switch($this->operation) {
            case 'add':
                $result = $this->firstVariable + $this->secondVariable;
                break;
            case 'subtract':
                $result = $this->firstVariable - $this->secondVariable;
                break;
            case 'multiply':
                $result = $this->firstVariable * $this->secondVariable;
                break;
            case 'divide':
                $result = $this->firstVariable / $this->secondVariable;
                break;
        }
        if(array_key_exists($this->operation, $this->operations)) {
            $actionString = $this->operations[$this->operation];
        }
        $actionText = $this->firstVariable.' '.$actionString.' '.$this->secondVariable.' = '.$result;
        return [
            'result' => $result,
            'actionText' => $actionText
        ];
    }

    public function validate()
    {
        $this->validateFirst();
        $this->validateSecond();
        $this->validateOperation();
        return $this;
    }

    private function validateFirst()
    {
        if($this->isEmpty($this->firstVariable, self::FIRST_VARIABLE_INPUT, self::FIRST_VARIABLE_NAME)) {
            return;
        }
        $this->isNotNumber($this->firstVariable, self::FIRST_VARIABLE_INPUT, self::FIRST_VARIABLE_NAME);
    }

    private function validateSecond()
    {
        if($this->isEmpty($this->secondVariable, self::SECOND_VARIABLE_INPUT, self::SECOND_VARIABLE_NAME)) {
            return;
        }
        $this->isNotNumber($this->secondVariable, self::SECOND_VARIABLE_INPUT, self::SECOND_VARIABLE_NAME);
    }

    private function validateOperation()
    {
        if($this->isEmpty($this->operation, self::OPERATION_INPUT, self::OPERATION_NAME)) {
            return;
        }
        $this->isValidOperation($this->operation, self::OPERATION_INPUT, self::OPERATION_NAME);
    }

    private function isEmpty($variable, $inputName, $variableName)
    {
        if(empty($variable)) {
            $errMsg = $variableName.' is empty';
            $this->setErrorMessage($inputName, $errMsg);
            return true;
        }
    }

    private function isNotNumber($variable, $inputName, $variableName)
    {
        if(!is_numeric($variable)) {
            $errMsg = $variableName.' is not a valid number';
            $this->setErrorMessage($inputName, $errMsg);
            return true;
        }
    }

    private function isValidOperation($variable, $inputName, $variableName)
    {
        if(!in_array($variable, $this->validOperations)) {
            $errMsg = $variableName.' is not valid';
            $this->setErrorMessage($inputName, $errMsg);
            return true;
        }
    }

    private function setErrorMessage($inputName, $errorMessage)
    {
        $this->validationErrors[$inputName] = $errorMessage;
    }
}
