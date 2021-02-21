<?php

namespace Modules\User\Transformers\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminStorePermissionResource extends JsonResource
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
            'developerMessage' => 'The desired permission was added about the role',
        ];
    }
}
