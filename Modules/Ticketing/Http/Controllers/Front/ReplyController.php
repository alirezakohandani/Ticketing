<?php

namespace Modules\Ticketing\Http\Controllers\Front;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Ticketing\Entities\Ticket;
use Modules\Ticketing\Events\User\FollowCreated;
use Modules\Ticketing\Transformers\Errors\ValidationErrorResource;
use Modules\Ticketing\Transformers\Front\FollowUpResource;

class ReplyController extends Controller
{
    /**
     * Ticket variable
     */
    private $ticket;

    /**
     * Set authentication middleware
     *
     * @param Ticket $ticket
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('followUp');
    }

     /**
     * The ticket is followed by the user
     *
     * @param EntitiesTicket $ticket
     * @param Request $request
     * @return json
     */
    public function followUp(Ticket $ticket, Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
         ]);
        if ($validator->fails()) {
            return response()->json(new ValidationErrorResource($validator->errors()->first()));   
        }
            $message = $this->createMessage($ticket, $request);
            event(new FollowCreated($message, $user));
            return response()->json(new FollowUpResource($message));
    }

    /**
     * Create message for follow up
     *
     * @param Ticket $ticket
     * @param Request $request
     * @return Modules\Ticketing\Entities\Message
     */
    private function createMessage(Ticket $ticket, $request)
    {
        return $ticket->messages()->create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
    }
}
