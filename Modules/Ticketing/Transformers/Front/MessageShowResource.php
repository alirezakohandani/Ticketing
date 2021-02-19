<?php

namespace Modules\Ticketing\Transformers\Front;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageShowResource extends JsonResource
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
            'description' => $this->description,
            'created' => $this->created_at,
            'metadata' => [
                'resultset' => [
                    'count' => $this->count(),
                ],
            ],
        ];
        
    }
}
