<?php

namespace Modules\Ticketing\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class type implements Rule
{
    /**
     * ticket type variable
     *
     * @var [type]
     */
    private $type;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->type = $request->type;
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
        $whiteList = ['immediate', 'normal', 'nonsignificant'];
        return in_array($this->type, $whiteList);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('ticketing::validation.type_enum');
    }
}
