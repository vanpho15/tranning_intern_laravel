<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Config\Constants\Messages;

class CheckMax implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $label;
    private $length;
    public function __construct(string $label, int $length) {
        $this->label = $label;
        $this->length = $length;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value ) {
        return empty($value) ||mb_strlen($value, 'UTF-8')< $this->length;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Messages::getMessage('E002', [$this->label , $this->length]);
    }
}
