<?php

namespace Modules\Ticketing\Transformers\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketFinishResource extends JsonResource
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
            "ticket" => [
                            [ 
                    'ref_number' => $this->ref_number,
                    'title' => $this->messages()->first()->title,
                    'created_at' => $this->created, 
                            ],
                    ],
                    'userMessage' => trans('ticketing::errors.user_ticket_finish'),
                ]
    
            ]
        ];
    }
}
