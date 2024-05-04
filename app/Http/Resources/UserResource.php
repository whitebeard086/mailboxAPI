<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="UserResource",
 *      type="object",
 *      required={"id", "name", "email"},
 *      @OA\Property(property="id", type="integer"),
 *      @OA\Property(property="name", type="string"),
 *      @OA\Property(property="email", type="string"),
 *      @OA\Property(property="messagesCount", type="integer"),
 *      @OA\Property(property="unreadMessagesCount", type="integer"),
 * )
 */

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'messagesCount' => $this->messages()->count(),
            'unreadMessagesCount' => $this->unreadMessages(),
        ];
    }
}
