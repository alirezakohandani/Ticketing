<?php

namespace Modules\Ticketing\Transformers\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketIndexResource extends JsonResource
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
            'owner' => $this->user->name,    
            'ref_number' => $this->ref_number,
            'status' => $this->status,
            'title' => $this->messages->take(1)->first()->title ?? '',
            'description' => $this->messages->take(1)->first()->description ?? '',
            'created' => $this->created,
        ];
    }
}
