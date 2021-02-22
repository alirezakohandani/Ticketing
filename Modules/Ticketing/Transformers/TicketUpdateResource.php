<?php

namespace Modules\Ticketing\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketUpdateResource extends JsonResource
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
            "status" => 200,
            "developerMessage" => "Update created",
            "userMessage" => trans('Ticketing:successes.updated_ticket_type'),
        ];
    }
}
