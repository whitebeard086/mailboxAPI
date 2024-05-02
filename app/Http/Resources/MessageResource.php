<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'receiver' => new UserResource($this->receiver),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
