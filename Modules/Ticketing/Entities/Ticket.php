<?php

namespace Modules\Ticketing\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ref_number', 'type', 'status'];
    
    /**
     * Get the messages for the ticket.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the user that owns the ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User registration while storing a ticket
     *
     * @param [string] $email
     * @return id
     */
    public function register($email)
    {
        $user = $this->user()->create([
            'name' => 'test',
            'email' => $email,
            'password' => 123456,
        ]);
        return $user->id;  
    }

    protected static function newFactory()
    {
        return \Modules\Ticketing\Database\factories\TicketFactory::new();
    }
}
