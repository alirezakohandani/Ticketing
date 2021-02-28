<?php

namespace Modules\User\Transformers\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginFailedResource extends JsonResource
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
            "status" => 400,
            "developerMessage" => trans('user::errors.password_wrong'),
            "userMessage" => trans('user::errors.username_password_wrong'),
            "errorCode" => "444444",
        ];
    }
}
