<?php

namespace Modules\Ticketing\Transformers\Front;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketStoreResource extends JsonResource
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
            'ref_number' => $this->ref_number,
            'status' => 200,
        ];
    }
}
