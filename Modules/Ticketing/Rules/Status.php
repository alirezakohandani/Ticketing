<?php

namespace Modules\Ticketing\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class Status implements Rule
{
    /**
     * status type variable
     *
     * @var [type]
     */
    private $status;
    
    /**
     * Create a new rule instance.
     *
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->status = $request->status;
    }

    /**
     * The status field must contain whitelist values.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $whiteList = ['pending', 'anwserd', 'finished'];
        return in_array($this->status, $whiteList);
    }

    /**
     * Get the validation error message for status field.
     *
     * @return string
     */
    public function message()
    {
        return response()->json([
            'status' => 400,
            'userMessage' => trans('ticketing::errors.status_enum'),
        ]);
    }
}
