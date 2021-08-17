<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Events\NewChatMessage;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class ChatController extends Controller
{
    /**
     * Get all available rooms
     * @param Request $request 
     * @return Collection<mixed, ChatRoom> 
     */
    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }   
    
    /**
     * Get all messages for user in specified room id
     * @param Request $request 
     * @param mixed $roomId 
     * @return mixed 
     */
    public function messages(Request $request, $roomId)
    {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            //->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * User want to send new message
     * @param Request $request 
     * @param mixed $roomId 
     * @return ChatMessage 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     * @throws BindingResolutionException 
     */
    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new ChatMessage();
        $newMessage->user_id = Auth::user()->id;
        $newMessage->chat_room_id = $roomId;
        $newMessage->content = $request->message;
        $newMessage->save();

        // broadcast via event
        broadcast(new NewChatMessage( $newMessage ))->toOthers(); //

        return $newMessage;
    }
}

