<?php


namespace Core;


abstract class AbsValidator
{
    protected $errors = [];

    protected $rules = [];

    public function validate(array $request){
        foreach ($request as $key => $field){
            if(preg_match($this->rules[$key], $field)) {
                unset($this->errors["{$key}_error"]);
            }
        }
        return empty($this->errors) ? true : false;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}