<?php

namespace Modules\Ticketing\Transformers\Admin\Errors;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'status' => 400,
            "developerMessage" => "dont permission",
            "userMessage" => trans('Ticketing:errors.permission'),
            "errorCode" => "444444",
            'user' => [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->roles->map(function($role) {
                    return $role->role;
                }),
            ],
        ];
    }
}
