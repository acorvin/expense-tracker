<?php

declare(strict_types=1);

namespace Framework;

use App\Exceptions\ValidationException;
use Framework\Contracts\RuleInterface;

class Validator
{
    private array $rules = [];

    public function add(string $alias, RuleInterface $rule): void
    {
        $this->rules[$alias] = $rule;
    }
    public function validate(array $formData, array $fields): void
    {
        $errors = [];

        foreach($fields as $fieldName => $rules) {

            foreach($rules as $rule) {
                $ruleParams = [];

                if (str_contains($rule, ':')){

                    [$rule, $ruleParams] = explode(':', $rule);
                    $ruleParams = explode(',', $ruleParams);
                }

                $ruleValidator = $this->rules[$rule];

                if($ruleValidator->validate($formData, $fieldName, $ruleParams)) {
                    continue;
                }

                $errors[$fieldName][] = $ruleValidator->getMessage(
                    $formData,
                    $fieldName,
                    $ruleParams
                );
            }
        }

        if(count($errors)) {
            throw new ValidationException($errors);
        }
    }
}
