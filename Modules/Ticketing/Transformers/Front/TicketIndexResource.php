<?php

namespace Modules\Ticketing\Transformers\Front;

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
            'title' => $this->messages->first()->title,
            'description' => $this->messages->first()->description,
            'created' => $this->created, 
            'messages' => MessageShowResource::collection($this->messages()
                                                               ->skip(1)
                                                               ->take(count($this->messages))
                                                               ->get()),
        ];
    }
}
