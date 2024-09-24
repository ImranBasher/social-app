<?php

namespace App\Http\Controllers\Frontend\Message;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\UserNetwork;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    use ApiResponse;

    public function index(){

        return view('website.message.message');
    }

    public function messageList(){
        $userId = userId();
        $users = UserNetwork::with(['sender', 'receiver','user'])
            ->where('user_id',$userId)
            ->orWhere('network_user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->get();

//        dd($users);

        return $this->successResponse($users, 'Data Retrive Successfully' );
    }

    public function message($id)
    {
        $messages = Message::with(['sender', 'receiver'])
            ->where('sender_id', $id)
            ->orWhere('receiver_id', $id)
            ->orderBy('updated_at', 'asc')
            ->get();
        // dd($messages);

        return $this->successResponse($messages, 'Data Retrive Successfully' );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $validatedData = $request->validate([
                'sender_id' => 'required|integer',
                'receiver_id' => 'required|integer',
                'messsge_body' => 'required|string|max:255',
            ]);

            // Store message
            $message = new Message();
            $message->sender_id = $validatedData['sender_id'];
            $message->receiver_id = $validatedData['receiver_id'];
            $message->messsge_body = $validatedData['messsge_body'];
            $message->save();

            return response()->json(['success' => true, 'message' => 'Message sent successfully']);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving message: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return response()->json(['success' => false, 'message' => 'Failed to send message'], 500);
        }
    }
}
