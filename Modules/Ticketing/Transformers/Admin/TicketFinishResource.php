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
            'ticket' => [
                'ref_number' => $this->ref_number,
                'title' => $this->messages()->first()->title,
                'created_at' => $this->created,
            ],
            'status' => 200,
            'developerMessage' => 'ticket finished',
            'userMessage' => trans('Ticketing:ticket_finish'),
        ];
    }
}
