<?php

namespace Reneknox\ReneknoxPress\Traits;

use Reneknox\ReneknoxPress\Exceptions\UnprocessableContentException;
use Reneknox\ReneknoxPress\Validations\ValidateInputs;
use Reneknox\ReneknoxPress\Helpers\ArrayValidator;
use Reneknox\ReneknoxPress\Helpers\Response;
use Reneknox\ReneknoxPress\Http\Status;

trait ValidationTrait
{
    public function validated()
    {
        $arrayValidator = new ArrayValidator($this->all());
        if ($arrayValidator->array_keys_exists('csrf_token')) {
            $this->unset('csrf_token');
        }
        $inputs = $this->all();
        $validator = new ValidateInputs($inputs);
        $validator->passing_inputs_throw_validation_rules($this->rules());
        $errors = $validator->get_errors();
        if (count($errors) > 0) {
            throw new UnprocessableContentException(errors: $errors);
        }
        return $validator->get_validated_inputs();
    }
}
