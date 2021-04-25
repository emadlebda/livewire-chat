<?php

namespace App\Http\Livewire\Conversations;

use App\Events\Conversations\ConversationUpdated;
use App\Events\Conversations\UserAdded;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ConversationUsers extends Component
{

    public $users;
    public $conversation;
    public $conversationId;

    public function mount(Collection $users, Conversation $conversation)
    {
        $this->conversation = $conversation;
        $this->users = $users;
        $this->conversationId = $conversation->id;
    }

    public function getListeners(): array
    {
        return [
            "echo-private:conversations.{$this->conversationId},Conversations\\UserAdded" => 'pushUserFromBroadcast'
        ];
    }

    public function pushUserFromBroadcast($payload)
    {
        $this->pushUser($payload['user']['id']);
    }

    public function pushUser($id): ?User
    {
        $this->users->push($user = User::find($id));
        return $user;
    }


    public function addUser($user)
    {
        if ($user['id'] !== auth()->id()) {

            $this->conversation->users()->syncWithoutDetaching($user['id']);

            $user = $this->pushUser($user['id']);

            broadcast(new UserAdded($this->conversation, $user))->toOthers();
            broadcast(new ConversationUpdated($this->conversation));

        }
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.conversations.conversation-users');
    }
}
