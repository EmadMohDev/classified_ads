<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class DescriptionLimit implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {


        $size = strlen($value);
        $sizeInKB = $size * 8 / 1000;

        if( $sizeInKB > 10){
            $fail('The :attribute must not be greater than 10KB.');
        }


    }
}
