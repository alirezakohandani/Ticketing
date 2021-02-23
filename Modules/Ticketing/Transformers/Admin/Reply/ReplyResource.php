<?php

namespace Modules\Ticketing\Transformers\Admin\Reply;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Ticketing\Entities\Ticket;
use Modules\User\Entities\User;

class ReplyResource extends JsonResource
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
            'status' => 200,
            'developerMessage' => 'Reply created',
            'userMessage' => trans('Ticketing:successes.reply_created'),
            'message' => [
                'owner' => User::where('id', $this->user_id)->first()->name,
                'to' => User::where('id', Ticket::where('id', $this->user_id)
                                                  ->first()
                                                  ->user_id)
                                                  ->first()
                                                  ->name,
                'title' => $this->title,
                'description' => $this->description,
                'created' => $this->created_at,
            ],
        ];
    }
}
