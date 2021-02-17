<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
       'users' => UserResource::collection($this->collection),
       'metadata' => [
           'resultset' => [
               'count' => $this->count(),
           ],
       ],
        ];
    }
}
