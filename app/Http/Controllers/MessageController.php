<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MessageResource;

/**
 * @OA\Tag(
 *     name="Messages",
 *     description="Operations about messages",
 * )
 */

class MessageController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/messages",
     *     operationId="getMessages",
     *     tags={"Messages"},
     *     summary="Get paginated list of messages",
     *     description="Returns a paginated list of messages",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/MessageResource")
     *             )
     *         )
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    
    public function index()
    {
        $messages = MessageResource::collection(Message::with('sender')->where('receiver_id', Auth::id())->paginate(2));

        return $messages;
    }

    /**
     *     @OA\Get(
     *         path="/api/messages/{messageId}",
     *         operationId="getMessageById",
     *         tags={"Messages"},
     *         summary="Get message by id",
     *         description="Returns a single message",
     *         @OA\Parameter(
     *             name="messageId",
     *             in="path",
     *             required=true,
     *             description="The id of the message to be retrieved",
     *             @OA\Schema(
     *                 type="integer",
     *                 format="int64"
     *             )
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Successful operation",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                     ref="#/components/schemas/MessageResource"
     *                 )
     *             )
     *         ),
     *         security={
     *             {"bearerAuth": {}}
     *         }
     *     )
     */
    public function show(Message $message)
    {
        return new MessageResource($message->load('sender'));
    }
}
