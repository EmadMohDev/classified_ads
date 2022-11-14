<?php

namespace App\Rules;

use App\Models\Rbt;
use Illuminate\Contracts\Validation\Rule;

class OnlyCodeOrUssd implements Rule
{
    public $attribute;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(public string $another_column)
    {
        //
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
        $this->attribute = $attribute;
        return request($this->another_column) && $value ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Please Select Only value for $this->attribute or $this->another_column.";
    }
}
