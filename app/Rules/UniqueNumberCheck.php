<?php

namespace App\Rules;

use App\Models\House;
use Illuminate\Contracts\Validation\Rule;

class UniqueNumberCheck implements Rule
{
    private $className;
    private $id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($className, $id)
    {
        dd($className);
        $this->className = $className;
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (House::class == $this->className) {
            $object = $this->className::where('name', $value)->where('user_id', $this->id)->first();
        }

        return $object ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('The :attribute has already been taken');
    }
}
