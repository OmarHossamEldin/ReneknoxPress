<?php

namespace Reneknox\ReneknoxPress\Traits;

use Reneknox\ReneknoxPress\Validations\ValidateInputs;
use Reneknox\ReneknoxPress\Helpers\ArrayValidator;
use Reneknox\ReneknoxPress\Helpers\Response;

trait ValidationTrait
{
    public function validated()
    {
        $arrayValidator = new ArrayValidator($this->all());
        if ($arrayValidator->array_keys_exists('wp_artisan_token')) {
            $this->unset('wp_artisan_token');
        }
        $data = $this->all();
        $validator     = new ValidateInputs($data);
        if ($validator->passing_inputs_throw_validation_rules($this->rules())) {
            $errors = $validator->get_errors();
            if (count($errors) > 0) {
                return Response::json($errors, 422);
            } else {
                return $validator->get_validated_inputs();
            }
        };
    }
}
