<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
// use Illuminate\Contracts\Validation\ValidationRule;

class ValidTypeSelection implements Rule
{
    protected $allTypes;

    public function __construct($allTypes)
    {
        $this->allTypes = $allTypes; // Pass the full array of 'type' inputs
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
        // Required types
        $requiredFlyer = 'flyer';
        $requiredPdf = 'pdf';

        // Count how many of 'flyer' and 'pdf' are present in the allTypes array
        $hasFlyer = collect($this->allTypes)->contains($requiredFlyer);
        $hasPdf = collect($this->allTypes)->contains($requiredPdf);

        // Ensure at least one 'flyer' and one 'pdf'
        return $hasFlyer && $hasPdf;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'At least two types must be either flyer or image.';
    }
}
