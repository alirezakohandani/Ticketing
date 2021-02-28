<?php

namespace Modules\Ticketing\Transformers\Front;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowUpResource extends JsonResource
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
            "message" => [
                [ "title" => $this->title, "description" => $this->description ],
                    ],
            "userMessage" => trans('user::successes.follow_created'),
                ]
    
            ]
        ];
    }
}
