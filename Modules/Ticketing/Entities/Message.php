<?php

namespace Modules\Ticketing\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
    
    /**
     * Get the ticket that owns the message.
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class)
    }
    protected static function newFactory()
    {
        return \Modules\Ticketing\Database\factories\MessageFactory::new();
    }
}
