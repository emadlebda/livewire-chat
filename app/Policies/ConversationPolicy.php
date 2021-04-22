<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Conversation $conversation
     * @return bool
     */
    public function show(User $user, Conversation $conversation): bool
    {
        return $user->isInConversation($conversation->id);
    }
}
