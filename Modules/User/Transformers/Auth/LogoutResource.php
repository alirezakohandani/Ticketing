<?php

namespace Modules\User\Transformers\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LogoutResource extends JsonResource
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
            "user" => [
                [ "name" => $this->name, "email" => $this->email ],
                    ],
            "userMessage" => trans('user::successes.logout_succeess'),
                ]
    
            ]
        ];
    }
}
