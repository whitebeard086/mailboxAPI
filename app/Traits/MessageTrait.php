<?php

namespace App\Traits;

use App\Models\Message;

trait MessageTrait
{
    public function markMessageAsRead(Message $message)
    {
        if ($message->is_read == false) {
            $message->update(['is_read' => true]);
        }
    }
}