<?php

namespace Reneknox\ReneknoxPress\Validations;

use Reneknox\ReneknoxPress\Exceptions\UnsupportedValidationRuleException;
use Reneknox\ReneknoxPress\Facades\Localization\Translate;
use Reneknox\ReneknoxPress\Helpers\ArrayValidator;

class ValidateInputs
{
    private array $inputs = [];
    private array $errors = [];

    public function __construct($inputs)
    {
        $this->inputs = $inputs;
    }

    public function passing_inputs_throw_validation_rules($rules)
    {
        $arrayValidator = new ArrayValidator($rules);
        $validatedInputs = [];
        foreach ($rules as $key => $rule) {
            if (!$arrayValidator->array_keys_exists($key)) {
                $this->errors[$key] = 'please insert this field' . $key;
            }

            switch ($rule) {
                case 'required':
                    !!trim($this->inputs[$key]) ? $validatedInputs[$key] = $this->sanitize_value($this->inputs[$key]) : $this->errors[$key] = 'please this field is required';
                    break;
                case 'nullable':
                    $validatedInputs[$key] = !!trim($this->inputs[$key]) ? $this->sanitize_value($this->inputs[$key]) : null;
                    break;
                default:
                    throw new UnsupportedValidationRuleException();
            }
        }
        $this->inputs = $validatedInputs;
    }

    public function get_errors(): array
    {
        return $this->errors;
    }

    public function get_validated_inputs(): array
    {
        return $this->inputs;
    }

    private function sanitize_value($input)
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}
