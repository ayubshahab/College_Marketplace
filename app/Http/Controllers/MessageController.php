<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //
    public function getMessages(Request $request){
        // if the current listing is mine that i have clicked on
        //all messages will be from the other person(s) to me
        // return "from: ".$request->from . " " . " to: ". $request->to . " listing_id=" . $request->listing_id;

        $from = $request->from;
        $to = $request->to;
        $listing_id = $request->listing_id;
        $rental_id = $request->rental_id;

        // Make read all unread message
        Message::where(['from' => $from, 'to' => $to])->update(['is_read' => 1]);

        $messages = Message::where(
            function ($query) use ($from, $to, $listing_id){
               $query->where('from', $from)->where('to', $to)->where('for_listing', $listing_id);
            }
        )->orWhere(function ($query) use ($from, $to, $listing_id){
            $query->where('from', $to)->where('to', $from)->where('for_listing', $listing_id);
        })->get();

        return $messages;
        // from Auth::id() to $user_id or $user_id to Auth::id();

        // for now, we want from $listing->user_id to reciever id, which will be passed in as $user_id
    }

    public function postMessage(Request $request){
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;
        $listing_id = $request->for_listing;
        $rental_id = $request->for_rentals;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->for_listing= $listing_id;
        $data->for_rentals=$rental_id;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'us2'
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        
        

        $data = ['from' => $from, 'to' => $to, 'for_listing' =>$listing_id, 'for_rentals' => $rental_id]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);

        $response = array(
            'status' => 'success',
            'reciever_id' => $request->receiver_id,
            'for_listing' => $request ->for_listing,
            // 'message' => $request -> message
            "message"=>$data
        );
        return response()->json($response); 
    }
}
