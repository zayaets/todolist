<?php

namespace App\Rules;

use App\Tag;
use Illuminate\Contracts\Validation\Rule;

class TagNameNotExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
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
        $array = explode(';', $value);
        foreach ($array as $item) {
            $count = Tag::where('text', $item)->count();
            if ($count > 0) {
                $attribute = $item;
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute Tag name already exists';
    }
}
