<?php

namespace Modules\Ticketing\Traits;


trait Createdat
{
    public function getCreatedAttribute()
    {
        $v = \Verta($this->created_at);
        return $v->formatDifference(); 
    }
}