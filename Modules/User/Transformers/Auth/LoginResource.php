<?php

namespace Modules\User\Transformers\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "results" => [
                        [
                    "token" => [
                        [ "access_toekn" => $this->resource, "token_type" => "bearer" ],
                        ],
                    "userMessage" => trans('user::successes.login_succeess'),
                        ]
            
                    ]
                ];
    }
}
