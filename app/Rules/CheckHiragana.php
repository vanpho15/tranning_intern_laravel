<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Config\Constants\Messages;

class CheckHiragana implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $label;
    public function __construct(string $label) {
        $this->label = $label;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {

        return empty($value) || preg_match('/[\x{3040}-\x{309F}]/u', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Messages::getMessage('E022', [$this->label]);
    }
}
