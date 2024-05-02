<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *     @OA\Schema(
 *         schema="MessageResource",
 *         type="object",
 *         required={"id", "subject", "content", "preview", "isRead", "sender", "created_at", "updated_at"},
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="subject", type="string"),
 *         @OA\Property(property="content", type="string"),
 *         @OA\Property(property="preview", type="string"),
 *         @OA\Property(property="isRead", type="boolean"),
 *         @OA\Property(property="sender", type="object", ref="#/components/schemas/UserResource"),
 *         @OA\Property(property="created_at", type="string", format="date-time"),
 *         @OA\Property(property="updated_at", type="string", format="date-time"),
 *     )
 */

class MessageResource extends JsonResource
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
            'subject' => $this->subject,
            'content' => $this->content,
            'preview' => Str::limit($this->content, 20),
            'isRead' => $this->is_read,
            'sender' => new UserResource($this->sender),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
