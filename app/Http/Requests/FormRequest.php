<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use Illuminate\Foundation\Http\FormRequest as IlluminateFormRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;

class FormRequest extends IlluminateFormRequest
{
    /**
     * @var FormRequest
     */
    public static $formRequest;

    /**
     * @var bool
     */
    public static $isBatchRequest = false;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public static function make($record = [])
    {
        static::$isBatchRequest = false;
        $request = new static($record);
        $request->setContainer(app())->setRedirector(app()->make(Redirector::class));
        $request->validateResolved();

        return $request;
    }

    public static function validationRules()
    {
        return [];
    }

    public static function prefixedValidationRules($prefix, $isBatchRequest = false)
    {
        static::$isBatchRequest = $isBatchRequest;

        $rules = static::validationRules();

        foreach ($rules as $key => $rule) {
            $rules[$prefix . $key] = $rule;
            unset($rules[$key]);
        }

        return $rules;
    }

    public static function getInputField($name)
    {
        if (static::$isBatchRequest) {
            $data = static::$formRequest->all();
            return Arr::get($data, '0.' . $name);
        }
        return static::$formRequest->get($name);
    }

    public function rules()
    {
        static::$formRequest = $this;

        return static::validationRules();
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errorMessages =  $validator->errors()->messages();
        $cleanedUpMessages = $this->cleanUpMessages($errorMessages);

        $validator->errors()->replace($cleanedUpMessages);

        parent::failedValidation($validator);
    }

    protected function cleanUpMessages($errorMessages)
    {
        $cleanedUpMessages = [];

        foreach ($errorMessages as $attributeName => $errorMessage) {
            foreach ($errorMessage as $key => $message) {
                $pattern = '/\.([\d]+)\./';

                // searching for .*. the * value for message to return
                $matched = preg_match($pattern, $message, $matches, PREG_OFFSET_CAPTURE);

                if ($matched) {
                    $number = intval($matches[1][0]);
                    $message = str_replace($number, $number + 1, $message);
                }

                $message = str_replace('_id', ' ', $message);
                $message = str_replace(' id', '', $message);
                $message = str_replace('_', ' ', $message);
                $message = str_replace('.', ' ', $message);
                $message = str_replace('information.', ' information ', $message);

                $cleanedUpMessages[$attributeName] = $message;

            }
        }

        return $cleanedUpMessages;
    }
}
