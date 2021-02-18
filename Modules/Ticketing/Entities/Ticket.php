<?php

namespace Modules\Ticketing\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'status'];
    
    /**
     * Get the messages for the ticket.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    protected static function newFactory()
    {
        return \Modules\Ticketing\Database\factories\TicketFactory::new();
    }
}
