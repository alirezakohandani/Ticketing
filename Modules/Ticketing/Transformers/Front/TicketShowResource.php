<?php

namespace Modules\Ticketing\Transformers\Front;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $messages = $this->messages()->skip(1)->take(count($this->messages))->get();
        return [
            'results' => [
                'owner' => $this->user->name,    
                'ref_number' => $this->ref_number,
                'title' => $this->messages()->first()->title,
                'description' => $this->messages()->first()->description,
                'messages' => MessageShowResource::collection($messages),
                ],
        ];
    }
}
